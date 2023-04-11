<?php
const OPCAO_INCLUIR = '1';
const OPCAO_REMOVER = '2';
const OPCAO_LISTAR = '3';
const OPCAO_SAIR = '4';

$pessoas = [];

function menu() {
    echo 'OPÇÕES:', PHP_EOL;
    echo '1 - Incluir pessoa', PHP_EOL;
    echo '2 - Remover pessoa', PHP_EOL;
    echo '3 - Listar pessoas', PHP_EOL;
    echo '4 - Sair', PHP_EOL;
    echo '> ';
    return readline( '' );
}


function incluir( &$pessoas ) {
    $nome = readline( 'Nome: ' );
    $idade = readline( 'Idade: ' );
    // is_int OU is_numeric para testar a idade
    $p = [ 'nome' => $nome, 'idade' => $idade ];
    $pessoas []= $p; // Ou array_push( $pessoas, $p );
}


function remover( &$pessoas ) {
    $nome = readline( 'Nome a remover: ' );
    $indice = -1; // Não encontrado por padrão
    foreach ( $pessoas as $i => $p ) { // $p será um array com os dados
        if ( $p[ 'nome' ] === $nome ) { // Encontrou o nome ?
            $indice = $i; // Guarda o índice
            break; // Sai do laço
        }
    }
    if ( $indice > -1 ) { // Encontrado
        unset( $pessoas[ $indice ] );
    } else {
        echo 'Não encontrado.', PHP_EOL;
    }
}


function listar( &$pessoas ) {
    usort( $pessoas, function( $p1, $p2 ) {
        if ( $p1[ 'nome' ] === $p2[ 'nome' ] ) {
            return 0;
        } else if ( $p1[ 'nome' ] > $p2[ 'nome' ] ) {
            return 1;
        }
        return -1;
    } );

    echo 'PESSOAS:', PHP_EOL;
    foreach ( $pessoas as $i => $p ) {
        echo $i + 1, ' - ', $p[ 'nome' ], ', ', $p[ 'idade' ], ' anos.', PHP_EOL;
    }
}


do {
    $opcao = menu();
    switch ( $opcao ) {

        case OPCAO_INCLUIR: {
            incluir( $pessoas );
            break;
        }

        case OPCAO_REMOVER: {
            remover( $pessoas );
            break;
        }

        case OPCAO_LISTAR: {
            listar( $pessoas );
            break;
        }
    }

} while ( $opcao != OPCAO_SAIR );

?>