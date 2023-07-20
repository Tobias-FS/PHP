<?php

class Produto {

    public $id = 0;
    public $codigo = '';
    public $descricao = '';
    public $estoque = 0;
    public $preco = 0.00;

    public function __construct(  $id = 0, $codigo = '', $descricao = '', 
    $estoque = 0, $preco = 0.00 ) {
         
        $this->id = $id;
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->estoque = $estoque;
        $this->preco = $preco;

     }


}

?>