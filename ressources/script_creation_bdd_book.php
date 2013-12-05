<?php

//Cr�ation de la BDD

$requete[1]="CREATE DATABASE if not exists `book`;";

//Cr�ation des tables avec les champs associ�s et leur type

$requete[2]="CREATE TABLE if not exists `chat` (`id` int(11) AUTO_INCREMENT PRIMARY KEY, `contenu` longtext NOT NULL, `id_utilisateur` int(11) NOT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE = InnoDB;";
$requete[3]="CREATE TABLE if not exists `commentaire` (`id` INT(11) AUTO_INCREMENT PRIMARY KEY, `id_utilisateur` int(11) NOT NULL, `id_element` int(11) NOT NULL, `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, `contenu` text NOT NULL) ENGINE = InnoDB;";
$requete[4]="CREATE TABLE if not exists `contact` (`id_utilisateur1` int(11) NOT NULL, `id_utilisateur2` int(11) NOT NULL, `accept` tinyint(1) NOT NULL DEFAULT '0', PRIMARY KEY (`id_utilisateur1`,`id_utilisateur2`)) ENGINE = InnoDB;";
$requete[5]="CREATE TABLE if not exists `dossier` (`id` int(11) AUTO_INCREMENT PRIMARY KEY, `id_utilisateur` int(11) NOT NULL, `nom` varchar(50) NOT NULL) ENGINE = InnoDB;";
$requete[6]="CREATE TABLE if not exists `element` (`id` int(11) AUTO_INCREMENT PRIMARY KEY, `id_utilisateur` int(11) NOT NULL, `date` timestamp NOT NULL, `contenu` text NOT NULL) ENGINE = InnoDB;";
$requete[7]="CREATE TABLE if not exists `like` (`id` int(11) AUTO_INCREMENT PRIMARY KEY, `id_utilisateur1` int(11) NOT NULL, `id_utilisateur2` int(11) NOT NULL, `id_element` int(11) NOT NULL) ENGINE = InnoDB;";
$requete[8]="CREATE TABLE if not exists `message` (`id` int(11) AUTO_INCREMENT PRIMARY KEY, `expediteur` int(11) NOT NULL, `receveur` int(11) NOT NULL, `text` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL, `time` datetime NOT NULL, `lu` enum('0','1') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL) ENGINE = InnoDB;";
$requete[9]="CREATE TABLE if not exists `utilisateur` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,`prenom` varchar(50) NOT NULL,`mdp` varchar(256) NOT NULL,`nom` varchar(40) NOT NULL,`mail` varchar(50) NOT NULL,`date_naissance` date NOT NULL,`sexe` varchar(10) NOT NULL,`sexualite` varchar(10) DEFAULT NULL,`situation_amoureuse` varchar(50) DEFAULT NULL,`langue` varchar(50) DEFAULT NULL,`religion` text,`politique` text,`adresse` text,`ville` text,`cp` int(5) DEFAULT NULL,`telephone` int(10) DEFAULT NULL,`emplois` varchar(50) DEFAULT NULL,`scolarite` varchar(50) DEFAULT NULL,`apropos` text,`citationsFavorites` text) ENGINE = InnoDB;";

//Cr�ation des contraintes de cl� �trang�re par table

$requete[10]="ALTER TABLE `chat` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`);";
$requete[11]="ALTER TABLE `commentaire` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`);";
$requete[12]="ALTER TABLE `commentaire` ADD FOREIGN KEY (`id_element`) REFERENCES `element`(`id`);";
$requete[13]="ALTER TABLE `contact` ADD FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur`(`id`);";
$requete[14]="ALTER TABLE `contact` ADD FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur`(`id`);";
$requete[15]="ALTER TABLE `dossier` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`);";
$requete[16]="ALTER TABLE `element` ADD FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur`(`id`);";
$requete[17]="ALTER TABLE `like` ADD FOREIGN KEY (`id_utilisateur1`) REFERENCES `utilisateur`(`id`);";
$requete[18]="ALTER TABLE `like` ADD FOREIGN KEY (`id_utilisateur2`) REFERENCES `utilisateur`(`id`);";
$requete[19]="ALTER TABLE `like` ADD FOREIGN KEY (`id_element`) REFERENCES `utilisateur`(`id`);";
$requete[20]="ALTER TABLE `message` ADD FOREIGN KEY (`expediteur`) REFERENCES `utilisateur`(`id`);";
$requete[21]="ALTER TABLE `message` ADD FOREIGN KEY (`receveur`) REFERENCES `utilisateur`(`id`);";

//Connexion � la BDD

$user="root";
$pass="";
$host="localhost";
$bdd="Book";

$pdo = new PDO("mysql:host=".$host.";dbname=".$bdd,$user,$pass);
print "Connexion a la BDD : ".$bdd."@".$host."<br><br><br>";

//Affichage puis execution des requ�tes une � une

for ($i=1;$i<=21;$i++)
{
	print "Ex&eacutecution de la requ�te :<br>";
	print $requete[$i]."<br>";	
	$response = $pdo->exec($requete[$i]);
	print $response."<br><br>";
}

?>