<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


session_start();

$myIncludePath = '/var/www/html/popote';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

include_once 'modeles/constituant/classe_constituant.php';
include_once 'librairies/configuration/popote_conf.php';

echo "<br> on essaie de recuperer le constituant";
$tmp=constituant::NewById($_GET['id']);
echo "<br> constituant recupere ";
print_r($tmp);
echo "<br> on essaie d'effacer le constituant : ".$tmp->id_constituant;
print_r($tmp);
$tmp->delete();
echo "<br> constituant efface ";

//echo "<br>on sort de deleteconstituant.php <br>";
//echo "<a href=/popote/index.php>Continuer</a>";
header("location: /popote");
