<?php
$nome = $_POST["nome"];
$senha = $_POST["senha"];

//gera chave pública e privada
$cPublica = "abcdefksjkfjsldjk5165";

//salva nome e chave publica no BD
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);

	$sql = 'insert into usuario(nome, cpublica) values(?,?)';
	$ps = $pdo->prepare($sql);
	$ps->execute(array($nome, $cPublica));

    //cifra chave privada com senha

    $cPrivada = 'chaveprivadacifrada';

    //exibe chave para download

    header('HTTP/1.1 200 Ok');
    echo $cPrivada;

}catch(Exception $e ){
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode('Erro ao conectar ao BD');
}

?>