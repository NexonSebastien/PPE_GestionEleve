<p>Bonjour !</p>
<p>Récupération des Elèves</p> 

<?php
//ouvrir le fichier
 $monfichier = fopen('BDD\entvers2015.csv', 'r');
 // connexion base de données
 /*$PARAM_hote='localhost'; // le chemin vers le serveur
	$PARAM_port='3306';
	$PARAM_nom_bd='gp2btssio'; // le nom de votre base de données
	$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
	try{ 
		$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	}  
	catch(Exception $e){
		echo 'Erreur : '.$e->getMessage().'<br />';  
		echo 'N° : '.$e->getCode();
	}*/
	if ($connexion) {
		//lire 1ere ligne
		$ligne = fgets($monfichier);
		$ligne = fgets($monfichier);
		while($ligne) {
	
			
			//traiter la ligne (éclater les infos dans un tableau
			// récupérer les informations dans un tableau
			$tab = explode (';', $ligne);
                        print_r($tab);
			
			//construire l'insert de la ligne dans la table
			// on prépare notre requête
			$req= 'insert into entreprise( raisonSocial, ad1,ad2, ad3, codePostal, ville) values(:raisonSocial,:ad1,:ad2,:ad3,:codePostal,:ville)'; 
			$requete_preparee=$connexion->prepare($req); 
		
			//inserer dans la table (exécuter l'ordre insert)
			try{
				$requete_preparee->execute(array( ':raisonSocial' => $tab[1],':ad1' => $tab[2],':ad2'=> $tab[2],':ad3'=> $tab[4],':codePostal'=> $tab[5],':ville'=> $tab[6]));
			}
			catch(Exception $e){
				echo 'Erreur : '.$e->getMessage().'<br />';  
				echo 'N° : '.$e->getCode();
			}
?>
		
<br />
<?php
 //faire une boucle (tant que non fin de fichier)
		//lire  ligne suivante
		$ligne = fgets($monfichier);
		}  
   }
	
?>

<br/><br/>