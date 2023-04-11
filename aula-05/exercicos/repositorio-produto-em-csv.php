<?php

require_once 'repositorio-produto.php';
require_once 'produto.php';

const ARQUIVO = 'produtos.csv';

class RepositorioProdutoEmCsv implements RepositorioProduto {
    
    public function salvar(array $produtos) {
        
        $linhas = [];
        foreach ( $produtos as $p ) {
            $dados = [
                $p->getCodigo(),
                $p->getDescricao(),
                $p->getEstoque(),
                $p->getPreco(),
            ];
            $linha = implode( ',', $dados );
            $linhas []= $linha;
        }
        $conteudo = implode( "\n", $linhas );
        @file_put_contents( ARQUIVO, $conteudo );
 
    }

    public function carregar(): array {
        $conteudo = @file_get_contents( ARQUIVO );
        $linhas = explode( "\n", $conteudo );
        $produtos = [];
        foreach ( $linhas as $linha ) {
            $dados = explode( ',', $linha );
            $p = new Produto( $dados[ 0 ], $dados[ 1 ], $dados[ 2 ], $dados[ 3 ], );
            $produtos []= $p;
        }

        return $produtos;
    }

} 

?>