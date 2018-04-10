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
		$requete="select * from eleve order by nom";
		$resultats=$connexion->query($requete) ;
		echo "<table><caption><strong>liste des versement de BTS SIO</strong></caption>";
		echo "<thead> <!-- En-tête du tableau -->";
		echo "<tr><th>idVersement</th>  <th>anneeVersement</th><th>idContact</th>   <th>dateLettreRemerciement</th>   <th>montantVerse</th>  <th>idEntreprise</th>   <th>idOrigine</th> </tr>";
		echo "</thead>";
		echo "<tfoot> <!-- Pied de tableau -->";
		echo "<tr></tr>";
		echo "</tfoot>";
		echo "<tbody> <!-- Corps du tableau -->";
		$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		while($ligne){
			echo "<tr><td>".$ligne->idVersement."</td>";
			echo "<td>".$ligne->anneeVersement."</td>";
			echo "<td>".$ligne->idContact."</td>";
			echo "<td>".$ligne->dateLettreRemerciement."</td>";
			echo "<td>".$ligne->montantVerse."</td>";
			echo "<td>".$ligne->idEntreprise."</td>";
			echo "<td>".$ligne->idOrigine."</td></tr>";
			$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		}
	}
	else{
		echo "problème à la connexion <br />";
	}
$resultats->closeCursor(); 
?>
</table>
