<?php

function conectar() {
    return new PDO( 'mysql:dbname=acme;host=localhost;charset=utf8',
    'root', 'R_oot2121', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ] );
}

?>