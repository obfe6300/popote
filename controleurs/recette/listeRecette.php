<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$nbLigneParPages = $_SESSION['nbLigneParPages'];
$nbLigneParPages = NBRECETTEPARPAGE;
$rechercheActivée = 0;
if (isset($_SESSION['listeRecherche']) || isset($_SESSION['catRecherche']) || isset($_SESSION['sscatRecherche'])) {
    echo "<div id='P1criteresrecherche'>";
    echo "<table id='P1criteres2'>";
    echo "<caption>Les critères de votre recherche</caption>";
    echo "<tr>";
    echo "<th>Type critère</th>";
    echo "<th>Valeur</th>";
    echo "</tr>";
    if (isset($_SESSION['catRecherche']) && $_SESSION['catRecherche'] != 1) {
        $tmpCat = categorie::NewById($_SESSION['catRecherche']);
        echo "<tr>";
        echo "<td>Catégorie</td>";
        echo "<td> " . $tmpCat->nom . "</td>";
        echo "</tr>";
        $filtreCategorie = $_SESSION['catRecherche'];
        $rechercheActivée = 1;
    } else {
        $filtreCategorie = 1;
    }
    if (isset($_SESSION['sscatRecherche']) && $_SESSION['sscatRecherche'] != 1) {
        $tmpSSCat = sous_categorie::NewById($_SESSION['sscatRecherche']);
        echo "<tr>";
        echo "<td>Sous-catégorie</td>";
        echo "<td> " . $tmpSSCat->nom . "</td>";
        echo "</tr>";
        $filtreSSCategorie = $_SESSION['sscatRecherche'];
        $rechercheActivée = 1;
    } else {
        $filtreSSCategorie = 1;
    }
    if (isset($_SESSION['listeRecherche']) && $_SESSION['listeRecherche'] != '') {
        echo "<tr>";
        echo "<td>Champ Texte</td>";
        echo "<td> " . $_SESSION['listeRecherche'] . "</td>";
        echo "</tr>";
        $ListeRecette = recette::RechercheListId($_SESSION['listeRecherche']);
        $rechercheActivée = 1;
    } else {
        $ListeRecette = recette::getListId();
    }
    echo"</table>";
    echo "</div>";
    //echo "<br>Liste des recettes apres recherche";
    //print_r($ListeRecette);
    /*
      echo "<br>criteres de recherche :";
      echo "<br> texte recherché : " . $_SESSION['listeRecherche'];
      echo "<br> filtre de categorie : " . $filtreCategorie;
      echo "<br> filtre de sous categorie : " . $filtreSSCategorie;
     */
    //echo "<br> recherche activee : " . $rechercheActivée;
} else {
    //echo"<br> pas de selection de recherche activee";
    if ($_SESSION['listeRecette'] == 'user') {
        //echo "<br> liste de recette de $membre->login";
        $ListeRecette = recette::getListIdByMembre($membre);
    } else {
        //echo "<br> liste globale de recette";
        $ListeRecette = recette::getListId();
    }
}
/*
  unset($_SESSION['listeRecherche']);
  unset($_SESSION['catRecherche']);
  unset($_SESSION['sscatRecherche']);

  $_SESSION['listeRecherche'] = '';
  $_SESSION['catRecherche'] = '1';
  $_SESSION['sscatRecherche'] = '1';
 */

