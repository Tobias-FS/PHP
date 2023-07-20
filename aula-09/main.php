
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Materia Primas</h1>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Descricao</th>
                <th>Quantidade</th>
                <th>Custo</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            <?php

                require_once './conexao.php';
                require_once './repositorio-categoria-em-brd.php';
                require_once './repositorio-materia-prima-em-brd.php';

                $materiasPrimas = [];
                $categorias = [];
                $repCat = null;
                $repMateria = null;

                try {
                    $pdo = conectar();

                    $repCat = new RepositorioCategoriaEmBDR9( $pdo );
                    $repMateria = new RepositorioMateriaPrimaEmBDR9( $pdo, $repCat );

                    $materiasPrimas = $repMateria->listar();
                    $categorias = $repCat->listar();

                } catch( PDOException $e ) {
                    echo 'Erro ao conectar ao banco';
                }
    

                // foreach ( $materiasPrimas as $ma ) {
                //     echo <<<html
                //         <td>{$ma->descricao}</td>
                //         <td>{$ma->quantidade}</td>
                //         <td>{$ma->custo}</td>
                //         <td>{$ma->categoria->nome}</td>
                //     html;
                // }

                foreach ( $materiasPrimas as $mp ) {
                    echo <<<HTML
                        <tr>
                            <td>{$mp->getId()}</td>
                            <td>{$mp->getDescricao()}</td>
                            <td>{$mp->getQuantidade()}</td>
                            <td>{$mp->getCusto()}</td>
                            <td>{$mp->getCategoria()->getNome()}</td>
                        </tr>
                    HTML;
                }
            ?>
        </tbody>
    </table>

    <h1>Cadastrar Materia Prima</h1>

    <form action="main.php" method="get">

        <label for="descricao">Descricao</label>
        <input type="text" id="descricao" name="descricao">

        <label for="quantidade">quantidade</label>
        <input type="text" id="quantidade" name="quantidade">
        
        <label for="custo">custo</label>
        <input type="text" id="custo" name="custo">
        
        <select name="categoria" id="categoria">
            <?php
                 foreach ( $categorias  as $c ) {
                    echo <<<HTML
                        <option type="number" value="{$c->getId()}">
                            {$c->getNome()}
                        </option>
                    HTML;
                }
            ?>
        </select>

        <button>Cadastrar</button>
    </form>

    <?php
        $descricao = $_GET[ 'descricao' ];
        $quantidade = $_GET[ 'quantidade' ];
        $custo = $_GET[ 'custo' ];
        $categoria = (int) $_GET[ 'categoria' ];
    
        $cat = $repCat->listarComId( $categoria );
        $mat = new MateriaPrima9( 0, $descricao, $quantidade, $custo, $cat );
        // echo 'categoria', $mat->getCategoria()->getId();
        $repMateria->cadastrar( $mat );
    ?>

</body>
</html>