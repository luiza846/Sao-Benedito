<?php

$usuario = 'root';
$senha = '';
$database = 'igreja_conecta';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}

echo " Conexão realizada com sucesso";

?>

