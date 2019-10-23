<?php 
$uploadDir = 'uploads/';
$idDono = $_POST['idDono'];
$senha = $_POST['senha']; 
     
// configura caminho para o arquivo ser salvo
$fileName = basename($_FILES["file"]["name"]); 
$targetFilePath = $uploadDir . $fileName; 

//salva arquivo no servidor
move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

//transforma em base64

//cifra utilizando chave Diffie-Hellman

//armazena seu registro no banco de dados
$uploadedFile = $fileName;

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

$pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);
    
$sql = 'insert into usuario(nome, cpublica) values(?,?)';
$ps = $pdo->prepare($sql);
$ps->execute(array($nome, $cPublica));
                 
