<?php

require_once 'produto.php';
require_once 'repositorio-produto-em-csv.php';


use Acme\Produto;

const AUMENTAR_ESTOQUE = 1;
const DIMINUIR_ESTOQUE = 2;
const SALVAR_PRODUTOS = 3;
const CARREGAR_PRODUTOS = 4;
const LISTAR = 5;
const SAIR = 6;

$produtos = [
    new Produto( 001, 'Fanta', 13, 4.50 ),
    new Produto( 002, 'Goiaba', 13, 4.50 ),
    new Produto( 003, 'Banana', 13, 4.50 ),
    new Produto( 004, 'Guarana', 3, 2.50 )
];

do {

    $opcao = menu();

    switch ( $opcao ) {

        case AUMENTAR_ESTOQUE: aumentarEstoque( $produtos ); break;
        case DIMINUIR_ESTOQUE: diminuirEstoque( $produtos ); break;
        case LISTAR: listar( $produtos ); break;
        case SALVAR_PRODUTOS: salvarProdutos( $produtos ); break;
        case CARREGAR_PRODUTOS: carregarProdutos( $produtos ); break;

    } 

} while ( $opcao != SAIR );

function menu() {

    echo 'Menu', PHP_EOL;
    echo '1 - Aumentar estoque', PHP_EOL;
    echo '2 - Diminuir estoque', PHP_EOL;
    echo '3 - Salvar produtos', PHP_EOL;
    echo '4 - Carregar produtos', PHP_EOL;
    echo '5 - Listar estoque', PHP_EOL;
    echo '6 - Sair', PHP_EOL;

    return readline( 'Opção: ' );

}

function aumentarEstoque( &$produtos ) {

    $codigo = readline( "Codigo do produto desejado: \n" );
    $quantidade = readline( "Quantidade a set aumentada: \n" );

    foreach ( $produtos as $p ) {
        
        if ( $p->getCodigo() == $codigo )
            $p->aumentarEstoque( $quantidade );
    }

}

function diminuirEstoque( &$produtos ) {

    $codigo = readline( "Codigo do produto desejado: \n" );
    $quantidade = readline( "Quantidade a set aumentada: \n" );

    foreach ( $produtos as $p ) {
        
        if ( $p->getCodigo() == $codigo )
            $p->diminuirEstoque( $quantidade );
    }

}

function listar( $produtos ) {

    foreach ( $produtos as $p ) {
        echo 'Codigo: ', $p->getCodigo(), ' Descrição: ', $p->getDescricao(), ' Estoque: ', $p->getEstoque(), ' Preço: ', $p->getPreco(), PHP_EOL;
    }

}

function salvarProdutos( &$produtos ) {

    $cvs = new RepositorioProdutoEmCsv();
    $cvs->salvar( $produtos );

}

function carregarProdutos( array &$produtos ) {

    $cvs = new RepositorioProdutoEmCsv();
    $produtos = $cvs->carregar();

}

?>