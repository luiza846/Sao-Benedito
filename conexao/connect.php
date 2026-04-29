<?php

// carregar o arquivo txt

function loadEnv($arquivo){
    if(!file_exists($arquivo)){

    die("Arquivo não encontrado");

    }else{
        
    }
}

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->connect_error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->connect_error);
}

echo " Conexão realizada com sucesso";

?>

