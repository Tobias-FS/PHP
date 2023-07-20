<?php
require_once 'conexao.php';

$pdo = null;

try {

    $pdo = conectar();

} catch ( PDOException $e ) {
    die( 'Erro: ' . $e->getMessage() );
}

// echo 'Conectado';
// 'SELECT * FROM produto WHERE estoque >= 15'
// "SELECT * FROM produto WHERE descricao LIKE '%b%' "
// "SELECT * FROM produto WHERE preco BETWEEN 7.00 and 8.00 "
// "SELECT *, estoque * preco AS inventario  FROM produto "

$ps = $pdo->prepare( "SELECT *, estoque * preco AS inventario  FROM produto ");

$ps->execute();

foreach ( $ps as $linha ) {
    echo    $linha[ 'id' ], ' - ',
            $linha[ 'codigo' ], ' - ',
            $linha[ 'descricao' ], ' - ',
            $linha[ 'estoque' ], ' - ',
            $linha[ 'preco' ], ' - ',
            $linha[ 'inventario' ], ' - ', PHP_EOL;
}

$ps = $pdo->query( " SELECT COUNT( id ) AS contagem, SUM( estoque ) AS estoque,
        AVG( preco ) AS media_preco FROM produto " );
$linha = $ps->fetch();
echo    'Contagem: ', $linha[ 'contagem' ],
        ' Estoque total: ', $linha[ 'estoque' ],
        ' Media de preço: R$ ', $linha[ 'media_preco' ];

?>