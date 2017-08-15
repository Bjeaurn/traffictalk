<?php
function pluralize( $count, $text ) {
    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
}

function dateToText($datetime) {
    $datetime = new DateTime(date($datetime));
    //$datetime = strtotime($datetime);
    $interval = date_create('now')->diff( $datetime );
    $suffix = ( $interval->invert ? ' ago' : '' );
    $last = false;
    $text = "";
    if ( $v = $interval->y >= 1 ) { $text = pluralize( $interval->y, 'year' ); $last = true; }
    if ( $v = $interval->m >= 1 ) { if($last) { $text = ", "; } $text = pluralize( $interval->m, 'month' ); $last = true; }
    if ( $v = $interval->d >= 1 ) { if($last) { $text = ", "; } $text = pluralize( $interval->d, 'day' ); $last = true; }
    if($interval->d<=0 && $interval->m==0 && $interval->y==0) {
        if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hour' ) . $suffix;
        if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minute' ) . $suffix;
        return pluralize( $interval->s, 'second' ) . $suffix;
    } else {
        return $text . $suffix;
    }
}
?>
