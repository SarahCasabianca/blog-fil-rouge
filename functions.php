<?php

function truncateString($string, $length = 20)
{
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . ' (...)';
    }
    return $string;
}

?>