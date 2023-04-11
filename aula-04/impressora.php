<?php

interface Impressora {
    function imprimir( $valor );
}

class ImpressoraEmConsole implements Impressora {

    public function imprimir( $valor ) {
        echo $valor;
    }
}

class ImpressoraEmArquivo implements Impressora {

    public function imprimir( $valor ) {
        
        $conteudo = @file_get_contents( 'saida.txt' ); // @ desabilita avisos 
        if( $conteudo === false ) {
            $conteudo = '';
        }

        file_put_contents( 'saida.txt', $conteudo . $valor );
    }
}

function gerarSaida( array $palavras, Impressora $impressora ) {

    foreach( $palavras as $p ) {
        $impressora->imprimir( $p . "\n" );
    }
}

$palavras = [ 'Prog para web', 'CEFET', 'RJ' ];

gerarSaida( $palavras, new ImpressoraEmConsole() );
gerarSaida( $palavras, new ImpressoraEmArquivo() );
