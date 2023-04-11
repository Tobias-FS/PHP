<?php

const TAMANHO_MININO_DESCRICAO = 2;
const TAMANHO_MAXIMO_DESCRICAO = 2;
const TIPO = 'NT';

class Produto {


    private $descricao = '';
    private $estoque = 0;
    private $preco = 0.00;
    private $tipo = 'NT';

    public function __construct( $descricao, $estoque, $preco ) {
        
        $this->setDescricao( $descricao );
        $this->setEstoque( $estoque );
        $this->setPreco( $preco );

    }

        public function getTipo() {
            return $this->tipo;
        }
    

    public function getDescricao() {
        return $this->descricao;
    }


    public function setDescricao( $valor ) {
        $tamanho = mb_strlen( $valor );

        if ( $tamanho <= TAMANHO_MININO_DESCRICAO && $tamanho >= TAMANHO_MAXIMO_DESCRICAO ) {
            echo 'A descricão deve estar entre 2 a 100 caracteres', PHP_EOL;
            return;
        }
        $this->descricao;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    public function setEstoque( $valor ) {

        if ( is_numeric( $valor ) && $valor >= 0 ) {
            $this->estoque = $valor;
            return;
        }

        echo 'Estoque tem que ser um número acima de 0', PHP_EOL;

    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco( $valor ) {

        if ( is_numeric( $valor ) && $valor > 10.0 ) {
            $this->preco = $valor;
            return;
        }

        echo 'O preço minimo é 10 reais ', PHP_EOL;
    }
}