<?php

require_once 'produto.php';
require_once 'produto-taxado.php';
const TAXADO = 'T';
const NAO_TAXADO = 'NT';

$produtos = [];

do {
    $opcao = menu();

    switch( $opcao ) {
        case 1 : cadastrar( $produtos ); break;
        case 2 : listar( $produtos); break; 
    }

} while( $opcao !== 3 );

function cadastrar( &$produtos ) {

    $taxado = readLine( 'Produto é taxado S/N ( "S" para Sim e "N" para não) ' );

    $p = null;
    if ( $taxado === 'S' ) {
        $descricao = readLine( 'Digite a descrição do produto: ' );
        $estoque = readLine( 'Digite a qtd do estoque: ' );
        $preco = readLine( 'Digite o preco do produto: ' );
        $taxa = readLine( 'Informe o percentual do imposto do produto: ' );

        $p = new produtoTaxado( $descricao, $estoque, $preco, $taxa );

        $produtos []= $p;
        return;
    
    }

        $descricao = readLine( 'Dgite a descrição do produto: ' );
        $estoque = readLine( 'Dgite a qtd do estoque: ' );
        $preco = readLine( 'Dgite o preco do produto: ' );

        $p = new Produto( $descricao, $estoque, $preco );

        $produtos []= $p;
    
}

function listar( &$produtos ) {

    foreach ( $produtos as $produto ) {

        if ( $produto->getTipo() === TAXADO ) {
            echo 'Descrição ' . $produto->getDescricao(), PHP_EOL;
            echo 'Estoque ' . $produto->getEstoque(), PHP_EOL;
            echo 'Preco ' . $produto->getPreco(), PHP_EOL;
            echo 'Taxa ' . $produto->getTaxa(), PHP_EOL;
        } else {
            echo 'Descrição ' . $produto->getDescricao(), PHP_EOL;
            echo 'Estoque ' . $produto->getEstoque(), PHP_EOL;
            echo 'Preco ' . $produto->getPreco(), PHP_EOL;
        }

        echo PHP_EOL;
    }

}

function menu() {
    echo 'Digite:', PHP_EOL;
    echo ' 1 - Cadastrar', PHP_EOL;
    echo ' 2 - Listar', PHP_EOL;
    echo  ' 3 - para sair', PHP_EOL;
    return readline( 'Opção: ' );

}

?>