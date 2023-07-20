<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Estoque</th>
                <th>Peço</th>
            </tr>
        </thead>
        <tbody>
            
            <?php

                const ARQUIVO = 'produtos.csv';

                $linhas = explode( "\n", file_get_contents( ARQUIVO ) );
                array_shift($linhas);
                $produtos = [];
                $totalEstoque = 0;
                $totalPreco = 0;
                $tam = count( $linhas );
                foreach ( $linhas as $p ) {
                    $prod = explode( ',', $p );
                    $totalEstoque += (int) $prod[1];
                    $totalPreco += (float) $prod[2];
                    echo <<<HTML
                        <tr> 
                            <td> $prod[0] </td>
                            <td> $prod[1] </td>
                            <td> $prod[2] </td>
                        </tr>
                    HTML;
                }
            ?>
        </tbody>
        <tfoot>

            <?php
                    echo <<<HTML
                        <tr>
                            <td> $tam  </td>
                            <td> $totalEstoque </td>
                            <td> $totalPreco </td>
                        </tr>
                    HTML;
            ?>

        </tfoot>
    </table>

</body>
</html>