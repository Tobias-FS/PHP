<?php

$contato = new stdClass();
$contato->nome = 'Ana';
$contato->telefone = '997889898';

var_dump( $contato );

$a = ( array ) $contato;

echo $a[ 'nome' ], ' - ', $a[ 'telefone' ], PHP_EOL;

$obj = ( object ) $a;