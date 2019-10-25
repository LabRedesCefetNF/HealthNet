<?php 
$uploadDir = 'uploads/';
$idDono = $_POST['idDono'];
$idRelacionado = $_POST['idRelacionado'];
$senha = $_POST['senha'];
$chavePrivadaCifrada = $_FILES['chave'];

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);

// configura caminho para o arquivo ser salvo
$fileName = $idDono."_".basename($_FILES["arquivo"]["name"]); 
$targetFilePath = $uploadDir . $fileName; 

//salva arquivo no servidor
move_uploaded_file($_FILES["arquivo"]["tmp_name"], $targetFilePath);

//obtem chave publica do relacionado
//gera chave Diffie-Hellman
//transforma em base64
//cifra utilizando chave Diffie-Hellman

$sql = 'select cPublica from usuario where id=?';
$ps = $pdo->prepare($sql);
$ps->execute(array($idRelacionado));

$chavesPublicas = array();
			
while($obj = $ps->fetchObject()){				
    array_push($chavesPublicas, $obj);
}

$cPublica = $chavesPublicas[0]->cPublica;

file_put_contents ('temp-keys/publicKey.pem', $cPublica);
move_uploaded_file($_FILES["chave"]["tmp_name"], 'temp-keys/privateKeyEncrypted.pem');

system('cd ./shell/ && ./encrypt.sh '.$senha.' '.$fileName);

//salva relação
$sql = 'insert into relacao(idDono, idRelacionado) values(?,?)';
$ps = $pdo->prepare($sql);
$ps->execute(array($idDono, $idRelacionado));

$idRelacao = $pdo->lastInsertId();

//armazena seu registro no banco de dados
$uploadedFile = $fileName;
$sql = 'insert into dado(dado, idRelacao) values(?,?)';
$ps = $pdo->prepare($sql);
$ps->execute(array($uploadedFile, $idRelacao));
                 
?>