<?php

require_once './repositorio-categoria.php';
require_once './categoria.php';

class RepositorioCategoriaEmBDR9 implements RepositorioCategoria9 {
    
    private $pdo = null;

    function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }
    
    function listar() {

        $sql = 'SELECT id, nome FROM categoria';
        $ps = $this->pdo->prepare( $sql );
        $ps->setFetchMode( \PDO::FETCH_ASSOC );
        $ps->execute();

        $categorias = [];
        foreach ( $ps as $cat ) {
            $categorias []= new Categoria9(  $cat[ 'id' ], $cat[ 'nome' ] );
        }

        return $categorias ;
    }

    function listarComId( $id ) {

        try {
            $sql = 'SELECT id, nome FROM categoria WHERE id = :id';
            $ps = $this->pdo->prepare( $sql );
            $ps->setFetchMode( \PDO::FETCH_ASSOC );
            $ps->execute( [ 'id' => $id ] );
            if ( $ps->rowCount() < 1 )
                return null;
            
            $categoria = $ps->fetch();
    
            return new Categoria9( $categoria['id'], $categoria['nome'] );

        } catch ( PDOException $e ) {
            throw new RepositorioException9(
                'Erro ao consultar a categoria', 0, $e
            );
        }

    }
}

?>