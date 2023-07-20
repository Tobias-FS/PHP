<?php

namespace Acme;

use Exception;

class Produto {

    private $codigo = 0;
    private $descricao = '';
    private $estoque = 0;
    private $preco = 0;

    function __construct( $codigo, $descricao, $estoque, $preco ) {
        $this->setCodigo( $codigo );
        $this->setDescricao( $descricao );
        $this->setEstoque( $estoque );
        $this->setPreco( $preco );
    }

    function getCodigo() { return $this->codigo; }
    function setCodigo( $valor ) {
        $this->codigo = $valor;
    }

    function getDescricao() { return $this->descricao; }
    function setDescricao( $valor ) {
        $this->descricao = $valor;
    }

    function getEstoque() { return $this->estoque; }
    function setEstoque( $valor ) {

        if ( $valor < 0 ) {
            throw new Exception( 'O valor do estoque não pode ser um numero negativo' );
        }

        $this->estoque = $valor;
    }

    function getPreco() { return $this->preco; }
    function setPreco( $valor ) {
        $this->preco = $valor;
    }

}

?>