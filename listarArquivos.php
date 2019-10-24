<?php
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO('mysql:host=127.0.0.1;dbname=healthnet','root','',$options);

$sql = 'select dado.id, dado.dado, usuario.nome from relacao inner join dado on relacao.id = dado.idRelacao inner join usuario on usuario.id = relacao.idDono';
$ps = $pdo->prepare($sql);
$ps->execute();

$usuarios = array();
			
while($obj = $ps->fetchObject()){				
    array_push($usuarios, $obj);
}

echo json_encode($usuarios);
?>