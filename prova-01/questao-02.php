<?php

// LETRA A

$pdo = null;
try {
    $pdo = new PDO( 'mysql:dbname=mma;host=localhost;charset=utf8', 'root', 'R_oot2121',
            [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ] );
} catch ( PDOException $e ) {
    die ( 'Erro ao conectar ao banco de dados' . $e->getMessage() );
}

function listarLutadores( $pdo ) {
    try {
        $sql = 'SELECT * from lutador';
        $ps = $pdo->prepare( $sql );
        $ps->execute();
        $lutadores = [];

        foreach( $ps as $reg ) {
            $lutadores []= [
                'id' => $reg[ 'id' ],
                'nome' => $reg[ 'nome' ],
                'pesoEmQuilos' => $reg[ 'peso_em_quilos' ],
                'alturaEmMetros' => $reg[ 'altura_em_metros' ]
            ];
        }
        return $lutadores;
    } catch( PDOException $e ) {
        throw new PDOException( $e->getMessage(), 0 );
    }
}

$lutadores = listarLutadores( $pdo );

foreach( $lutadores as $p ) {
    echo    'Id: ' . $p[ 'id' ] . ' '
            . 'Nome: ' . $p[ 'nome' ] . ' '
            . 'Peso: ' . $p[ 'pesoEmQuilos' ] . ' '
            . 'Alura: ' . $p[ 'alturaEmMetros' ], PHP_EOL;
}

?>