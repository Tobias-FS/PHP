<?php
const OPCAO_SAIR = '4';
$nomes = [];

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

    switch( $opcao ) {
        case '1': {
            $nome = readline( 'Digite um nome: ' );
            array_push( $nomes, $nome ); 
            break;
        }   
        case '2': {
            if ( empty( $nomes ) ) {
                echo 'Nenhum nome a ser removido', PHP_EOL;
                break;
            }
            $nome = readline( 'Digite um nome: ' );
            $indice = array_search( $nome, $nomes );
            if ( $indice === false ) 
                echo 'Nome não econtrado', PHP_EOL;
            else {
                unset( $nomes[ $indice ] );
                echo 'Removido com sucesso.', PHP_EOL;
            }
            break;
        }
            
        case '3': 
            if ( empty( $nomes ) ) {
                echo 'Nenhum nome encontrado', PHP_EOL;
                break;
            }
            echo 'Nomes existentes: ', PHP_EOL;
            foreach ( $nomes as $valor ) {
                echo $valor, PHP_EOL;
            }; break;
    }
    
} while ( $opcao != 4 );



?>