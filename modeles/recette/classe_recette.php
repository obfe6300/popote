<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class recette {

    public $id_recette;
    public $id_membre='';
    public $titre='';
    public $nb_pers='';
    public $cat_prix='';
    public $cat_diff='';
    public $description='';
    public $cuisson='';
    public $preparation='';
    public $conseil='';
    public $id_cat='';
    public $id_ss_cat='';
    public $note='';
    public $nb_votes='';
    public $somme_notes;
    public $publication;

    static public function NewById($id) {
        $tmp = new recette();
        if ($tmp->getById($id)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function NewByTitre($id) {
        $tmp = new recette();
        if ($tmp->getByTitre($id)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function NewCreate($id_membre, $titre, $nb_pers, $cat_prix, $cat_diff, $description, $cuisson, $preparation, $conseil, $id_cat, $id_ss_cat, $note, $nb_votes, $somme_notes, $publication) {
        $tmp = new recette();
        if ($tmp->create($id_membre, $titre, $nb_pers, $cat_prix, $cat_diff, $description, $cuisson, $preparation, $conseil, $id_cat, $id_ss_cat, $note, $nb_votes,$somme_notes,$publication)) {
            return $tmp;
        } else {
            return null;
        }
    }

    static public function getListId() {
        $requete = "select id_recette from recettes where publication='1'";
        //echo ("<p>requete = $requete </p>");
        return recette::getRequeteList($requete);
    }

    static public function getListAllId() {
        $requete = "select id_recette from recettes";
        //echo ("<p>requete = $requete </p>");
        return recette::getRequeteList($requete);
    }

    static public function RechercheListId($texte) {
        $requete = "select id_recette from recettes where titre like '%$texte%'";
        //echo ("<p>requete = $requete </p>");
        return recette::getRequeteList($requete);
    }

    public function getListIdByMembre($membre) {
        $requete = "select id_recette from recettes where id_membre=$membre->id_membre";
        //echo ("<p>requete = $requete </p>");
        return recette::getRequeteList($requete);
    }

    private function getRequeteList($requete) {
        $listIdRecettes = array();
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mesItems = $dbh->query($requete);
            $dbh = null;
            //echo ("<p>requete executee $requete</p>");
            //print_r($mesItems);
            $mesItems->setFetchMode(PDO::FETCH_ASSOC);
            if ($mesItems->rowCount() > 0) {
                foreach ($mesItems as $monItem) {
                    array_push($listIdRecettes, $monItem['id_recette']);
                }
                return $listIdRecettes;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "une erreur est survenue : " . $e->getMessage();
            return false;
        }
    }

    public function getById($id) {
        $requete = "select * from recettes where id_recette='$id'";
        return $this->getRequete($requete);
    }

    public function getByTitre($id) {
        $requete = "select * from recettes where titre='$id'";
        return $this->getRequete($requete);
    }

    private function getRequete($requete) {
        //echo ("<br>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mesItems = $dbh->query($requete);
            $dbh = null;
            //echo ("<p>requete executee</p>");
            $mesItems->setFetchMode(PDO::FETCH_ASSOC);
            if ($mesItems->rowCount() > 0) {
                foreach ($mesItems as $monItem) {
                    $this->id_recette = $monItem['id_recette'];
                    $this->id_membre = $monItem['id_membre'];
                    $this->titre = $monItem['titre'];
                    $this->nb_pers = $monItem['nb_pers'];
                    $this->cat_prix = $monItem['cat_prix'];
                    $this->cat_diff = $monItem['cat_diff'];
                    $this->description = $monItem['description'];
                    $this->cuisson = $monItem['cuisson'];
                    $this->preparation = $monItem['preparation'];
                    $this->conseil = $monItem['conseil'];
                    $this->id_cat = $monItem['id_cat'];
                    $this->id_ss_cat = $monItem['id_ss_cat'];
                    $this->note = $monItem['note'];
                    $this->nb_votes = $monItem['nb_votes'];
                    $this->somme_notes = $monItem['somme_notes'];
                    $this->publication = $monItem['publication'];
                }
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "une erreur est survenue : " . $e->getMessage();
            return false;
        }
    }

    public function create($id_membre, $titre, $nb_pers, $cat_prix, $cat_diff, $description, $cuisson, $preparation, $conseil, $id_cat, $id_ss_cat, $note, $nb_votes, $somme_notes, $publication) {
        $requete = "insert into recettes (id_membre, titre, nb_pers, cat_prix, cat_diff, description, cuisson, preparation, conseil, id_cat, id_ss_cat, note, nb_votes, somme_notes, publication) values ('$id_membre', '$titre', '$nb_pers', '$cat_prix', '$cat_diff', '$description', '$cuisson', '$preparation', '$conseil', '$id_cat', '$id_ss_cat', '$note', '$nb_votes', '$somme_notes', '$publication')";
        echo ("<p>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo ("<p>cnx base OK</p>");
            $mesItems = $dbh->query($requete);
            print_r($mesItems);
            if ($mesItems != false) {
                $dbh = null;
                //echo ("<p>requete executee</p>");
                $mesItems->setFetchMode(PDO::FETCH_ASSOC);
                $this->getByTitre($titre);
                return true;
            } else {
                $dbh = null;
                //echo ("<p>erreur sur requete</p>");
                return false;
            }
        } catch (PDOException $e) {
            echo "<p>une erreur est survenue lors de la creation de la recette : " . $e->getMessage();
            return false;
        }
        return false;
    }

    public function update($id_recette, $id_membre, $titre, $nb_pers, $cat_prix, $cat_diff, $description, $cuisson, $preparation, $conseil, $id_cat, $id_ss_cat, $note, $nb_votes, $somme_notes, $publication) {
        //$requete = "update recettes set id_membre='$id_membre', titre='$titre', nb_pers='$nb_pers', cat_prix='$cat_prix', cat_diff='$cat_diff', description='$description', cuisson='$cuisson', preparation='$preparation', conseil='$conseil', id_cat$='$id_cat', id_ss_cat$'$id_ss_cat', note$'$note', nb_votes='$nb_votes', publication='$publication' where id_recette='$id_recette'";
        $requete = "update recettes set id_membre='".$this->aliasTexte($id_membre)
                ."', titre='".$this->aliasTexte($titre)
                ."', nb_pers='".$this->aliasTexte($nb_pers)
                ."', cat_prix='".$this->aliasTexte($cat_prix)
                . "', cat_diff='".$this->aliasTexte($cat_diff)
                . "', description='".$this->aliasTexte($description)
                . "', cuisson='".$this->aliasTexte($cuisson)
                . "', preparation='".$this->aliasTexte($preparation)
                . "', conseil='".$this->aliasTexte($conseil)
                . "', id_cat='".$this->aliasTexte($id_cat)
                . "', id_ss_cat='".$this->aliasTexte($id_ss_cat)
                . "', note='".$this->aliasTexte($note)
                . "', nb_votes='".$this->aliasTexte($nb_votes)
                . "', somme_notes='".$this->aliasTexte($somme_notes)
                . "', publication='".$this->aliasTexte($publication)
                . "' where id_recette='".$this->aliasTexte($id_recette)."'";
        echo ("<p>requete update recette = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo ("<p>cnx base OK</p>");
            $mesItems = $dbh->query($requete);
            if ($mesItems != false) {
                $dbh = null;
                //echo ("<p>requete executee</p>");
                $mesItems->setFetchMode(PDO::FETCH_ASSOC);
                $this->getByTitre($titre);
                return true;
            } else {
                $dbh = null;
                $this->getByTitre($titre);
                //echo ("<p>erreur sur requete</p>");
                return false;
            }
        } catch (PDOException $e) {
            $this->getByTitre($titre);
            echo "<p>une erreur est survenue lors de l'update du user: " . $e->getMessage();
            return false;
        }
        return false;
    }

    public function delete() {
        $requete = "delete from recettes where id_recette='$this->id_recette'";
        //echo ("<p>requete = $requete </p>");
        try {
            $dbh = new PDO(SERVEUR, USER, PWD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $mesItems = $dbh->query($requete);
            //echo ("<p>requete executee</p>");
            $dbh = null;
        } catch (PDOException $e) {
            echo "une erreur est survenue : " . $e->getMessage();
        }
    }

    static public function checkUnique($recette) {
        //echo "<p> verification unicite d'un user</p>";
        $tst_recette = new recette;
        if ($tst_recette->getById($recette->id) || $tst_recette->getByTitre($recette->titre)) {
            return false;
        }
        return true;
    }

    public function affiche() {
        echo "<table>";
        echo "<tr><td>id_recette</td><td>" . $this->id_recette . "</td></tr>";
        echo "<tr><td>id_membre</td><td>" . $this->id_membre . "</td></tr>";
        echo "<tr><td>titre</td><td>" . $this->titre . "</td></tr>";
        echo "<tr><td>cat_prix</td><td>" . $this->cat_prix . "</td></tr>";
        echo "<tr><td>cat_diff</td><td>" . $this->cat_diff . "</td></tr>";
        echo "<tr><td>description</td><td>" . $this->description . "</td></tr>";
        echo "<tr><td>cuisson</td><td>" . $this->cuisson . "</td></tr>";
        echo "<tr><td>preparation</td><td>" . $this->preparation . "</td></tr>";
        echo "<tr><td>conseil</td><td>" . $this->conseil . "</td></tr>";
        echo "<tr><td>id_cat</td><td>" . $this->id_cat . "</td></tr>";
        echo "<tr><td>id_ss_cat</td><td>" . $this->id_ss_cat . "</td></tr>";
        echo "<tr><td>note</td><td>" . $this->note . "</td></tr>";
        echo "<tr><td>somme notes</td><td>" . $this->somme_notes . "</td></tr>";
        echo "<tr><td>nb_vote</td><td>" . $this->nb_vote . "</td></tr>";
        echo "</table>";
    }

    public function aliasTexte($chaine){
        $healthy=array("'");
        $yummy=array("\'");
        return str_replace($healthy, $yummy, $chaine);
    }
}

?>
