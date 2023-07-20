<?php

require_once './repositorio-prduto.php';

class RepositorioPrdutoEmCsv implements RepositorioP {

    // private $produtos = [];
    
    // function __construct( $produtos ) {
    //     $this->produtos = $produtos;
    // }
   
    function salvar( array $produtos ) {
        $linhas = [];
        foreach( $produtos as $p ) {
            $dados = [
                $p->getCodigo(),
                $p->getDescricao(),
                $p->getEstoque(),
                $p->getPreco()
            ];
            $linha = implode( ',', $dados );
            $linhas []= $linha;
        }
        $conteudo = implode( "\n", $linhas );
        file_put_contents( 'arquivo.cvs', $conteudo );
    }

    // function carregar():array {

    // }

}

?>