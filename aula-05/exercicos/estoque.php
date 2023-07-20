<?php

require_once './repositorio-prduto-em-csv.php';
require_once './produto.php';

use \Acme\Produto;

const OPCAO_AUMENTAR_ESTOQUE = 1;
const OPCAO_REDUZIR_ESTOQUE = 2;
const OPCAO_SALVAR_PRODUTOS = 3;
const OPCAO_SAIR = 4;

$produtos = [ 
    new Produto( 1 ,'Produto1', 10, 23 ),
    new Produto( 2,'Produto1', 10, 23 ),
    new Produto( 3,'Produto1', 10, 23 ),
    new Produto( 4,'Produto1', 10, 23 ),

 ];

do {

    echo 'MENU', PHP_EOL;
    echo '1 - Aumentar o estoque', PHP_EOL;
    echo '2 - Reduzir o estoque', PHP_EOL;
    echo '3 - Salvar produtos', PHP_EOL;
    echo '4 - Sair', PHP_EOL;

    $opcao = readline( 'Digite a opção desejada: ' );

    switch ( $opcao ) {
        case OPCAO_AUMENTAR_ESTOQUE: aumentarEstoque( $produtos ); break;
        case OPCAO_REDUZIR_ESTOQUE: diminuirEstoque( $produtos ); break;
        case OPCAO_REDUZIR_ESTOQUE: diminuirEstoque( $produtos ); break;
        case OPCAO_SALVAR_PRODUTOS: salvarProdtuos( $produtos ); break;
    }

} while( $opcao !== OPCAO_SAIR );

function listar( $produtos ) {

    if ( empty( $produtos ) ) {
        echo 'Sem produtos para listar!', PHP_EOL;
        return;
    } else {
        foreach( $produtos as $p ) {
            echo 'Código: ' . $p->getCodigo() . ' '
                . 'Descrição: ' . $p->getDescricao() . ' '
                . 'Estoque: ' . $p->getEstoque() . ' '
                . 'Preço: ' . $p->getPreco(), PHP_EOL;
        }
    }

}

function aumentarEStoque( &$produtos ) {

    listar( $produtos );

    $codigo = readline( 'Digite o código do produto que deseja alterar o estoque: ' );
    $quantida = readline( 'Digite a quantidade de novos produtos: ' );

    foreach( $produtos as $p ) {
        if ( $p->getCodigo() == $codigo ) {
            $estoque = $p->getEstoque();
            $p->setEstoque( $estoque += $quantida );
            echo 'Alterado com sucesso!', PHP_EOL;
            return;
        } else {
            echo 'Prodstuo não econtrado!', PHP_EOL;
            return;
        }
    }

}

function diminuirEstoque( &$produtos ) {

    listar( $produtos );

    $codigo = readline( 'Digite o código do produto que deseja alterar o estoque: ' );
    $quantida = readline( 'Digite a quantidade de novos produtos: ' );

    if ( empty( $produtos ) ) {
        echo 'Nenhum produto para ser retirado', PHP_EOL;
        return;
    } else {
        foreach ( $produtos as $p ) {
            if ( $p->getCodigo() == $codigo ) {
                $estoque = $p->getEstoque();
                $p->setEStoque( $estoque -= $quantida );
                echo 'Alterado com sucesso!', PHP_EOL;
                return;
            } else {
                echo 'Prodstuo não econtrado!', PHP_EOL;
                return;
            }
        }
    }

}

function salvarProdtuos( &$produtos ) {
    $repositorio = new RepositorioPrdutoEmCsv();
    $repositorio->salvar( $produtos );
}

?>