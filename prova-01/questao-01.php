<?php

require_once 'pereciveis.csv';

const ARQUIVO = 'pereciveis.csv';
const DIA_ATUAL = '05/05/2023';

$conteudo = file_get_contents( ARQUIVO );
$linhas = explode( "\n", $conteudo );
array_shift( $linhas );

$produtos = [];
foreach( $linhas as $l ) {
    $produto = explode( ';', $l );
    $produtos []= [ $produto[ 0 ], $produto[ 1 ] ];
}

[ $diaA, $mesA, $anoA ] = explode( '/', DIA_ATUAL );;

foreach( $produtos as $p ) {
    // $partesValidade = explode( '/', $p[1] );
    // [ $diaP, $mesP, $anoP ] = $partesValidade;
    [ $diaP, $mesP, $anoP ] = explode( '/', $p[1] );
    if ( $anoP > $anoA ) {
        echo 'Produto ' . $p[ 0 ] . ' ' . 'Validade ' . $p[ 1 ], PHP_EOL;
    } else if ( $mesP > $mesA ) {
        echo 'Produto ' . $p[ 0 ] . ' ' . 'Validade ' . $p[ 1 ], PHP_EOL;
    } else if ( $diaP > $diaA ) {
        echo 'Produto ' . $p[ 0 ] . ' ' . 'Validade ' . $p[ 1 ], PHP_EOL;
    }
}

?>