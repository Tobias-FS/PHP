<?php

function criarConexao() {
    return new PDO( 'mysql:dbname=mma;host=localhost;charset=utf8', 'root', 'R_oot2121',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ] );
}

?>