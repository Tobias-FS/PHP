<?php

class Categoria9 {

    private $id;
    private $nome;
    
    function __construct(  $id, $nome ) {
        $this->setNome( $nome );
        $this->setId( $id );
    }

    function setId( $id ) {
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function setNome( $nome ) {
        $this->nome = $nome;
    }

    function getNome() {
        return $this->nome;
    }

}

?>