<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();
$myIncludePath = '/var/www/html/popote';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);

unset($_SESSION['listeRecherche']);
unset($_SESSION['catRecherche']);
unset($_SESSION['sscatRecherche']);

$_SESSION['listeRecette']='user';
$_SESSION['typeContenu']='maListe';
$_SESSION['numPage']=0;

//echo "<br>on sort de select_identification.php <br>";
//echo "<a href=/popote/index.php>Continuer</a>";
header("location: /popote");

?>
