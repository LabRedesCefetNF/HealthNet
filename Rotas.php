<?php
$method = $_SERVER[ 'REQUEST_METHOD' ];
$url = $_SERVER[ 'REQUEST_URI' ];
$urlBase = dirname( $_SERVER[ 'PHP_SELF' ] );
$path = mb_substr( $url, mb_strlen( $urlBase ) );
$corpo = file_get_contents('php://input');
$dado = array();
mb_parse_str($corpo,$dado);

$urlToRedirect = 'http://localhost'.$urlBase.'/';

$navegador = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];

echo 'Teste htaccess';

?>