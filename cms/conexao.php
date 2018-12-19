<?php

//$conexao = mysqli_connect("192.168.0.2", "pc120181", "senai127", "dbpc120181");
$conexao = mysqli_connect("localhost", "root", "bcd127", "db_padaria");
mysqli_set_charset($conexao, "utf8");

if ($conexao){
    return($conexao);
} else {
    die ("Erro ao conectar no banco de dados!");
}

?>