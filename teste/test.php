<?php

function caracToASCII( string $carac ){
    return ord( $carac ) + 100;
}

echo caracToASCII( 'z' );

?>