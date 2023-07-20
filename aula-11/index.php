<?php

// var_dump( $_SERVER );

$metodo =  $_SERVER[ 'REQUEST_METHOD' ];
$url = $_SERVER[ 'REQUEST_URI' ];
$casamentos = [];

$regex = '/^\/contatos\/?$/i';

// if ( $metodo == 'GET' && preg_match( $regex, $url ) ) {
//     $conteudo = file_get_contents( 'api.json');
//     $objeto = json_decode( $conteudo );
//     header( 'Content-Type: application/json' );
//     echo json_encode( $objeto->contatos );
// }

function carregarContatos() {
    $conteudo = file_get_contents( 'api.json');
    $objeto = json_decode( $conteudo );
    return $objeto->contatos;
}

function salvarContatos( $contatos) {
    $obj = new stdClass();
    $obj->contatos = $contatos;
    $texto = json_encode( $obj );
    file_put_contents( 'api.json', $texto );
}

function gerarId( $contatos ) {
    $maior = 0;
    foreach ( $contatos as $c ) {
        if ( $c->id > $maior)
            $maior = $c->id;
    }
    return $maior + 1;
}

function obterDadosContato() {
    $tipoConteudo = getallheaders()[ 'Content-Type' ];
    $dadosContatos = [];
    if ( $tipoConteudo == 'application/x-www-form-urlencoded') {
        $dadosContatos = $_POST;
    } else if ( $tipoConteudo == 'application/json' ) {
        $texto = file_get_contents( 'php://input' );
        $dadosContatos = (array) json_decode( $texto );
    }

    return $dadosContatos;
}

function validarDadosContatos( $dadosContatos ) {
    if ( ! array_key_exists( 'nome', $dadosContatos )  ||
        ! array_key_exists( 'telefone', $dadosContatos ) ) {
            http_response_code( 400 );
            echo 'Por favor informe "nome" e "telefone" ';
            die();
    }
}

function indicarDadoNaoEcontrado() {
    http_response_code( 404 );
    header( 'Content-Type: text/plain' );
    echo 'Contato não encontrado';
}

if ( $metodo == 'GET' &&  preg_match( '/^\/contatos\/?$/i', $url ) ) {
    header( 'Content-Type: text/plain' );
    $contatos = carregarContatos();
    echo json_encode( $contatos );
} else if ( $metodo == 'GET' && 
    preg_match( '/^\/contatos\/([0-9]+)\/?$/i', $url, $casamentos ) ) {
    [, $id ] = $casamentos;
    header( 'Content-Type: application/json' );
    $contatos = carregarContatos();
    $achou = false;
    foreach ( $contatos as $c ) {
        if ( $c->id == $id ) {
            echo json_encode( $c );
            $achou = true;
            break;
        }
    }
    if ( ! $achou ) {
        indicarDadoNaoEcontrado();
    }
} else if ( $metodo == 'DELETE' && 
    preg_match( '/^\/contatos\/([0-9]+)\/?$/i', $url, $casamentos ) ) {
    [ , $id ] = $casamentos;
    http_response_code( 204 );
    $contatos = carregarContatos();
    $achou = false;
    foreach ( $contatos as $indice => $c ) {
        if ( $c->id == $id ) {
            unset( $contatos[ $indice ] );
            salvarContatos( $contatos );
            $achou = true;
            break;
        }
    }
    if ( ! $achou ) {
        indicarDadoNaoEcontrado();
    }
} else if ( $metodo == 'POST' &&  preg_match( '/^\/contatos\/?$/i', $url ) ) {
    $tipoConteudo == getallheaders()[ 'Content-Type' ];
    $dadosContatos = obterDadosContato();
    validarDadosContatos( $dadosContatos );


    $contatos = carregarContatos();
    $dadosContatos[ 'id' ] = gerarId( $contatos );
    $contato = (object) $dadosContatos;
    $contatos []= $contato;
    salvarContatos( $contatos ); 
    http_response_code( 201 );
    echo 'Salvo com sucesso.';
} else if ( $metodo == 'PUT' && 
    preg_match( '/^\/contatos\/([0-9]+)\/?$/i', $url, $casamentos ) ) {
    [ , $id ] = $casamentos;

    $contatos = carregarContatos();
    $achou = false;
    foreach ( $contatos as $indice => $c ) {
        if ( $c->id == $id ) {

            $dadosContatos = obterDadosContato();
            validarDadosContatos( $dadosContatos );
            if ( $id != $dadosContatos[ 'id' ] ) {
                $dadosContatos[ 'id' ] = $id;
            }
            $contatos[ $indice ] = (object) $dadosContatos;
            salvarContatos( $contatos );
            $achou = true;
            break;
        }
    }
    if ( ! $achou ) {
        indicarDadoNaoEcontrado();
    }
}

?>