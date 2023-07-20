<?php

require_once './noticia.php';

interface RepositorioNoticia {

    function obterTodasAsNotícias();
    // function obterUmaNotícia( $id );
    function cadastrarNotícia( Noticia $noticia );
    function removerNoticia( $id );
    // function alterarNotícia( $id );

}

?>