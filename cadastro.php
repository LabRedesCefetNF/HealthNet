<?php
$nome = $_POST["nome"];
$senha = $_POST["senha"];

//gera chave pública e privada, e cifra chave privada

system('cd ./shell/ && ./generatekeys.sh '.$senha);

//salva nome e chave publica no BD

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try{
    $cPublica = file_get_contents('temp-keys/publicKey.pem');
    
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);
    
	$sql = 'insert into usuario(nome, cpublica) values(?,?)';
	$ps = $pdo->prepare($sql);
	$ps->execute(array($nome, $cPublica));

    //envia chave privada cifrada para download

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=temp-keys/privateKeyEncrypted.pem');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('temp-keys/privateKeyEncrypted.pem'));
    readfile('temp-keys/privateKeyEncrypted.pem');

}catch(Exception $e ){
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode('Erro ao conectar ao BD'.$e);
}
?>