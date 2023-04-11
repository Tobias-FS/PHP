<?php

namespace Acme;

class Produto {

    private $codigo;
    private $descricao;
    private $estoque;
    private $preco;

    public function __construct( $codigo, $descricao, $estoque, $preco ) {

        $this->setCodigo( $codigo );
        $this->setDescricao( $descricao );
        $this->setEstoque( $estoque );
        $this->setPreco( $preco );

    }

    public function getCodigo() {
        return $this->codigo;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setCodigo( $valor ) {
        $this->codigo = $valor;
    }

    public function setDescricao( $valor ) {
        $this->descricao = $valor;
    }

    public function setEstoque( $valor ) {

        if ( $valor < 0 )
            throw new \Exception( 'Estoque deve ser um valor postivo.' );

        $this->estoque = $valor;
    }

    public function setPreco( $valor ) {
        $this->preco = $valor;
    }

    public function aumentarEstoque( $valor ) {
        $this->estoque += $valor;
    }

    public function diminuirEstoque( $valor ) {
        $this->estoque -= $valor;
    }

}

?>