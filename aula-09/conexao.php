<?php

// namespace aula09;

function conectar() {
    return new PDO( 'mysql:dbname=acme;host=localhost;charset=UTF8', 'root','R_oot2121',
    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]  ); 
}

?>