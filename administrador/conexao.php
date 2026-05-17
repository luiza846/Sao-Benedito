<?php

$usuario = 'igreja_conecta';
$senha = 'Church7bd@';
$database = 'igreja_conecta';
$host = 'igreja_conecta.mysql.dbaas.com.br';

$conexao = new mysqli($host, $usuario, $senha, $database) or die ('Não foi possível realizar a conexão!');

?>