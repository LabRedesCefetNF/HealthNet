<?php 
$uploadDir = 'uploads/';
$idDono = $_POST['idDono'];
$idRelacionado = $_POST['idRelacionado'];
$senha = $_POST['senha'];

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);

//obtem chave publica do relacionado

//gera chave Diffie-Hellman
     
// configura caminho para o arquivo ser salvo
$fileName = basename($_FILES["arquivo"]["name"]); 
$targetFilePath = $uploadDir . $fileName; 

//salva arquivo no servidor
move_uploaded_file($_FILES["arquivo"]["tmp_name"], $targetFilePath);

//transforma em base64

//cifra utilizando chave Diffie-Hellman

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