<?php

$contatos = [
    [ 'telefone' => '30044000' ],
    [ 'telefone' => '2225271727' ],
    [ 'telefone' => '22987654321' ],
    [ 'telefone' => '08007024000' ],
    [ 'telefone' => '2225271727' ],
    [ 'telefone' => '22987654321' ],
    [ 'telefone' => '08007024000' ],
    [ 'telefone' => '2225271727' ],
    [ 'telefone' => '22987654321' ],
    [ 'telefone' => '08007024000' ],
    [ 'telefone' => '(22) 2527-2717' ]

];

function formatarArrayDeNumeros( &$contatos ) {

    foreach( $contatos as &$valor ) {
        $valor = formatarNumero( $valor[ 'telefone' ] );
        echo $valor, PHP_EOL;
    }

    // $unicos = [];

    // foreach ( $contatos as $valor ) {

    // }

    // echo str_repeat( '-', 40 ), PHP_EOL;
    // $c = array_unique( $contatos );
    // foreach( $c as &$valor ) {
    //     echo $valor, PHP_EOL;
    // }

}

function formatarNumero( $numero ) {

    $tamanho = strlen( $numero );
    
    if ( ! is_numeric( $numero ) ||  $tamanho < 8 || ( $tamanho > 8 && $tamanho < 10 ) || $tamanho > 11 ) {
        return $numero;
    }

    switch( $tamanho ) {
        case 8 :
            return mb_substr( $numero, 4 ) . ' '. mb_substr( $numero, 4, 4 );
        case 10 :
            return  '('.mb_substr( $numero, 0, 2 ).')' . ' ' .mb_substr( $numero, 2, 4, ) . '-'. mb_substr( $numero, 4, 4 );
        case 11 : {
            if ( (int) mb_substr( $numero, 1, 1 ) === 8 || (int) mb_substr( $numero, 1, 1 ) === 3 ) {
                return mb_substr( $numero, 0, 4 ) . ' ' . mb_substr( $numero, 4, 3 ) . ' '. mb_substr( $numero, 7 );
            }
            return '('.mb_substr( $numero, 0, 2 ).')' . ' ' .mb_substr( $numero, 2, 1, ) . '-' . mb_substr( $numero, 2, 4, ) . '-'. mb_substr( $numero, 4, 4 );
        }
            // case 11 :
        //     return mb_substr( $numero, 4 ) . ' '. mb_substr( $numero, 4, 4 );
    }
}

// mr_substr
// $numero = readline( 'Informe um numero: ');
// echo formatarNumero( $numero );

formatarArrayDeNumeros( $contatos );

?>