<?php

require_once './paciente.php';
require_once './repositorio-paciente.php';

class RepositorioPacienteEmBDR implements RepositorioPaciente {

    private $pdo = null;

    function __construct( $pdo ) {
        $this->pdo = $pdo;
    }
    
    function adicionar( Paciente &$p ) {
        $sql = 'INSERT INTO paciente ( nome, numeroSus, cpf, nascimento )
            VALUES ( :nome, :numeroSus, :cpf, :nascimento )';
        try {
            $ps = $this->pdo->prepare( $sql );
            $dados = $p->paraArray();
            unset( $dados[ 'id' ] );
            $ps->execute( $dados );
        } catch( PDOException $e ) {
            throw new RepositorioException( 'erro', $e->getCode(), $e );
        }
    }

    function removerPeloId( $id ) {
        try {
            $ps = $this->pdo->prepare( 'DELETE FROM paciente WHERE id = ?' );
            $ps->execute( $id );
        } catch( PDOException $e ) {
            throw new RepositorioException( 'erro', $e->getCode(), $e );
        }
    }

}

?>