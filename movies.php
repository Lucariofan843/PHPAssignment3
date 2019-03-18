<?php

require("FileMovieManager.php");
require("Movie.php");
require("DatabaseMovieManager.php");
require ("DataSource.php");

/**
 * @param array $array
 */

function arrayPrint (array $array)
{
    echo'<pre>' . print_r( $array, true) . '</pre>';
}

?>