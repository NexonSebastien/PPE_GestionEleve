<?php 
$PARAM_hote='localhost';
$PARAM_port='3306';
$PARAM_nom_bd='snEleve';
$PARAM_utilisateur='root';
$PARAM_mot_passe="";

try{
	$connexion=new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
	$PARAM_utilisateur,$PARAM_mot_passe);
	}
	catch(exception$e){
		echo 'erreur:'.$e->getMessage().'<br/>';
		echo 'n°:'.$e->getcode();
	}
	
echo 'Eleve ajouter sur le CSV';

#SQL
$requete_prepare_insert = $connexion->prepare ("
DELETE INTO Eleve (nom,
					prenom,
					adresseMail) VALUES (:nomSQL,
										:prenomSQL,
										:adresseMailSQL)");
$requete_prepare_insert -> execute(array('nomSQL' => $_POST['nom'],
'prenomSQL' =>  $_POST['prenom'],
'adresseMailSQL' =>  $_POST['adresseMail']));


#CSV
$monfichier = fopen('BDD\\ELEVE.csv','a+');
fputs($monfichier,$_POST['nom'].';'.$_POST['prenom'].';'.$_POST['adresseMail']."\n");
fclose($monfichier);
#FIN CSV

#SQL CSV
	$monfichier = fopen('BDD\\ELEVE.csv','r+');
	$ligne=fgets($monfichier);
		while ($ligne)
		{
			$info = explode(';',$ligne);
			$ligne=fgets($monfichier);
			$requete_prepare_insert = $connexion->prepare ("
INSERT INTO Eleve (nom,
					prenom,
					adresseMail) VALUES (:nomSQL,
										:prenomSQL,
										:adresseMailSQL)");
$requete_prepare_insert -> execute(array('nomSQL' => $info[0],
'prenomSQL' =>  $info[1],
'adresseMailSQL' =>  $info[2]));
		}
	fclose($monfichier);
#FIN SQL CSV
echo "L'insertion de" .$_POST['prenom'].$monfichier,$_POST['nom'].$_POST['adresseMail']
 ?>


