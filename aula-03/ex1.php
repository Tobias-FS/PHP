<?php

function dataPorExtenso( $data ) {
    
    $mes = [ 1 => 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho' ];

    $partes = explode( '/', $data );

    // $dataPorEstenso = [ $partes[ 0 ], ' de ', $mes[ ( int ) $partes[ 1 ] ], ' de ' , $partes[ 2 ]];

    // return $res = implode( ' ', $dataPorEstenso );

    return $partes[ 0 ]. ' de '. $mes[ ( int ) $partes[ 1 ] ]. ' de ' . $partes[ 2 ];


}

$data = readline( 'Informe uma data (dd/mm/aa): ');

echo dataPorExtenso( $data ), PHP_EOL;

?>