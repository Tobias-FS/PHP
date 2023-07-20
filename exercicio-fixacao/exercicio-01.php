<?php

$data = '21/09/2017';

function dataFormatada( $data ) {
    
    $meses = [
        1 => 'janeiro',
        'feveriro',
        'março',
        'abril',
        'maio',
        'junho',
        'julho',
        'agosto',
        'setembro',
    ];

    $partes = explode( '/', $data );

    return $partes[0] . ' de ' . $meses[ (int) $partes[1]] . ' de ' . $partes[2]; 
}

echo dataFormatada( $data );

?>