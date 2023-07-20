<?php

require_once './exercicio-02.php';

$telefones = [
    '30044000',
    '2225271727',
    '22987654321',
    '08007024000',
    '03007024000'
];

function formtarArrayDeTelefones( &$arr ) {
    foreach ( $arr as &$tel ) {
        $tel = formatarTelefones( $tel );        
    } 
}

formtarArrayDeTelefones( $telefones );
var_dump( $telefones );

?>