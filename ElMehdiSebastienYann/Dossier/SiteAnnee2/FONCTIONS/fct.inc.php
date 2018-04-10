<?php
	function connexionMysqlBdd($hote, $port, $bd, $util, $mpas){
		$PARAM_hote=$hote; // le chemin vers le serveur
		$PARAM_port=$port;
		$PARAM_nom_bd=$bd; // le nom de votre base de données
		$PARAM_utilisateur=$util; // nom d'utilisateur pour se connecter
		$PARAM_mot_passe=$mpas; // mot de passe de l'utilisateur pour se connecter
		try{ 
			$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
		}  
		catch(Exception $e){
			echo 'Erreur : '.$e->getMessage(); 
?>
<br />
<?php			
			echo 'N° : '.$e->getCode();
		}
		return $connexion;
	}

	
	function affAllEleves($liste){
		// voir résultat
		echo "<table><caption><strong>liste des élèves de BTS SIO</strong></caption>";
		echo "<thead> <!-- En-tête du tableau -->";
		echo "<tr><th>Numéro élève</th><th>Nom élève</th><th>Prenom élève</th><th>Filière</th><th>Classe</th><th>Option</th><th>Année Diplôme</th><th>Adresse électronique</th></tr>";
		echo "</thead>";
		echo "<tfoot> <!-- Pied de tableau -->";
		echo "<tr></tr>";
		echo "</tfoot>";
		echo "<tbody> <!-- Corps du tableau -->";
?>
	

		
<?php
		foreach ($liste as $ligne){;
		
?>
			<tr><td>
<?php			
			echo $ligne->idEleve;
?>
			</td>
			<td>
<?php			
			echo $ligne->nom;
?>		
			</td>
			<td>
<?php
			echo $ligne->prenom;
?>
			</td>
			<td>
<?php
			echo $ligne->idFiliere;
?>
			</td>
			<td>
<?php
			echo $ligne->idClasse; 
?>
			</td>
			<td>
<?php
			echo $ligne->idOption; 
?>
			</td>
			<td>
<?php
			echo $ligne->anneeDiplome; 
?>
			</td>
			<td>
<?php
			echo $ligne->adresseEmail; 
?>
			</td>
						<td>
<?php
			echo $ligne->adressePhoto; 
?>
			</td>
			</tr>
			
<?php
		}
?>
</table>
<?php		
		
	}
	function listeEleves($connexion){
		// voir résultat
		$requete="select * from eleve order by nom;";
		$resultats=$connexion->query($requete) ;
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
		}
	function recupUnEleve($liste, $i){
	//choix de l'occurrence dans le tableau
			$ligne = $liste[$i];
	// alimentation du tableau $_POST
			$_POST["idEleve"]=$ligne->idEleve;
			$_POST["nom"]=$ligne->nom;
			$_POST["prenom"]=$ligne->prenom;
			$_POST["idFiliere"]=$ligne->idFiliere;
			$_POST["idClasse"]=$ligne->idClasse; 
			$_POST["adresseEmail"]=$ligne->adresseEmail;
			$_POST["adressePhoto"]=$ligne->adressePhoto;
			// retour du tableau
			return $_POST;
		}
		
		

		

		
		
		
		
		
	
	

	