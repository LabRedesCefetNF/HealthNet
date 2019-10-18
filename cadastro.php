<?php
$nome = $_POST["nome"];
$senha = $_POST["senha"];

//gera chave pública e privada
$cPublica = "abcdefksjkfjsldjk5165";

//salva nome, chave publica no BD
$pdo = new PDO('mysql:host=127.0.0.1;dbname=test','root','root',$options);

try{
	$sql = 'insert into usuario(nome, cpublica) values(?,?)';
	$ps = $pdo->prepare($sql);
	$ps->execute(array($nome, $cPublica));
}catch(PDOException $e){
	echo "Erro ao adicionar Usuario. ".$e;
}

//cifra chave privada com senha

//exibe chave para download

echo "Olá " . $_POST["nome"] . " (senha: " . $_POST["senha"] . ")";
?>