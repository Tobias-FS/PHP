<?php

class VisaoCalculadora {

    function solicitarNumero() {
        $numero = readline( 'Numero:' );
        return (int) $numero;
    }

    function solicitarOperacao() {
        $operacao = readline( 'Numero:' );
        return $operacao;
    }

    function exibirResultado( $resultado ) {
        echo 'Resultado', $resultado;
    }

    function exibirMensagem( $mensagem ) {
        echo $mensagem;
    }

}

?>