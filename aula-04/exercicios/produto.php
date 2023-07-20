<?php

const TAMANHO_MINIMO_DA_DESCRICAO = 2;
const TAMANHO_MAXIMO_DA_DESCRICAO = 100;
const VALOR_MINIMO_D0_ESTOQUE = 0;
const VALOR_MINIMO_D0_PRECO = 10;

class Produto {

    private $descricao = '';
    private $estoque = 0;
    private $preco = 0;

    function __construct( string $descricao, int $estoque, float $preco ) {
        $this->setDescricao( $descricao );
        $this->setEstoque( $estoque );
        $this->setPreco( $preco );
    }

    function setDescricao( string $valor ) {
        $tam = mb_strlen( $valor );
        
        if ( $tam < TAMANHO_MINIMO_DA_DESCRICAO && $tam > TAMANHO_MAXIMO_DA_DESCRICAO ) {
            echo 'A descrição deve ter de 2 a 100 caracteres', PHP_EOL;
            return;
        } else {
            $this->descricao = $valor;
        }
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setEstoque( int $valor ) {

        if ( $valor < VALOR_MINIMO_D0_ESTOQUE  ) {
            echo 'O estoque deve ser maior que zero', PHP_EOL;
            return;
        } else
            $this->estoque = $valor;
    }

    function getEstoque() {
        return $this->estoque;
    }

    function setPreco( float $valor ) {

        if ( $valor < VALOR_MINIMO_D0_PRECO ) {
            echo 'O minmo para o produto é de R$10,00', PHP_EOL;
            return;
        } else
            $this->preco = $valor;
    }

    function getPreco() {
        return $this->preco;
    }
}

?>