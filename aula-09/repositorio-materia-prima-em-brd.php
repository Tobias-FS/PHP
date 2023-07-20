<?php

require_once './repositorio-materia-prima.php';
require_once './materia-prima.php';
require_once './RepositorioException.php';

class RepositorioMateriaPrimaEmBDR9 implements RepositorioMateriaPrima9 {
    
    private $pdo = null;
    private $categoria;

    function __construct( \PDO $pdo, RepositorioCategoria9 $categoria ) {
        $this->pdo = $pdo;
        $this->categoria = $categoria;
    }
    
    function listar() {
        try {
            $sql = 'SELECT id, descricao, quantidade, custo, categoria_id from materia_prima';
            $ps = $this->pdo->prepare( $sql );
            $ps->setFetchMode( \PDO::FETCH_ASSOC );
            $ps->execute();
    
            $materiasPrimas = [];
            foreach ( $ps as $m ) {
                $materiasPrimas []= new MateriaPrima9( 
                    $m[ 'id' ],
                    $m[ 'descricao' ],
                    $m[ 'quantidade' ],
                    $m[ 'custo' ],
                    $this->categoria->listarComId( $m[ 'categoria_id' ] )
                );
            }
            return $materiasPrimas;
        } catch ( PDOException $e ) {
            throw new RepositorioException9( 'Erro ao consultar materia prima', 0, $e );
        }

    }

    function cadastrar( MateriaPrima9 $materiaPrima  ) {
        try {
            // 'INSERT INTO contato (nome, telefone) VALUES (:nome, :telefone)' 
            $sql = 'INSERT INTO materia_prima ( descricao, quantidade, custo , categoria_id  )  VALUES ( :descricao, :quantidade, :custo , :categoria_id  ) ';
            $ps = $this->pdo->prepare( $sql );
            $ps->execute( [
                'descricao' => $materiaPrima->getDescricao(),
                'quantidade' => $materiaPrima->getQuantidade(),
                'custo' => $materiaPrima->getCusto(),
                'categoria_id' => $materiaPrima->getCategoria()->getId()
            ] );
        } catch ( PDOException $e ) {
            throw new RepositorioException9( 'Erro ao cadastrar materia prima', 0, $e );
        }
    }
}

?>