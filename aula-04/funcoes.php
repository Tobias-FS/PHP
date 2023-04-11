<?php

function comprimentar( $nome = 'Zé', $cumprimento = 'Olá' ) {
    echo $cumprimento, ' ', $nome, PHP_EOL;
}

comprimentar();

function f() {
    static $x = 0;

    echo ++$x, PHP_EOL;
}

f();
f();
f();
f();


?>