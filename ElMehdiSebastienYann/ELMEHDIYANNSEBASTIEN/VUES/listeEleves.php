<?php
	$PARAM_hote='localhost'; // le chemin vers le serveur
	$PARAM_port='3306';
	$PARAM_nom_bd='snBTSSIO'; // le nom de votre base de données
	$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
	try{ 
		$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
	}  
	catch(Exception $e){
		echo 'Erreur : '.$e->getMessage().'<br />';  
		echo 'N° : '.$e->getCode();
	}
	
	if ($connexion) {
		//connexion réussie
		?>
			
		
		
		
		
		<?php
		$requete="select * from eleve e,filiere f,classe c,optionfiliere o where e.idFiliere=f.idFiliere and e.idClasse=c.idClasse and e.idOption=o.idOption order by nom";
		$resultats=$connexion->query($requete) ;
		echo "<table><caption><strong>liste des élèves de BTS SIO</strong></caption>";
		echo "<thead> <!-- En-tête du tableau -->";
		echo "<tr><th>Numéro élève</th>  <th>Nom élève</th>  <th>Prenom élève</th><th>Filière</th>   <th>Classe</th>   <th>Option</th>  <th>Année Diplôme</th>   <th>Adresse électronique</th>    <th>cv</th>  <th>photo</th> </tr>";
		echo "</thead>";
		echo "<tfoot> <!-- Pied de tableau -->";
		echo "<tr></tr>";
		echo "</tfoot>";
		echo "<tbody> <!-- Corps du tableau -->";
		$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
		while($ligne){
			echo "<tr><td>".$ligne->idEleve."</td>";
			echo "<td>".$ligne->nom."</td>";
			echo "<td>".$ligne->prenom."</td>";
			echo "<td>".$ligne->nomFiliere."</td>";
			echo "<td>".$ligne->nomClasse."</td>";
			echo "<td>".$ligne->nomOption."</td>";
			echo "<td>".$ligne->anneeDiplome."</td>";
			echo "<td>".$ligne->adresseEmail."</td>";
			if ($ligne->nom != "BELHADRI"&&
			$ligne->nom != "ADRIAENSSENS"&&
			$ligne->nom != "BOURGET"&&
			$ligne->nom != "BUNEL"&&
			$ligne->nom != "DA SILVA"&&
			$ligne->nom != "EMERY"&&
			$ligne->nom != "GOUGEON"&&
			$ligne->nom != "HERBELIN"&&
			$ligne->nom != "JALLON"&&
			$ligne->nom != "JOLIVET"&&
			$ligne->nom != "NAZAIRE"&&
			$ligne->nom != "NEXON"&&
			$ligne->nom != "SAMSO"&&
			$ligne->nom != "STANISLAS")
			{
				echo "<td>cv not found =(</td>";
			
			}
			else
			{
				$rep = explode ('.', $ligne->CV);
				echo "<td> <a href = './CV/".$rep[0]."/".$ligne->CV." '/>CV </td></a>";
			}
			
			echo "<td><img src='./Photos/".$ligne->photo."'</td></tr>";
			$ligne = $resultats->fetch(PDO::FETCH_OBJ) ;
			
		}
	}
	else{
		echo "problème à la connexion <br />";
	}
$resultats->closeCursor(); 
?>
</table>
