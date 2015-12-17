<?php

/**
 * Returns sizes readable by humans
 *
 */
function human_filesize( $bytes, $decimals = 2 )
{
    $size = [ 'B', 'kB', 'MB', 'GB', 'TB', 'PB' ];
    $factor = floor( ( strlen( $bytes ) - 1 ) / 3 );
    return sprintf( "%.{$decimals}f", $bytes / pow( 1024, $factor ) ) . ' ' . @$size[ $factor ];
}

/**
 * Is the mime type an image
 *
 */
function is_image( $mimeType )
{
    return starts_with( $mimeType, 'image/' );
}

/**
 * Generates a sane URL to use for the back buttons
 *
 */
function back_href()
{
    $url = '/';
    if( isset( $_SERVER['HTTP_REFERER'] ) )
    {
        $referer = htmlspecialchars( $_SERVER['HTTP_REFERER'] );
        if( preg_match( '/12paws/', $referer ) )
        {
            $url = $referer;
        }
    }
    return $url;
}
