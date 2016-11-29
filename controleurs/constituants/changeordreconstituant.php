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

//echo "<br> on essaie de recuperer le constituant";
$tmp=constituant::NewById($_GET['id']);
//echo "<br> constituant a deplacer (rang = $tmp->rang)";
//echo "<br> ";
//print_r($tmp);

//echo "<br> on essaie de recuperer le sens de deplacement souhaite";
$sens=$_GET['sens'];
echo "<br> constituant ". $tmp->id_constituant . " : sens " . $sens;

//on recupere la liste des constituants de la recette
$listIngredients = ingredient::GetListId($tmp->id_recette);
// on calcule le nombre de constituants
$nbConstituants=count($listIngredients);
echo "<br> nombre de constituants pour cette recette : " . $nbConstituants;
echo "<br>";

//echo "<br> on essaie d'effacer le constituant : ".$tmp->id_constituant;
//print_r($tmp);
if ($sens == 'up'){
	if ($tmp->rang > 1){
		$nouveauRang=$tmp->rang-1;
		//echo "<br> on fait monter le constituant ".$tmp->id_constituant . " au rang $nouveauRang";
		$tmp->up();
	}else{
		echo "<br> le constituant est deja au plus haut";
	}
}else{
	if ($tmp->rang < $nbConstituants){
		$nouveauRang=$tmp->rang+1;
		//echo "<br> on fait descendre le constituant ".$tmp->id_constituant . " au rang $nouveauRang";
		$tmp->down();
	} else{
		echo "<br> le constituant est deja au plus bas";
	}
}
//echo "<br> constituant efface ";

//echo "<br>on sort de changeordreconstituant.php <br>";
//echo "<a href=/popote/index.php>Continuer</a>";
header("location: /popote");
