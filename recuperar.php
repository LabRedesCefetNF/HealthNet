<?php
$idUsuarioAtual = $_POST['idUsuarioAtual'];
$senha = $_POST['senha'];
$idArquivo = $_POST['idArquivo'];
$chavePrivadaCifrada = $_FILES['chave'];

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);

//obtem arquivo
$sql = 'select dado.dado, relacao.idDono, relacao.idRelacionado from relacao inner join dado on relacao.id = dado.idRelacao inner join usuario on usuario.id = relacao.idDono and dado.id=?';
$ps = $pdo->prepare($sql);
$ps->execute(array($idArquivo));

$arquivos = array();
			
while($obj = $ps->fetchObject()){
    array_push($arquivos, $obj);
}

$arquivo = $arquivos[0];

//obtem chave publica

$sql = 'select cPublica from usuario where id=?';
$ps = $pdo->prepare($sql);

if($idUsuarioAtual == $arquivo->idDono){
    $ps->execute(array($arquivo->idRelacionado));
}else{
    $ps->execute(array($arquivo->idDono));
}

$chaves = array();
			
while($obj = $ps->fetchObject()){
    array_push($chaves, $obj);
}

$cPublica = $chaves[0]->cPublica;

file_put_contents ('temp-keys/publicKey.pem', $cPublica);
move_uploaded_file($_FILES["chave"]["tmp_name"], 'temp-keys/privateKeyEncrypted.pem.64');

//gera chave Diffie-Hellman
//decifra utilizando chave Diffie-Hellman
//decifra da base64
system('cd ./shell/ && ./decrypt.sh '.$senha.' '.$arquivo->dado);

//envia arquivo para download

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=downloads/decoded.txt');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize('downloads/decoded.txt'));
readfile('downloads/decoded.txt');

?>