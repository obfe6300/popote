<?php 

//header( 'content-type: text/html; charset=iso-8859-1' );

//session_destroy();

//$membre = membre::NewByLogin('bte');
//$membre = membre::NewByLogin('bfr');
//$_SESSION['membre'] = serialize($membre);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"><head>
        <!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"-->
        <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8"-->
            <title>
                Ma Popote Au Quotidien
            </title>
            <link rel="stylesheet" type="text/css" href="/popote/vues/css/contenu.css" media="all">
                </head>

                <body>

                    <div id="global">
                        <div id="entete">
                            <a href="/popote/controleurs/accueil/resetSession.php"><h1>MaPopoteAuQuotidien.fr</h1></a>
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


                        <div id="contenu"> <!-- #cadre descriptif recette -->
                           
                            <?php include_once 'controleurs/accueil/contenu.php'; ?>

                        </div><!-- #contenu -->
                        
                        <!-- ---------------------- zone des commentaires membres ------------ -->
                        <div id='commentaire'>
                            <?php include_once 'controleurs/accueil/commentaires.php'; ?>
                        </div>
                        <!-- ---------------------- fin zone des commentaires membres-------- --> 

                        
                        
                        <div id='footer'>
                            <?php include_once 'controleurs/piedPage/piedPage.php'; ?>
                            <!--<h1>pied-de-page</h1>-->
                        </div><!-- #pied-de-page -->

                    </div><!-- #global -->



                </body></html>
