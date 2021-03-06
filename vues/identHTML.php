<?php
session_start();
$myIncludePath = '/var/www/html/popote';
set_include_path(get_include_path() . PATH_SEPARATOR . $myIncludePath);
include_once 'modeles/membre/classe_membre.php';
include_once 'modeles/recette/classe_recette.php';
include_once 'modeles/ingredient/classe_ingredient.php';
//session_destroy();
//$membre = membre::NewByLogin('bte');
//$membre = membre::NewByLogin('bfr');
//$_SESSION['membre'] = serialize($membre);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>
                Ma Popote Au Quotidien
            </title>
            <link rel="stylesheet" type="text/css" href="css/contenu.css" media="all">
                </head>

                <body>

                    <div id="global">
                        <div id="entete">
                            <a href=""><h1>MaPopoteAuQuotidien.fr</h1></a>
                            <div id="connect">
                                <p> Bonjour </p>
                                <p> <?php include_once 'controleurs/accueil/bonjour.php'; ?></p>
                            </div><!-- #connect -->
                        </div><!-- #entete -->

                        <div id="menu">
                            <ul>
                                <?php include_once 'controleurs/accueil/menu.php'; ?>
                            </ul>
                        </div><!-- #menu -->	


                        <div id='contenu'> <!-- #cadre descriptif recette -->
                            <!-- ---------------------- contenu identification membre ----------------------- -->  
                            <div id='identconnexion'>
                                <form action='identmembre.php'>
                                    <div id='connectmembre'>
                                        <table id='saisielogin'> 
                                            <caption> S'identifier & se connecter </caption>
                                            <tr> 
                                                <td>Login </td> 
                                                <td> <input type='text' name='login' value='votre login'> </td>
                                            </tr>
                                            <tr> 
                                                <td>Mot de passe </td> 
                                                <td> <input type='text' name='pwd' value='votre pwd'> </td>
                                            </tr>
                                        </table> 
                                    </div> <!-- fin connectmembre -->
                                    <div id='validlogin'> 
                                        <input type='submit' value='Connexion'>
                                    </div><!-- fin validlogin -->

                                </form> 
                            </div> <!-- fin identconnexion -->
                            <div id='creermoncompte'>
                                <form action='saisiecompte.php'>
                                    <input type='submit' value='Se créer un compte utilisateur'>

                                </form> 
                            </div> <!-- fin creermoncompte -->
                            <div id='mailadmin'>
                                <form action='mailadmin.php'>
                                    <div id='mailinfoperdue'   >
                                        <table id='oublilogin'> 
                                            <caption> J'ai oublié mon login (ou mon mot de passe) </caption>
                                            <tr> 
                                                <td>mon adresse mail  </td> 
                                                <td> <input type='text' name='monmail' value='@ mail'size='50'> </td>
                                            </tr>
                                        </table> 
                                    </div>
                                    <div id='envoimailadmin'> 
                                        <input type='submit' value='Demande infos connexion'>
                                    </div>
                                </form> 
                            </div> <!-- fin mailadmin -->


                            <!-- ---------------------- fin contenu identification membre ----------------------- -->
                        </div><!-- #contenu -->


                        <div id='footer'>
                            <h1>pied-de-page</h1>
                        </div><!-- #pied-de-page -->

                    </div><!-- #global -->



                </body></html>
