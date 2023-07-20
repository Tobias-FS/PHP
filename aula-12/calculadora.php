<?php

const ADICAO = '+';
const SUBTRACAO = '-';
const MULTIPLICACAO = '*';
const DIVISAO = '/';

class Calculadora {
    
    function calcular( $n1, $n2, $operacao ) {
        switch( $operacao ) {
            case ADICAO: return $n1 + $n2;
            case SUBTRACAO: return $n1 - $n2;
            case MULTIPLICACAO: return $n1 * $n2;
            case DIVISAO: return $n1 / $n2; 
            default : throw new RuntimeException( 'Operção não suportada' );
        }
    }
}

?>