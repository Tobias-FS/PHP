<?php

function dataPorExtenso( string $data ) {

    $meses = [
        1 => 'janeiro',
        'fevereiro',
        'março'
    ];

    $partes = explode( '/', $data );
    [ $dia, $mes, $ano ] = $partes;

    echo "{$dia} {$meses[ (int) $mes ]} {$ano}";

}

DataPorExtenso( "17/03/2023" );

?>