<?php

require_once './repositorio-notcia.php';
require_once './repositorio-exception.php';
require_once './noticia.php';

class RepositorioNoticiaEmBdr implements RepositorioNoticia {

    private $pdo = null;

    function __construct( $pdo ) {
        $this->pdo = $pdo;
    }

    function obterTodasAsNotícias() {
        try {
            $sql = 'SELECT * FROM noticia';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute();
            // if ( $ps->rowCaount() < 1 ) {
            //     return false;
            // }
    
            $noticias = [];
            foreach( $ps as $reg ) {
                $noticias []= new Noticia( 
                    $reg[ 'id' ],
                    $reg[ 'titulo' ],
                    $reg[ 'data' ],
                    $reg[ 'conteudo' ],
                    $reg[ 'usuario' ]
                );
            }
    
            return $noticias;
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao listar noticias', 0, $e );
        }

    }

    function cadastrarNotícia(Noticia $noticia) {
        
        try {
            $sql = 'INSERT INTO noticia ( titulo, data, conteudo, usuario ) 
                VALUES ( :titulo, :data, :conteudo, :usuario )';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'titulo' => $noticia->titulo,
                'data' => $noticia->criacao,
                'conteudo' => $noticia->conteudo,
                'usuario' => $noticia->usuario
            ] );
        } catch ( PDOException $re ) {
            throw new RepositorioException( 'Erro ao cadastrar', 0, $re );
        }
    }

    function removerNoticia($id) {
        try {
            $sql = 'DELETE FROM noticia WHERE id = :id';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [ 'id' => $id ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException( 'Erro ao remover', 0, $e );
        }
    }

}

?>