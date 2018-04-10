<?php
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
  // connexion réussie
		$requete="select * from entreprise order by idEntreprise";
		$resultats=$connexion->query($requete) ;
		echo "<table><caption><strong>liste des entreprises </strong></caption>";
		echo "<thead> <!-- En-tête du tableau -->";
		echo "<tr><th>idEntreprise</th> <th>raisonSociale</th> <th>adresse1</th> <th>adresse2</th> <th>adresse3</th>  <th>codePostal</th>   <th>ville</th></tr>";
		echo "</thead>";
		echo "<tfoot> <!-- Pied de tableau -->";
		echo "<tr></tr>";
		echo "</tfoot>";
		echo "<tbody> <!-- Corps du tableau -->";
		$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		while($ligne){
			echo "<tr><td>".$ligne->idEntreprise."</td>";
			echo "<td>".$ligne->raisonSocial."</td>";
			echo "<td>".$ligne->ad1."</td>";
			echo "<td>".$ligne->ad2."</td>";
			echo "<td>".$ligne->ad3."</td>";
			echo "<td>".$ligne->codePostal."</td>";
			echo "<td>".$ligne->ville."</td>";
			$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		}
	}
	else{
		echo "problème à la connexion <br />";
	}
$resultats->closeCursor(); 
?>
</table>
