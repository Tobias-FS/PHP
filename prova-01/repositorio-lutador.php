<?php

namespace Mma;

require_once './lutador.php';

use Lutador;

interface RepositorioLutador {
    function cadastrar( Lutador $lutador );
    function remover( int $id );
}

?>