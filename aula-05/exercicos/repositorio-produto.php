<?php

interface RepositorioProduto {

    public function salvar( array $produtos );
    public function carregar(): array;

}

?>