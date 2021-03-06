drop database popote;
create database popote;

connect popote; 

CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `type` varchar(10) ,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `membres` (`id_membre`, `login`, `password`, `nom`, `prenom`, `email`, `type`) VALUES
(1, 'bfr', 'bfr', 'Froger', 'Bruno', 'bruno.froger@orange.com', 'admin'),
(2, 'hlq', 'bfr', 'Le Queau', 'Helene', 'helene.lequeau@orange.com', 'admin'),
(3, 'bte', 'bte', 'Terrien', 'Bruno', 'bruno.terrien@orange.com', 'user');


CREATE TABLE IF NOT EXISTS `recettes` (
  `id_recette` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL ,
  `titre` varchar(50) NOT NULL,
  `nb_pers` int(10) NOT NULL,
  `cat_prix` varchar(20) NOT NULL,
  `cat_diff` varchar(20) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `preparation` varchar(100) NOT NULL,
  `cuisson` varchar(100) NOT NULL,
  `conseil` varchar(250) NOT NULL,
  `id_cat` int(11) NOT NULL ,
  `id_ss_cat` int(11) NOT NULL ,
  PRIMARY KEY (`id_recette`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `recettes` (`id_recette`, `id_membre`, `titre`, `nb_pers`, `cat_prix`, `cat_diff`, `description`, `preparation`, `cuisson`, `conseil`, `id_cat`, `id_ss_cat`) VALUES 
(1, 1, 'soupe', 4, 'bon marche', 'facile', 'cuire les legumes, mouliner, servir', '10mn', '20mn', 'ajouter de la creme au moment de servir', 1, 1);

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `categorie` (`id_cat`, `nom`, `description`) VALUES
(1, 'entree', 'pour bien ciommencer vos repas'),
(2, 'plat principal', 'bla bla bla'),
(3, 'dessert', 'bla bla bla');

CREATE TABLE IF NOT EXISTS `sous_categorie` (
  `id_ss_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `id_cat` int(11) NOT NULL ,
  PRIMARY KEY (`id_ss_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `sous_categorie` (`id_ss_cat`, `nom`, `description`, `id_cat`) VALUES
(1, 'entree chaude', 'dfqsdf', 1),
(2, 'viande', 'dfqsdf', 2),
(3, 'poisson', 'dfqsdf', 2),
(4, 'glace', 'dfqsdf', 3);


CREATE TABLE IF NOT EXISTS `ingredients` (
  `id_ingredient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `couleur` varchar(50) NOT NULL,
  `type` varchar(11) NOT NULL ,
  PRIMARY KEY (`id_ingredient`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `ingredients` (`id_ingredient`, `nom`, `couleur`, `type`) VALUES
(1, 'poireau', 'vert', 'legume'),
(2, 'pomme de terre', 'jaune', 'legume'),
(3, 'carotte', 'rouge', 'legume'),
(4, 'sel', 'blanc', 'condiments'),
(5, 'poivre', 'noir', 'condiments'),
(6, 'sucre', 'blanc', '??'),
(7, 'sucre', 'roux', '??'),
(8, 'pomme', 'jaune', 'fruit');

CREATE TABLE IF NOT EXISTS `constituants` (
  `id_constituant` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(11) NOT NULL ,
  `id_ingredient` int(11) NOT NULL,
  `quantite` varchar(50) NOT NULL,
  PRIMARY KEY (`id_constituant`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `constituants` (`id_constituant`, `id_recette`, `id_ingredient`, `quantite`) VALUES
(1, 1, 1, '2'),
(2, 1, 2, '2'),
(3, 1, 3, '1'),
(4, 1, 4, 'une pincee');

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(11) NOT NULL ,
  `id_user` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `commentaires` (`id_commentaire`, `id_recette`, `id_user`, `message`) VALUES
(1, 1, 1, 'commentaire du user 1 sur la recette 1 '),
(2, 1, 2, 'commentaire du user 2 sur la recette 1 '),
(3, 1, 3, 'commentaire du user 3 sur la recette 1 ');

CREATE TABLE IF NOT EXISTS `photos` (
  `id_photo` int(11) NOT NULL AUTO_INCREMENT,
  `id_recette` int(11) NOT NULL ,
  `lien` varchar(100) NOT NULL,
  PRIMARY KEY (`id_photo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

INSERT INTO `photos` (`id_photo`, `id_recette`, `lien`) VALUES
(1, 1, 'lien vers photo 1 de recette 1 '),
(2, 2, 'lien vers photo 2 de recette 1 '),
(3, 3, 'lien vers photo 3 de recette 1 ');



