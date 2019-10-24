<?php
$id = $_GET['id'];

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);

$sql = 'select * from usuario where id!=?';
$ps = $pdo->prepare($sql);
$ps->execute(array($id));

$usuarios = array();
			
while($obj = $ps->fetchObject()){				
    array_push($usuarios, $obj);
}

echo json_encode($usuarios);
?>