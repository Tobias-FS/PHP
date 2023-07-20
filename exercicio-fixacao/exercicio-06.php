<?php

$dados = [ 
    'carro', 'carro', 'caminhão', 'caminhão', 'bicicleta',
    'caminhada', 'carro', 'van', 'bicicleta', 'caminhada', 'carro',
    'van', 'carro', 'caminhão' 
];

// function numeroDeOcorrencias( $arr ) {
//     $novoArray = [];
//     foreach ( $arr as $dados ) {
//         if ( array_key_exists( $dados, $novoArray ) )
//             $novoArray[ $dados ] []= $novoArray[ $dados ] += 1;
//         $novoArray []= [ $dados => 1 ] ;
//     }
//     return $novoArray;
// }

function numeroDeOcorrencias( $arr ) {
    $novoArray = [];
    foreach ( $arr as $dados ) {
        if ( array_key_exists( $dados, $novoArray ) )
            $novoArray[ $dados ] += 1;
        else
            $novoArray[ $dados ] = 1 ;
    }
    return $novoArray;
}

var_dump( numeroDeOcorrencias( $dados ) );

?>