<?php

require_once './produto.php';

const VALOR_MININO_DO_IMPOSTO = 0;
const VALOR_MAXIMO_DO_IMPOSTO = 50;

class ProdutoTaxado extends Produto {

    private $imposto = 0;

    function __construct( string $descricao, int $estoque, float $preco, int $imposto ) {
        parent::__construct( $descricao, $estoque, $preco );
        $this->setImposto( $imposto );
    }

    function setImposto( int $valor ) {
        if ( $valor < VALOR_MININO_DO_IMPOSTO && $valor > VALOR_MAXIMO_DO_IMPOSTO ) {
            echo 'O imposto (%) deve estar entre 0 e 50', PHP_EOL;
            return;
        } else
            $this->imposto = $valor;
    }

    function getImposto() {
        return $this->imposto;
    }

}

?>