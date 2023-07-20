<?php

require_once 'conexao.php';
require_once 'produto.php';

const OPCAO_SAIR = 0;
const OPCAO_CADASTRAR = 1;
const OPCAO_REMOVER = 2;
const OPCAO_ALTERAR = 3;
const OPCAO_LISTARUM = 4;
const OPCAO_LISTAR = 5;


$pdo = null;

try {

    $pdo = conectar();

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

do {

    echo 'MENU', PHP_EOL;
    echo '0) Sair', PHP_EOL;
    echo '1) Cadastrar', PHP_EOL;
    echo '2) Remover', PHP_EOL;
    echo '3) Alterar', PHP_EOL;
    echo '4) ListarUm', PHP_EOL;
    echo '5) Listar', PHP_EOL;

    $opcao = readline( 'Opção: ' );

    switch ( $opcao ) {

        case OPCAO_CADASTRAR : 
            cadastrar( $pdo );
            // $p = cadastrar( $pdo );
            // echo 'Produto casdastrado com o id: ', $p->id, PHP_EOL;
            ; break;
        case OPCAO_REMOVER : remover( $pdo ); break;
        case OPCAO_ALTERAR : alterar( $pdo ); break;
        case OPCAO_LISTARUM : listarUm( $pdo ); break;
        case OPCAO_LISTAR : listar( $pdo ); break;
        
    }

} while ( $opcao != OPCAO_SAIR );

function solicitarCodigo() {
    return readline( 'Digite o codigo do produto desejado: ' );
}

function exibirErro( PDOException $e ) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
}

function pedirProduto() {

    echo 'Produto', PHP_EOL;
    $codigo = readline( 'Código: ' );
    $descricao = readline( 'Descrição: ' );
    $estoque = readline( 'Estoque: ' );
    $preco = readline( 'Preço (R$): ' );

    return new Produto( 0, $codigo, $descricao, $estoque, $preco );
}

// function cadastrar( PDO $pdo ) {

//     $p = pedirProduto();

//     $sql = "INSERT INTO produto
//             ( codigo, descricao, estoque, preco )
//             VALUES 
//             ( '". $p->codigo    ."'
//             , '". $p->descricao ."'
//             , " . $p->estoque   ."
//             , " . $p->preco     ." ) ";

//     try {
//         $pdo->exec( $sql );
//     } catch ( PDOException $e ) {
//         echo 'Erro: ', $e->getMessage(), PHP_EOL;
//     }
// }

// function cadastrar( PDO $pdo ) {

//     $p = pedirProduto();

//     $sql = "INSERT INTO produto
//             ( codigo, descricao, estoque, preco )
//             VALUES 
//             ( :codigo, :descricao, :estoque, :preco ) ";

//     try {

//         $ps = $pdo->prepare( $sql );
//         $ps->execute( [
//             'codigo' => $p->codigo,
//             'descricao' => $p->descricao,
//             'estoque' => $p->estoque,
//             'preco' => $p->preco,
//         ] );
//     } catch ( PDOException $e ) {
//         echo 'Erro: ', $e->getMessage(), PHP_EOL;
//     }
// }

function cadastrar( PDO $pdo ) {

    echo 'CADASTRAT', PHP_EOL;

    $p = pedirProduto();

    $sql = "INSERT INTO produto
            ( codigo, descricao, estoque, preco )
            VALUES 
            ( ?, ?, ?, ?) ";

    try {

        $ps = $pdo->prepare( $sql );
        $ps->execute( [
            $p->codigo,
            $p->descricao,
            $p->estoque,
            $p->preco
        ] );

        // $p->id = $pdo->lastInsertId(); // Obtém o ID gerado pelo BD
        // return $p;
    } catch ( PDOException $e ) {
        exibirErro( $e );
    }
}

function remover( PDO $pdo ) {

    echo 'REMOVER', PHP_EOL;

    $codigo = solicitarCodigo();

    $sql = " DELETE FROM produto WHERE codigo = ? ";

    try {

        $ps = $pdo->prepare( $sql );
        $ps->execute( [ $codigo ] );
        if ( $ps->rowCount() > 0 ) {
            echo 'Removido com sucesso.', PHP_EOL;
        } else {
            echo 'Não encontrado.', PHP_EOL;
        }

    } catch ( PDOException $e ) {
        exibirErro( $e );
    }

}

function alterar( PDO $pdo ) {

    echo 'ALTERAR', PHP_EOL;

    $codigo = solicitarCodigo();

    $p = pedirProduto();

    $sql = "UPDATE produto SET codigo = ?, descricao = ?, estoque = ?, preco = ? WHERE codigo = ?";

    try {

        $ps = $pdo->prepare( $sql );
        $ps->execute( [
            $p->codigo,
            $p->descricao,
            $p->estoque,
            $p->preco,
            $codigo
        ] );
        if ( $ps->rowCount() > 0 ) {
            echo 'Produto atualizado.', PHP_EOL;
        } else {
            echo 'Não encontrado.', PHP_EOL;
        }

    } catch ( PDOException $e ) {
        exibirErro( $e );
    }

}

function listar( PDO $pdo, $codigo, $descricao ) {

    echo 'LISTAR', PHP_EOL;

    if ( ( $codigo  != null && $descricao != null ) ) {
        $sql = " SELECT * from produto where codigo = ?, descricao ?";
        $ps = $pdo->prepare( $sql );
        $ps->execute( [
            $codigo,
            $descricao
        ] );
    } else {
        $sql = " SELECT * FROM produto ";
        $ps = $pdo->prepare( $sql );
        $ps->execute();
    }

    foreach ( $ps as $linha ) {
        echo    $linha[ 'id' ], ' - ',
                $linha[ 'codigo' ], ' - ',
                $linha[ 'descricao' ], ' - ',
                $linha[ 'estoque' ], ' - ',
                $linha[ 'preco' ], ' - ', PHP_EOL;
    }

}

function listarTodos(  ) {

}

function listarUm(  ) {
    
}

?>