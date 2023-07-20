<?php

require_once './paciente.php';

class VisaoPaciente {

    private function url() {
        return $_SERVER[ 'REQUEST_METHOD' ];
    }

    private function metodo() {
        return $_SERVER[ 'REQUEST_URI' ];
    }

    function desejaCadastrarPaciente() {
        $regex = '/^\/pacientes\/?/i';
        return $this->metodo() === 'POST' && preg_match( $regex, $this->url() );
    }

    function desejaObterPacientes() {
        $metodo = $_SERVER[ 'REQUEST_METHOD' ];
        $url = $_SERVER[ 'REQUEST_URI' ];

        $regex = '/^\/pacientes\/?/i';
        return $this->metodo() === 'GET' && preg_match( $regex, $this->url() );
    }

    function desejaRemoverPaciente( &$id ) {
        if ( $this->metodo() !== 'DELETE' ) {
            return false;
        }
        $regex = '/^\/pacientes\/([0-9]+)\/?$/i';
        $casamentos = [];
        $ok = preg_match( $regex, $this->url(), $casamentos );
        if ( $ok ) {
            $id = (int) $casamentos[ 1 ];
            return true;
        }
        return false;
    }

    function obterPaciente() {
        $dados = $_POST;
        foreach( $dados as &$valor ) {
            $valor = htmlspecialchars( $valor );
        } 
        $paciente = new Paciente();
        $paciente->deArray( $dados );
        return $paciente;
    }

    function enviarRespsotaDeSucesso( $idPaciente ) {
        http_response_code( 201 );
        die( $idPaciente );
    }

    function enviarRespsotaDeErro( $mensagem ) {
        http_response_code( 500 );
        die( $mensagem );
    }

    function enviarPaciente( $paciente ) {
        header( 'Content-Type: applicatioin/json' );
        return json_encode( $paciente );
    }

    function indicarPacienteRemovido() {
        http_response_code( 204 );
        die();
    }

}

?>