<?php

require_once 'limparTela.php';

const OPCAO_SAIR = '4';
$cadastro = [];

do {

    

    echo 'Digite:', PHP_EOL;
    echo  ' 1 - Incluir nome', PHP_EOL;
    echo  ' 2 - Remover nome', PHP_EOL;
    echo  ' 3 - Listar nome', PHP_EOL;
    echo  ' 4 - para sair', PHP_EOL;
    $opcao = readline( 'Opção: ' );
    // $vazio = empty( $nome );

    // if( ! $vazio ) {
    //     $nomes []= $nome;
    // }
    limparTela();
    
    switch( $opcao ) {
        case '1': {
            $nome = readline( 'Digite um nome: ' );
            $idade = readline( 'Digite a idade: ' );
            $pessoa = [ 'nome' => $nome, 'idade' => $idade ];
            $cadastro []= $pessoa;
            break;
        }   
        case '2': {
            $nome = readline( 'Digite um nome: ' );
            $indice = -1; //Não encontrado por padrão
            foreach ( $cadastro as $chave => $valor ) {
                if ( $valor[ 'nome' ] === $nome ) {
                    $indice = $i;
                    break;
                }
            };
            if ( $indice > -1 ) 
                unset( $cadastro[ $indice ]  );
            break;
        }
            
        case '3': 
            if ( empty( $cadastro ) ) {
                echo 'Nenhum nome encontrado', PHP_EOL;
                break;
            }
            echo 'Nomes existentes: ', PHP_EOL;
            
            usort( $cadastro, function( $a, $b ) {
                if ($a['nome'] === $b['nome']) {
                    return 0;
                } elseif ($a['nome'] > $b['nome']) {
                    return 1;
                }
                return -1;
            });
            foreach ( $cadastro as $valor ) {
                echo 'Nome: ', $valor[ 'nome' ], PHP_EOL;
                echo 'Iddade: ',$valor[ 'idade' ], PHP_EOL;
            }; break;
    }
    
} while ( $opcao != 4 );



?>