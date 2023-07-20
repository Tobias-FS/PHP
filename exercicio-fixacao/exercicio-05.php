<?php

$inventores = [
    [ "nome" => 'Albert', "sobrenome" => 'Einstein', "nasc" => 1879,
    "morte" => 1955 ],
    [ "nome" => 'Isaac', "sobrenome" => 'Newton', "nasc" => 1643,
    "morte" => 1727 ],
    [ "nome" => 'Galileo', "sobrenome" => 'Galilei', "nasc" => 1564,
    "morte" => 1642 ],
    [ "nome" => 'Nicolaus', "sobrenome" => 'Copernicus', "nasc" => 1473,
    "morte" => 1543 ],
    [ "nome" => 'Ada', "sobrenome" => 'Lovelace', "nasc" => 1815,
    "morte" => 1852 ]
];

function buscarNomeIdade( $arr ) {

    $novoArray = [];
    foreach ( $arr as $inv ) {
        $novoArray []= [ 'sobrenome' => $inv[ 'nome' ], 'viveu' => $inv[ 'morte' ] - $inv[ 'nasc' ] ];
    }

    return $novoArray;

}

// var_dump( buscarNomeIdade( $inventores ) );

function mediaDeAnosVividos( $arr ) {

    $soma = 0;
    foreach ( $arr as $inv ) {
        $soma += $inv[ 'morte' ] - $inv[ 'nasc' ];
    }

    return $soma / count( $arr );

}

// echo mediaDeAnosVividos( $inventores );

function seculoVivido( $arr, $seculo ) {
    $inicioDoSeculo = ( $seculo * 100 ) + 1;
    $fimDoSeculo = $inicioDoSeculo + 99;
    $novoArray = [];
    foreach ( $arr as $inv ) {
        if ( $inv[ 'nasc' ] >= $inicioDoSeculo && $inv[ 'nasc' ] <= $fimDoSeculo  )
            $novoArray []= $inv[ 'nome' ];
    }
    return $novoArray;
}

// var_dump( seculoVivido( $inventores, 18 ) );

// function ordernarArrayPeloSobrenome( $arr ) {
//     $novoArray = [];
//     foreach ( $arr as $inv ) {

//     }
// }

?>