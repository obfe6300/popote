<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$myIncludePath = '/var/www/html/popote';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);


session_destroy();

//echo "<a href='/popote/index.php'>Retour</a> <br>";
header("location: /popote");
?>
