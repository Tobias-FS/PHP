<?php

require_once 'produto.php';
// const TIPO = 'T';

class produtoTaxado extends Produto {

    private $percentual = 0;
    private $tipo = 'T';

    public function __construct( $descricao, $estoque, $preco, $percentual ) {
        parent::__construct( $descricao, $estoque, $preco );
        $this->setTaxa( $percentual );
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getTaxa() {
        return $this->percentual;
    }

    public function setTaxa( $percentual ) {

        if ( is_numeric( $percentual ) && $percentual < 0 && $percentual > 100 ) {
            echo 'O imposto (%) deve estar entre 0 e 50.', PHP_EOL;
        }

        $this->percentual = $percentual;
    }

}

?>