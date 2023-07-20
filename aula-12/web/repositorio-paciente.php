<?php

require_once './paciente.php';

interface RepositorioPaciente {

    function adicionar( Paciente &$p );

    function todos( $pagina = 1 );

    function removerPeloId( $id );

}

?>