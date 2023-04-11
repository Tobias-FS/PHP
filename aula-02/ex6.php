<?php

require_once 'limparTela.php';

const OPCAO_INCLUIR = '1';
const OPCAO_REMOVER = '2';
const OPCAO_LISTAR = '3';
const OPCAO_ALTERAR = '4';
const OPCAO_SAIR = '5';
$cadastro = [];

do {
    $opcao = menu();
    limparTela();
    
    switch( $opcao ) {
        case OPCAO_INCLUIR:
            incluirNome( $cadastro ); break;
        
        case OPCAO_REMOVER:
            removerNome( $cadastro ); break;
        
        case OPCAO_LISTAR:
            listarNomes( $cadastro ); break;
        
        case OPCAO_ALTERAR:
            alterarNomes( $cadastro ); break;

    }
    
} while ( $opcao != OPCAO_SAIR );

function menu() {
    echo 'Digite:', PHP_EOL;
    echo ' 1 - Incluir nome', PHP_EOL;
    echo ' 2 - Remover nome', PHP_EOL;
    echo ' 3 - Listar nome', PHP_EOL;
    echo ' 4 - Alterar nome', PHP_EOL;
    echo  ' 5 - para sair', PHP_EOL;
    return readline( 'Opção: ' );

}

function incluirNome( &$cadastro ) {
    $nome = readline( 'Digite um nome: ' );
    $idade = readline( 'Digite a idade: ' );
    if ( ! is_numeric( $idade ) );{
        echo 'Digite apenas numeros', PHP_EOL;
        // Como fazer retornar
    }        
    $pessoa = [ 'nome' => $nome, 'idade' => $idade ];
    $cadastro []= $pessoa;
}

function removerNome( &$cadastro) {
    $nome = readline( 'Digite um nome: ' );
    $indice = -1; //Não encontrado por padrão
    foreach ( $cadastro as $chave => $valor ) {
        if ( $valor[ 'nome' ] === $nome ) {
            $indice = $chave;
            break;
        }
    };
    if ( $indice > -1 ) 
        unset( $cadastro[ $indice ]  );
        
}

function listarNomes( &$cadastro ) {

    if ( empty( $cadastro ) ) {
        echo 'Nenhum nome encontrado', PHP_EOL;
    }
    echo 'Nomes existentes: ', PHP_EOL;
    
    usort( $cadastro, function( $a, $b ) {
        if ($a['nome'] === $b['nome']) {
            return 0;
        } elseif ($a['nome'] > $b['nome']) {
            return 1;
        }
        return -1;
    });
    foreach ( $cadastro as $chave => $valor ) {
        echo 'Nome: ', $valor[ 'nome' ], PHP_EOL;
        echo 'Idade: ', $valor[ 'idade' ], PHP_EOL;
        echo 'Indice: ', $chave, PHP_EOL;
    }
}

function alterarNomes( &$cadastro ) {
    
    $indice = readline( 'Digite o indice da pessoa que deseja alterar: ');
    $nome = readline( 'Nome: ' );
    $idade = readline( 'Idade: ' );

    $cadastro[ $indice ][ 'nome' ] = $nome;
    $cadastro[ $indice ][ 'idade' ] = $idade;

}

?>