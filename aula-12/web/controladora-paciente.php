<?php

require_once './visao-paciente.php';
require_once './repositorio-exception.php';
require_once './paciente.php';
require_once './repositorio-paciente-em-bdr.php';


class ControladoraPaciente {

    private $visao = null;
    private $repositorio = null;

    function __construct( PDO $pdo ) {
        $this->repositorio = new RepositorioPacienteEmBDR( $pdo );
        $this->visao = new VisaoPaciente();
    }

    function cadastrar() {
        if ( $this->visao->desejaCadastrarPaciente() ) {
            $paciente = $this->visao->obterPaciente();

            try {
                $this->repositorio->adicionar( $paciente );
                $this->visao->enviarRespsotaDeSucesso( $paciente->id );
                return true;
            } catch ( RepositorioException $re ) {
                // file_put_contents( 'log.txt', json_decode( [
                //     'mensagem' => $re->getMessage(),
                //     'codigo' => $re->getCode()
                // ] ) );
                $this->visao->enviarRespsotaDeErro( $re->getMessage() );
            }
        } 
        return false;
    }

    function obter() {
        if ( $this->visao->desejaObterPacientes() ) {
            try {
                $pacientes = $this->repositorio->todos();
                $this->visao->enviarPaciente( $pacientes );
                return true;
            } catch ( RepositorioException $re ) {
                $this->visao->enviarRespsotaDeErro( $re->getMessage() );
            }
        }
        return false;
    }

    function remover() {
        $id = 0;
        if ( $this->visao->desejaRemoverPaciente( $id ) ) {
            try {
                $this->repositorio->removerPeloId( $id ); 
                $this->visao->indicarPacienteRemovido();
            } catch ( RepositorioException $re ) {
                $this->visao->enviarRespsotaDeErro( $re->getMessage() );
            }
        }
    }

}

?>