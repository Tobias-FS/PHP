<?php

require_once 'conta.php';
require_once 'repositorio-exception.php';
require_once 'repositorio-conta.php';
require_once 'repositorio-conta-em-bdr.php';


const OPCAO_SAIR = 0;
const OPCAO_CADASTRAR = 1;
const OPCAO_lISTAR = 2;
const OPCAO_DEPOSITAR = 3;
const OPCAO_TRANSFERIR = 4;


function cadastrar( RepositorioConta $rep ) {

    echo 'CADASTRO', PHP_EOL;
    
    $dono = readline( 'Dono: ' );
    $cpf = readline( 'Cpf: ' );
    $senha = readline( 'Senha: ' );
    $saldo = readline( 'Saldo: ' );

    $conta = new conta( 0, $dono, $cpf, $senha, $saldo );

    $rep->cadastrar( $conta );

    
}

function listar( RepositorioConta $rep ) {

    echo 'LISTAR', PHP_EOL;

    $contas = $rep->todasASContas();

    // var_dump( $contas );

    foreach ( $contas as $c ) {
        echo 'Dono: ' . $c->dono . ' Cpf: ' . $c->cpf . ' Saldo: ' . $c->saldo, PHP_EOL;
    }
}

function depositar( RepositorioConta $rep ) {

    echo 'DEPOSITO', PHP_EOL;

    $senha = readline( 'Senha: ' );
    $cpf = readline( 'Cpf: ' );
    $valor = readline( 'Valor: ' );

    $deposito = $rep->depositar( $senha, $cpf, $valor );

    if ( $deposito != true )
        echo 'Dados de autenticação incorretos';
    else
        echo 'Deposito concluido'; 
}

function transferir( $rep ) {

    echo 'TRANSFERIR', PHP_EOL;
    $cpfOrigem = readline( 'Cfp da conta de origem: ' );
    $senhaOrigem = readline( 'Senha da conta de origem: ' );
    $cpfDestino = readline( 'Cfp da conta de destino: ' );
    $valor = readline( 'Valor: ' );

    $tranferencia = $rep->transferir( $cpfOrigem, $senhaOrigem, $cpfDestino, $valor );

    if ( $tranferencia != true )
        echo 'Dados de autenticação incorretos';
    else
        echo 'Deposito concluido'; 


}

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=aula07;charset=utf8',
        'root', 'R_oot2121', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    );
} catch ( PDOException $pe ) {
    die( 'Erro ao conectar com o banco de dados: ' . $pe->getMessage() );
}

$repositorio = new RepositorioContaEmBDR( $pdo );

do {

    echo 'MENU', PHP_EOL;
    echo '1) CADASTRAR', PHP_EOL;
    echo '2) LISTAR', PHP_EOL;
    echo '3) DEPOSITAR', PHP_EOL;
    echo '4) TRANSFERIR',PHP_EOL;

    $opcao = readline( 'Opção: ');

    switch ( $opcao ) {

        case 1: cadastrar( $repositorio ); break;
        case 2: listar( $repositorio ); break;
        case 3: depositar( $repositorio ); break;
        CASE 4: transferir( $repositorio ); break;
    }

} while ( $opcao != OPCAO_SAIR );


?>