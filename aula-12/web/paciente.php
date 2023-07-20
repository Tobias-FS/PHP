<?php

class Paciente {
    
    public $id;
    public $nome;
    public $numeroSus;
    public $cpf;
    public $nascimento;

    function paraArray() {
        return get_object_vars( $this );
    }

    function deArray( array $dados ) {
        $this->id = isset( $dados[ 'id' ] ) ? $dados[ 'id' ] : 0;
        $this->nome = isset( $dados[ 'nome' ] ) ? $dados[ 'nome' ] : 0;
        $this->numeroSus = isset( $dados[ 'numeroSus' ] ) ? $dados[ 'numeroSus'] : 0;
        $this->cpf = isset( $dados[ 'cpf' ] ) ? $dados[ 'cpf' ] : 0;
        $this->nascimento = isset( $dados[ 'nacimento'] ) ? $dados[ 'nacimento'] : 0;
    }

}

?>