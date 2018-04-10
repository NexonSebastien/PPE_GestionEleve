<p>Bonjour !</p>
<p>Récupération des Elèves</p> 
<?php
//ouvrir le fichier
 $monfichier = fopen('BDD\entvers2015.csv', 'r');
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