// calcul du nombre de recettes a afficher 
// en trenant compte des recettes :
//          - non validees
//          - filtrees
$nbRecettes = 0;
foreach ($ListeRecette as $idRecette) {
    $recette = recette::NewById($idRecette);
    //echo "<br> analyse si $recette->titre est affichable";
    if ($rechercheActivée == 0) {
        // pas de recherche activée, on valide l'affichage
        //echo "<br> pas de filtrage ";
        $rechercheValidee = 1;
    } else {
        // un des parametres de recherche a été positionne
        // on verifie si la recette est affichable
        $rechercheValidee = 0;
        $rechercheCategorieValidee = 1;
        $rechercheSouscategorieValidee = 1;
        //echo "<br> filtrage activé ";
        if (($filtreCategorie != '1') && ($recette->id_cat != $filtreCategorie)) {
            //echo "<br> categorie invalide";
            $rechercheCategorieValidee = 0;
            //echo "<br> categorie OK";
        }
        if (($filtreSSCategorie != '1') && ($recette->id_ss_cat != $filtreSSCategorie)) {
            //echo "<br> sous categorie invalide";
            $rechercheSouscategorieValidee = 0;
            //echo "<br> sous categorie OK";
        }
        if ($rechercheCategorieValidee == 1 && $rechercheSouscategorieValidee == 1) {
            //echo "<br> recette validee";
            $rechercheValidee = 1;
        }
    }
    if ($rechercheValidee == 1) {
        if ($recette->publication == '1' || $_SESSION['listeRecette'] == 'user') {
            $nbRecettes++;
        }
    }
}
//$nbRecettes = count($ListeRecette);
$nbPage = $nbRecettes / $nbLigneParPages;
$_SESSION['nbPages'] = $nbPage;
if (isset($_SESSION['numPage']) && $_SESSION['numPage'] > 0) {
    $numPage = $_SESSION['numPage'];
    $firstRecette = $numPage * $nbLigneParPages;
    $lastRecette = $firstRecette + $nbLigneParPages;
} else {
    $numPage = 0;
    $firstRecette = $numPage * $nbLigneParPages;
    $lastRecette = $firstRecette + $nbLigneParPages;
}

