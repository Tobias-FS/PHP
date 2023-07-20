<?php

class Noticia {

    public $id = 0;
    public $titulo = '';
    public $criacao;
    public $conteudo = '';
    public $usuario;  

    function __construct( $id = 0, $titulo = '', $criacao, $conteudo = '', $usuario ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->criacao = $criacao;
        $this->conteudo = $conteudo;
        $this->usuario = $usuario;
    }
    
}

?>