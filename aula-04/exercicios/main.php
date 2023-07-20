<?php

require_once './produto.php';
require_once './produto-taxado.php';

const OPCAO_CADASTRAR = 1;
const OPCAO_LISTAR = 2;
const OPCAO_SAIR = 3;

$produtos = [];

do {

    echo 'MENU', PHP_EOL;
    echo '1 - Cadastrar', PHP_EOL;
    echo '2 - Listar', PHP_EOL;
    echo '3 - Sair', PHP_EOL;

    $opcao = readline( 'Digite a opção desejada: ' );

    switch ( $opcao ) {
        case OPCAO_CADASTRAR: cadastrar( $produtos ); break;
        case OPCAO_LISTAR: listar( $produtos ); break;
    }

} while ( $opcao != OPCAO_SAIR );

function cadastrar( &$produtos ) {

    $descricao = readline( 'Digite a descrição do produto: ' );
    $estoque = readline( 'Digite a quantidade do estoque do produto: ' );
    $preco = readline( 'Digite o preço do produto: ' );

    $produtoComImposto = readline( 'O produto é taxado ? ( S/N, sendo "S" para Sim e "N" para não ) ' );

    if ( $produtoComImposto == 'S' ) {
        $imposto = readline( 'Digite o valor do imposto: ' );
        $produtoTaxado = new ProdutoTaxado( $descricao, $estoque, $preco, $imposto );
        $produtos []= $produtoTaxado;
    } else {
        $produto = new Produto( $descricao, $estoque, $preco );
        $produtos []= $produto;
    }

}

function listar( $produtos ) {

    if ( empty( $produtos ) ) {
        echo 'Nenhum produto para ser listado!', PHP_EOL;
        return;
    }
    foreach( $produtos as $p ) {

        if ( $p instanceof ProdutoTaxado ) {
            echo 'Descrição: ' . $p->getDescricao() . ' '
                . 'Estoque: ' . $p->getEstoque() . ' '
                . 'Preço: ' . $p->getPreco(). ' '
                . 'Imposto: ' . $p->getImposto(), PHP_EOL;
        } else {
            echo 'Descrição: ' . $p->getDescricao() . ' '
                . 'Estoque: ' . $p->getEstoque() . ' '
                . 'Preço: ' . $p->getPreco(), PHP_EOL;
        }

    }

}

?>