echo"<h4>Nombre de recettes = " . $nbRecettes;
//echo"<br> nb page = " . $nbPage;
//echo"<br> nb lignes par page = " . $nbLigneParPages;
//echo"<br> page courante = " . $numPage;
//echo"<br> first recette = " . $firstRecette;
//echo"<br> last recette = " . $lastRecette;
// boucle sur les recettes
$firstRecetteAffichage = $firstRecette + 1;
$lastRecetteAffichage = $lastRecette;
if ($lastRecetteAffichage >= $nbRecettes) {
    $lastRecetteAffichage = $nbRecettes;
}
echo " (affichage des recettes $firstRecetteAffichage à $lastRecetteAffichage)</h4>";
echo "<div id = 'P1listingrecette' >";
echo "<table id='listedesrecettes'>";
echo "<tr>";
echo "<th>Photo</th>";
echo "<th>Titre</th>";
echo "<th>Catégorie</th>";
echo "<th>Sous-Catégorie</th>";
echo "<th>Note</th>";
if ($_SESSION['listeRecette'] == 'user') {
    echo "<th>Modification</th>";
}
if (isset($_SESSION['membre'])) {
    echo "<th>Préférée</th>";
}
if ($_SESSION['listeRecette'] == 'user') {
    echo "<th>Validée</th>";
}
echo "</tr>";
$numRecette = 0;
foreach ($ListeRecette as $idRecette) {
    $recette = recette::NewById($idRecette);
    if ($rechercheActivée == 0) {
        // pas de recherche activée, on valide l'affichage
        //echo "<br> pas de filtrage ";
        $rechercheValidee = 1;
    } else {
        // un des parametres de recherche a été positionne
        // on verifie si la recette est affichable
        $rechercheValidee = 0;
        $rechercheCategorieValidee = 1;
        $rechercheSouscategorieValidee = 1;
        //echo "<br> filtrage activé ";
        if (($filtreCategorie != '1') && ($recette->id_cat != $filtreCategorie)) {
            $rechercheCategorieValidee = 0;
            //echo "<br> categorie OK";
        }
        if (($filtreSSCategorie != '1') && ($recette->id_ss_cat != $filtreSSCategorie)) {
            $rechercheSouscategorieValidee = 0;
            //echo "<br> sous categorie OK";
        }
        if ($rechercheCategorieValidee == 1 && $rechercheSouscategorieValidee == 1) {
            //echo "<br> recette validee";
            $rechercheValidee = 1;
        } else {
            //echo "<br> recette non validee";
        }
    }
    if ($rechercheValidee == 1) {
        if (($recette->publication == '1') || ($_SESSION['listeRecette'] == 'user')) {
            //echo "<br> traitement de la ligne " . $numRecette;
            if (($numRecette >= $firstRecette) && ($numRecette < $lastRecette)) {
                // affichage de la ligne de la recette
                echo "<tr>";
                // recuperation de la photo
                $maPhoto = photo::NewByRecetteId($recette->id_recette);
				if ($maPhoto == null){
					$affPhoto="recette.jpeg";
				}else{
					$affPhoto=$maPhoto->lien;
				}
                //echo "<td>Photo à afficher</td>";
                echo "<td><img src='librairies/photos/$affPhoto' id='imagerecetteXS'></td>";
                echo "<td><a href='controleurs/recette/selectRecette.php?id=$idRecette' >$recette->titre</a></td>";
                $categorie = categorie::NewById($recette->id_cat);
                echo "<td>$categorie->nom</td>";
                $sousCategorie = sous_categorie::NewById($recette->id_ss_cat);
                //$sousCategorie = sous_categorie::NewById($recette->id_ss_cat);
                echo "<td>$sousCategorie->nom</td>";
                echo "<td>$recette->note/5 ($recette->nb_votes)</td>";
                if ($_SESSION['listeRecette'] == 'user') {
                    echo "<td><a href='controleurs/recette/selectModificationRecette.php?id=$idRecette' ><button>Modifier</button></a></td>";
                }
                if (isset($_SESSION['membre'])) {
                    $tmpUser = unserialize($_SESSION['membre']);
                    $preferee = preferee::check($recette->id_recette, $membre->id_membre);
                    if ($preferee != null) {
                        echo "<td><a href=controleurs/recette/gerePreferee.php?id=$recette->id_recette&membre=$membre->id_membre&action=retirer&idPref=$preferee->id_preferee><button>Oui</button></a></td>";
                    } else {
                        echo "<td><a href=controleurs/recette/gerePreferee.php?id=$recette->id_recette&membre=$membre->id_membre&action=ajouter><button>Non</button></a></td>";
                    }
                }
                if ($_SESSION['listeRecette'] == 'user') {
                    if ($recette->publication == '1') {
                        echo "<td>Oui</td>";
                    } else {
                        echo "<td>Non</td>";
                    }
                }
                echo "</tr>";
            }
            $numRecette++;
        }
    }
}
echo "</table>";
//echo"</table>"; 
//echo "<td></td>";
echo "</div>";
echo "<div id='updown'>";
echo "<div id='P1navpage'>";
echo "<table><tr>";

// afiichage du lien vers la page precedente
if ($numPage > 0) {
    //echo "<td><input type=submit value='precedent' onclick=\"windows.location='controleurs/recette/gestionPage.php?page=precedent';\"></td>";
    //echo "<td><a href='controleurs/recette/gestionPage.php?page=precedent'>precedent</a></td>";
    echo "<td><a href='controleurs/recette/gestionPage.php?page=precedent'><button class='petitcaractere'>Précédent</button></a></td>";
} else {
    echo "<td class='petitcaractere'>Précédent</td>";
}
//affichage selection 2 pages avant et 2 pages apres la pages courante
echo "<td>";
echo "</td>";
// afiichage du lien vers la page suivante 
if (($numPage + 1 ) < $nbPage) {
    echo "<td><a href='controleurs/recette/gestionPage.php?page=suivant'><button class='petitcaractere'>Suivant</button></a></td>";
} else {
    echo "<td class='petitcaractere'>Suivant</td>";
}
//echo "<td>select nb lignes/pages</td>";
// affichage du lien de creation de recette
echo "</tr></table>";
echo "</div>";
echo "<div id='P1newrecette'>";
if ($_SESSION['listeRecette'] == 'user') {
    echo "<a href='controleurs/recette/creationRecette.php'><button>Création d'une nouvelle recette</button></a>";
}

echo "</div>";

echo "</div>";
?>
