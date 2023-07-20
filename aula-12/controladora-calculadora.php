<?php

class ControladoraCalculadora {

    private $calculadora = null;
    private $visao;

    function __construct() {
        $this->calculadora = new Calculadora();
        $this->visao = new VisaoCalculadora();
    }

    function executar() {
        $numero1 = $this->visao->solicitarNumero();
        $numero2 = $this->visao->solicitarNumero();
        $operacao = $this->visao->solicitarOperacao();

        try {
            $resultado = $this->calculadora->calcular( $numero1, $numero1, $operacao );
            $this->visao->exibirResultado( $resultado );
        } catch( Exception $e ) {
            $this->visao->exibirMensagem( $e->getMessage() );
        }
    }

}

?>