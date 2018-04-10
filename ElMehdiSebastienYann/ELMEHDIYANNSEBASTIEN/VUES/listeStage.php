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
		$requete="select * from stage order by idStage";
		$resultats=$connexion->query($requete) ;
		echo "<table><caption><strong>liste des stages de BTS SIO</strong></caption>";
		echo "<thead> <!-- En-tête du tableau -->";
		echo "<tr><th>idStage</th>  <th>nomResponsableStage</th><th>dateDebut</th>   <th>dateFin</th>   <th>dateRDV</th>  <th>heureRDV</th>   <th>idEntreprise</th>    <th>idEleve</th>  <th>idProf</th> </tr>";
		echo "</thead>";
		echo "<tfoot> <!-- Pied de tableau -->";
		echo "<tr></tr>";
		echo "</tfoot>";
		echo "<tbody> <!-- Corps du tableau -->";
		$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		while($ligne){
			echo "<tr><td>".$ligne->idStage."</td>";
			echo "<td>".$ligne->nomResponsableStage."</td>";
			echo "<td>".$ligne->dateDebut."</td>";
			echo "<td>".$ligne->dateFin."</td>";
			echo "<td>".$ligne->dateRDV."</td>";
			echo "<td>".$ligne->heureRDV."</td>";
			echo "<td>".$ligne->idEntreprise."</td>";
			echo "<td>".$ligne->idEleve."</td>";
			echo "<td>".$ligne->idProf."</td></tr>";
			$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		}
	}
	else{
		echo "problème à la connexion <br />";
	}
$resultats->closeCursor(); 
?>
</table>