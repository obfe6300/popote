<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once ('librairies/configuration/popote_conf.php');
include_once ('modeles/categorie/classe_categorie.php');
include_once ('modeles/commentaire/classe_commentaire.php');
include_once ('modeles/constituant/classe_constituant.php');
include_once ('modeles/ingredient/classe_ingredient.php');
include_once ('modeles/membre/classe_membre.php');
include_once ('modeles/photo/classe_photo.php');
include_once ('modeles/recette/classe_recette.php');
include_once ('modeles/sous_categorie/classe_sous_categorie.php');



$maListeRecette = recette::getListId();
echo "<br> liste des id de recette <br>";
print_r($maListeRecette);
echo "<br>";

$recetteAleatoire = 5;
echo "<br> id_rectte <br>";
print_r($recetteAleatoire);
$recette = recette::NewById($maListeRecette[$recetteAleatoire]);
echo "<br> recette <br>";
print_r($recette);

$listIngredients = ingredient::GetListId($recette->id_recette);
echo "<br> liste des ingredients <br>";
print_r($listIngredients);
echo "<table>";
foreach ($listIngredients as $ingredient) {
    //echo "<br> ingredient ";
    //print_r($ingredient);
    echo "<tr>";
    echo "<td>$ingredient[nom]</td>";
    echo "<td>$ingredient[quantite]</td>";
    echo "</tr>";
}
echo "</table>";
exit;


try {

    echo "<p>--------------------------------------------</p>";
    $value = "bfr";
    echo "<p>on essaie de creer un objet membre avec recuperation dans la base par login [$value]</p>";
    $bruno = membre::NewByLogin($value);
    if ($bruno == null) {
        echo "<p> objet vide </p>";
    } else {
        $bruno->affiche();
    }
    $new_pwd = "ddd";
    echo "<p>on modifie le passwd avec [$new_pwd]</p>";
    $bruno->password = $new_pwd;
    $bruno->update($bruno->id_membre, $bruno->login, $bruno->password, $bruno->nom, $bruno->prenom, $bruno->email, $bruno->type);
    $bruno->affiche();

    exit;



    $value = 10;
    echo "<p>on essaie de creer un objet membre avec recuperation dans la base par id [$value]</p>";
    $helene = membre::NewById($value);
    if ($helene == null) {
        echo "<p> objet vide </p>";
    } else {
        $helene->affiche();
    }
    echo "<p>on essaie de creer un nouveau membre avec creation dans la base</p>";
    $camille = membre::NewCreate('cho', 'pwdcho', 'Houdot', 'Camille', 'camille.houdot@orange.com', 'user');
    if ($camille == null) {
        echo "<p> objet vide </p>";
    } else {
        $camille->affiche();
    }


    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet membre vide</p>";
    $tmp = new membre;
    echo "<p>objet cree, on un nouveau membre en base</p>";
    $new_id = $tmp->create("toto_login", "toto_pwd", "toto_nom", "toto_prenom", "toto_email", "user");
    echo "<p>donnees recuperees de la base on l'affiche</p>";
    $tmp->affiche();
    echo "<p>donnees affichees on le detruit</p>";
    //$tmp->delete($new_id);
    $tmp = null;


    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet categorie</p>";
    $tmp = new categorie;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichee</p>";
    echo '</body>';
    echo '</html>';
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet commentaire</p>";
    $tmp = new commentaire;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    echo '</body>';
    echo '</html>';
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet constituant</p>";
    $tmp = new constituant;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    echo '</body>';
    echo '</html>';
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet ingredient</p>";
    $tmp = new ingredient;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    echo '</body>';
    echo '</html>';
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet membre</p>";
    $tmp = new membre;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet photo</p>";
    $tmp = new photo;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet recette</p>";
    $tmp = new recette;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    echo '</body>';
    echo '</html>';
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
    echo "<p>on essaie de creer un objet sous-categorie</p>";
    $tmp = new sous_categorie;
    echo "<p>objet cree, on initialise avec une valeur de la base </p>";
    $tmp->getById(1);
    echo "<p>donnees recuperees de la base </p>";
    $tmp->affiche();
    echo "<p>donnees affichees</p>";
    echo '</body>';
    echo '</html>';
    $tmp = null;

    echo "<p>--------------------------------------------</p>";
} catch (POEException $e) {
    echo "une erreur est survenue : " . $e->getMessage();
}
?>
