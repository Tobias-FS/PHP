<?php

$telefones = [
    '30044000',
    '2225271727',
    '22987654321',
    '08007024000',
    '03007024000',
    '30044000',
    '2225271727',
    '22987654321',
    '08007024000',
    '03007024000'
];

function telefonesRepetidos( $arr ) {
    $novoArray = [];
    foreach ( $arr as $tel ) {
        if ( ! in_array( $tel, $novoArray ) )
            $novoArray []= $tel;     
    } 

    return $novoArray;
}

var_dump( telefonesRepetidos( $telefones ) );

?>