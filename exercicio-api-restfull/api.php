<?php

require_once './repositorio-notcia-em-bdr.php';
require_once './conexao.php';

// $url = str_replace( dirname( $_SERVER( 'PHP_SELF' ) ), '',
//         $_SERVER[ 'REQUEST_URI' ] );
$url = str_replace(  // "/projeto1/contatos" => "/contatos"
    dirname( $_SERVER[ 'PHP_SELF' ] ), // "/projeto1"
    '',
    $_SERVER[ 'REQUEST_URI' ]
);
$metodo = $_SERVER[ 'REQUEST_METHOD' ];

$regex = '/^\/noticias\/?$/';
$regexcomID =  '/^\/contatos\/([0-9]+)\/?$/i';
$casamentos = [];

$pdo = null;
$repositorio = null;
try {
    $pdo = criarConexao();
    $repositorio = new RepositorioNoticiaEmBdr( $pdo );
} catch ( PDOException $e ) {
    echo 'Erro ao conectar ao banco de dados' . $e->getMessage();
} 

if ( $metodo == 'GET' && preg_match( $regex, $url ) ) {
    try {

        $noticias = $repositorio->obterTodasAsNotícias();

        if ( ! $noticias ) {
            http_response_code( 404 );
            die();
        }

        header( 'Content-Type: application/json' );
        http_response_code( 200 );
        echo json_encode( $noticias );

    } catch ( RepositorioException $re ) {
        echo $re->getMessage();
    }
} else if ( $metodo == 'POST' && preg_match( $regex, $url ) ) {
    
    try {
    // $conteudo = file_get_contents( 'php://input' );
    // $noticia = (array) json_decode( $conteudo );

    $tipoConteudo = getallheaders()[ 'Content-Type' ];
    $noticia = [];
    if ( $tipoConteudo == 'application/x-www-form-urlencoded' ) {
        $noticia = $_POST;
    } else if ( $tipoConteudo == 'application/json' ) {
        $texto = file_get_contents( 'php://input' );
        $noticia = (array) json_decode( $texto );
    }

    // if ( ! array_key_exists( 'titulo', $noticia ) ||
    //     ! array_key_exists( 'criacao', $noticias ) ||
    //     ! array_key_exists( 'conteudo', $noticia ) ||
    //     ! array_key_exists( 'usuario', $noticia ) ) {
    //         http_response_code( 400 );
    //         echo 'Preencher';
    //         die();
    // }
    
    $noticia[ 'titulo' ] = htmlspecialchars( $noticia[ 'titulo' ] );
    $noticia[ 'criacao' ] = htmlspecialchars( $noticia[ 'criacao' ] );
    $noticia[ 'conteudo' ] = htmlspecialchars( $noticia[ 'conteudo' ] );
    $noticia[ 'usuario' ] = htmlspecialchars( $noticia[ 'usuario' ] );

    $repositorio->cadastrarNotícia( new Noticia(
        0,
        $noticia[ 'titulo' ],
        $noticia[ 'criacao' ],
        $noticia[ 'conteudo' ],
        $noticia[ 'usuario' ]
    ) );

    } catch ( PDOException $re ) {
        echo $re->getMessage();
    }

} else if ( $metodo == 'DELETE' && preg_match( $regexcomID, $url, $casamentos ) ) {
    [ , $id ] = $casamentos;
    echo 'oi';
    try {
        
        $repositorio->removerNoticia( $id );
    } catch ( RepositorioException $re ) {
        echo $re->getMessage();
    }
}

?>