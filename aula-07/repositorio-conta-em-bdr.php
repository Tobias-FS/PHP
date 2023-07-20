<?php
require_once 'repositorio-conta.php';
require_once 'conta.php';
require_once 'conta-exception.php';

class RepositorioContaEmBDR implements RepositorioConta {

    private $pdo = null;

    function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    function cadastrar( Conta $conta ) {

        try {
            $sql = 'INSERT INTO conta ( dono, cpf, senha, saldo )
                VALUES ( :dono, :cpf, :senha, :saldo )';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'dono'   => $conta->dono,
                'cpf'    => $conta->cpf,
                'senha'  => meuHash( $conta->senha ),
                'saldo'  => $conta->saldo
            ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException(
                'Erro ao cadastrar a conta.', $e->getCode(), $e );
        }
       
    }

    function todasAsContas() {
        try {
            $sql = 'SELECT id, dono, cpf, saldo FROM conta ';
            $ps = $this->pdo->prepare( $sql );
            $ps->setFetchMode( PDO::FETCH_ASSOC );
            $ps->execute();

            $contas = [];
            foreach ( $ps as $c ) {
                $contas []= new Conta(
                    $c[ 'id' ],
                    $c[ 'dono' ],
                    $c[ 'cpf' ],
                    '',
                    $c[ 'saldo' ]
                );

            }

            return $contas;

        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao buscar contas', $e->getCode(), $e );
        }

    }

    function depositar( $senha, $cpf, $valor ) {

        try {
            $sql = 'UPDATE conta SET saldo = saldo + :valor WHERE senha = :senha AND cpf = :cpf';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'valor' => $valor,
                'senha' => meuHash( $senha ),
                'cpf' => $cpf
            ] );

            if ( $ps->rowCount() > 1 ) 
                return false;
            else
               return true;

        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao realizar deposito', $e->getCode(), $e );
        }

    }

    function retirar( $senha, $cpf, $valor ) {

        try {

            $sql = 'UPDATE conta SET saldo = saldo - :valor WHERE senha = :senha AND cpf = :cpf';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'senha' => meuHash( $senha ),
                'cpf' => $cpf,
                'valor' => $valor 
            ] );
    
            if ( $ps->rowCount() > 1 )
                return false;
            else
                return true;
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao realizar uma retirada da conta', $e->getMessage(), $e );
        }


    }

    function depositoParaTranferencia( $cpf, $valor ) {

        try {
            $sql = 'UPDATE conta SET saldo = saldo + :valor WHERE cpf = :cpf';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'valor' => $valor,
                'cpf' => $cpf
            ] );

            if ( $ps->rowCount() > 1 )
                return false;
            else
                return true;


        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao realizar deposito na conta', $e->getMessage(), $e );
        }

    }

    function transferir( $cpfOrigem, $senhaOrigem, $cpfDestino, $valor ) {
        
        try {
            $this->pdo->beginTransaction();

            $status = $this->retirar( $senhaOrigem, $cpfOrigem, $valor);
            if ( ! $status ) {
                $this->pdo->rollBack();
                throw new ContaException( 'Conta origem inexistnete ou saldo insuficiente' );
            }

            $status = $this->depositoParaTranferencia( $cpfDestino, $valor );
            if ( ! $status ) {
                $this->pdo->rollBack();
                throw new ContaException( 'Conta origem inexistente' );
            }

            $this->pdo->commit();


            return true;
        } catch ( PDOException $e ) {
            $this->pdo->rollBack();
            throw new RepositorioException(
                'Erro ao realizar a transferência entre contas.', $e->getCode(), $e );

        }
    }
    
}


function meuHash( $conteudo ) {
    $conteudoComSal = '29372dsk#)@(#*' . $conteudo . '*&%¨&#@)#?+';
    return hash( 'sha256', $conteudoComSal );
}

?>