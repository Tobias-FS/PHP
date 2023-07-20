<?php

class MateriaPrima9 {

    private $id;
    private $descricao;
    private $quantidade;
    private $custo;
    private $categoria;

    function __construct( $id, $descricao, $quantidade, $custo, $categoria ) {
        $this->setId( $id );
        $this->setDescricao( $descricao );
        $this->setQuantidade( $quantidade );
        $this->setCusto( $custo );
        $this->setCategoria( $categoria );
    }

    function setId( $id ) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setDescricao( $descricao ) {
        $this->descricao = $descricao;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setQuantidade( $quantidade ) {
        $this->quantidade =  $quantidade;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function setCusto( $custo ) {
        $this->custo =  $custo;
    }

    function getCusto() {
        return $this->custo;
    }

    function setCategoria( $categoria ) {
        $this->categoria =  $categoria;
    }

    function getCategoria() {
        return $this->categoria;
    }
}

?>