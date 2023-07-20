<?php

namespace Mma;

use PDOException;
use RepositorioException;

// use Lutador;

require_once './repositorio-lutador.php';
require_once './repositorio-exception.php';

class RepositorioLutadorEmBDR implements RepositorioLutador {

    private $pdo = null;

    function __construct( $pdo ) {
        $this->pdo = $pdo;
    }

    function cadastrar( \Lutador $lutador ) {
        try {
            $sql = 'INSERT INTO lutador ( nome, peso_em_quilos, altura_em_metros )
                    VALUES ( :nome, :peso_em_quilos, :altura_em_metros ) ';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'nome' => $lutador->nome,
                'peso_em_quilos' => $lutador->pesoEmQuilos,
                'altura_em_metros' => $lutador->alturaEmMetros
            ] );

            if ( $ps->rowCount() > 1 ) {
                return true;
            } else {
                return false;
            }

        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao cadastrar lutador', 0, $e );
        }
    }

    function remover( int $id ) {
        try {
            $sql = 'DELETE FROM lutador WHERE id = :id ';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [ 'id' => $id ] );
            if ( $ps->rowCount() < 1 ) {
                return false;
            } else {
                return true;
            }
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao remover lutador', 0, $e );
        }
        
    }

}

?>