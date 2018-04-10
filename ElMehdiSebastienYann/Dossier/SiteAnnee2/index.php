<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="exercices, php" />
		<meta name="description" content="TP javascript" />
		<title>ELEVES BTS SIO1</title>
		<link type="text/css" rel="stylesheet" href="css/style.css" />   
		<link type="text/css" rel="stylesheet" href="css/tableau.css" />   
	</head>
	<body>
 		<header>
			<?php 
				$PARAM_hote='localhost'; // le chemin vers le serveur
				$PARAM_port='3306';
				$PARAM_nom_bd='gp2btssio'; // le nom de votre base de données
				$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
				$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
//	$connexion =connexionMysqlBdd($PARAM_hote, $PARAM_port, $PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	try{ 
		$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	}  
	catch(Exception $e){
		echo 'Erreur : '.$e->getMessage().'<br />';  
		echo 'N° : '.$e->getCode();
	}
			session_start();
			require_once("FONCTIONS/fct.inc.php");
			include("vues/enTete.php"); ?>
		</header> <!--fin entete-->
		<div id="conteneur">
			<nav id= "navigation">	
				<?php include("vues/menu.php"); ?>
			</nav> <!-- fin "navigation"-->	
			<div id="page">
				<?php 
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				}
				else  {
					$page = "accueil"; 
				}
				switch ($page) {
					case "accueil" : 
						include ("VUES/accueil.php");
						break;
					case "insertion" :
						include ("VUES/recuperationEntreprises.php");
						break;
					case "gestion" :
						include ("VUES/listeEleves.php");
						break;
					case "gestion des classes" :
						include ("VUES/listeClasse.php");
						break;
					case "gestion des professeurs" :
						include ("VUES/listeProf.php");
						break;
					case "gestion des filières" :
						include ("VUES/listeFiliere.php");
						break;
					case "gestion des options" :
						include ("VUES/listeOption.php");
						break;
					case "entreprises" :
						include ("VUES/listeEntreprise.php");
						break;
					case "gestion des type d'entreprise" :
						include ("VUES/listeTypeEntreprise.php");
						break;
					case "gestion des versement" :
						include ("VUES/listeVersement.php");
						break;
					case "gestion des contact" :
						include ("VUES/listeContact.php");
						break;
					case "gestion des origine" :
						include ("VUES/listeOrigine.php");
						break;
					case "gestion des stage" :
						include ("VUES/listeStage.php");
						break;
					case "formulaire" :
						include ("VUES/gestionEntreprise.php");
						break;
					default :
						include ("VUES/erreur.php");
						break;	
				}
				?>
			</div><!--fin "page"-->
		</div><!-- fin de "conteneur" -->
		<footer>
			<?php include("vues/pied.php"); ?>
		</footer><!-- fin de pied -->
	</body>
</html>
