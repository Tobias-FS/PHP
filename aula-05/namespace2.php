<?php

require_once 'diretor.php';
require_once 'turma.php';

use cefet\Turma;
use cefet\gestao\Diretor;


$t = new Turma();
$t->descricao = '3002';
echo $t->descricao, PHP_EOL;

$d = new Diretor();
$d->email = 'D@email.com';
echo $d->email, PHP_EOL;

?>