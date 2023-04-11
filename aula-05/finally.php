<?php

function dividir( $a, $b ) {
    if ( $b == 0 ) {
        throw new Exception( 'Divisão por zero não permitida' );
    }

    return $a / $b;
}

function x() {
    $numero = readline( 'Número: ' );

    try {
        return dividir( 100, $numero );
    } catch ( \Exception $e ) {
        echo $e->getMessage();
    } finally {
        echo 'Terminado';
    }
}