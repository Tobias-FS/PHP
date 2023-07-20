<?php

use Mma\RepositorioLutadorEmBDR;

require_once './repositorio-lutador-em-bdr.php';
require_once './conexao.php';

$id1 = (int) readline( 'Informe o 1° id: ' );
$id2 = (int) readline( 'Informe o 2° id: ' );

try {

    $pdo = criarConexao();
    $repositorio = new RepositorioLutadorEmBDR( $pdo );

    $pdo->beginTransaction();
    $ok1 = $repositorio->remover( $id1 );
    $ok2 = $repositorio->remover( $id2 );

    if ( ! $ok1 ) {
        $pdo->rollBack();
        echo 'erro';
    } else {
        $pdo->commit();
        echo 'Removido com sucesso';
    }


} catch ( PDOException $e ) {
    echo 'Erro ao conectar ao banco de dados' . $e->getMessage();
} catch ( RepositorioException $re ) {
    $pdo->rollback();
    echo $re->getMessage();
}

?>