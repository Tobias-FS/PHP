<?php

require_once './limparTela.php';

const OPCAO_SAIR = 0;
const OPCAO_INCLUIR = 1;
const OPCAO_REMOVER = 2;
const OPCAO_LISTAR = 3;

$nomes = [];

do {

    // limparTela();

    echo 'MENU', PHP_EOL;
    echo '0 - Sair', PHP_EOL;
    echo '1 - Incluir', PHP_EOL;
    echo '2 - Remover', PHP_EOL;
    echo '3 - Listar', PHP_EOL;

    $opcao = readline( 'Digite sua opção: ' );

    switch ( $opcao ) {
        case OPCAO_INCLUIR: incluirNome( $nomes ); break;
        case OPCAO_REMOVER: removerNome( $nomes ); break;
        case OPCAO_LISTAR: listarNomes( $nomes ); break;
    }

} while( $opcao != OPCAO_SAIR );

function incluirNome( array &$nomes ) {
    $nome = readline( 'Digite um nome: ' );
    $idade = readline( 'Digite a dade: ' );
    $nomes []= [ 'nome' => $nome, 'idade' => $idade ];
}

function listarNomes( array &$nomes ) {
    if ( empty( $nomes ) ) {
        echo 'Nenhum noma para ser listado', PHP_EOL;
        return;
    }
    sort( $nomes );
    foreach( $nomes as $n ) {
        echo "Nome: {$n[ 'nome' ]} -- Idade: {$n[ 'idade' ]}", PHP_EOL;
    }
}

function removerNome( array &$nomes ) {
    if ( empty( $nomes ) ) {
        echo 'Nenhum nome a ser removido';
        return;
    }
    $nome = readline( 'Digite o nome que deja remover: ' );
    $indice = null;
    
    foreach( $nomes as $chave => $valor ) {
        if ( $valor[ 'nome' ] === $nome ) {
            $indice = $chave;
            break;
        }
    }
   
    if ( $indice === null ) {
        echo 'Nome não encontrado', PHP_EOL;
        return;
    } else {
        unset( $nomes[ $indice ] );
        echo 'Removido com sucesso', PHP_EOL;
    }
}

?>