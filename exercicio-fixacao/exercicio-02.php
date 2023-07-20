<?php

function formatarTelefones( $telefone ) {

    $tamanhoTel = strlen( $telefone );

    if ( ! is_numeric( $telefone ) ) {
        return $telefone;
    } 

    switch( $tamanhoTel ) {
        case 8: 
            return substr( $telefone, 0, 4 ) . ' ' . substr( $telefone, 4 ) ;
        case 10: 
            return '(' . substr( $telefone, 0, 2 ) . ')' . substr( $telefone, 2, 4 ) . '-' . substr( $telefone, 6 ) ;
        case 11: 
            if ( substr( $telefone, 0, 4) == '0800' ) {
                return substr( $telefone, 0, 4 ) . ' ' . substr( $telefone, 4, 3 ) . ' ' . substr( $telefone, 7 );
            } else if ( substr( $telefone, 0 ,4) == '0300' ) {
                return substr( $telefone, 0, 4 ) . ' ' . substr( $telefone, 4, 3) . ' ' . substr( $telefone, 7 );
            }
            return '(' . substr( $telefone, 0, 2 ) . ')' . substr( $telefone, 2, 1 ) . '-' .substr( $telefone, 3, 4 )
                . '-' .substr( $telefone, 7 );
    }
}

echo formatarTelefones( '03007024000' );

?>