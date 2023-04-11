<?php

namespace cefet;

use \Exception;

require_once 'turma.php';

class Aluno {
    public $nome = '';
    public $turma = null;
    public function __construct( $nome, Turma $turma) {
        $this->nome = $nome;
        $this->turma = $turma;
    }

    public function lancarExcecao() {
        throw new Exception( 'Execeçao aqui' );
    }
}

?>