<?php

require_once './controladora-paciente.php';

$pod = null;
try {
    $pdo = new PDO( 'mysql:dbname=acme;host=localhost;charset=UTF8', 'root','R_oot2121',
    [   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]  ); 
} catch ( PDOException ) {
    http_response_code( 500 );
    die( 'Erro ao conectar ao banco de dados' );
}

$controldora = new ControladoraPaciente( $pdo );
$controldora->cadastrar() || $controldora->obter();

?>