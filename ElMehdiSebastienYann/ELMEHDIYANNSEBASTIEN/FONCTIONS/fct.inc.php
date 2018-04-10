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
	function listeEleves($connexion)
	{
		// voir résultat
		$requete="select * from eleve order by nom;";
		$resultats=$connexion->query($requete);
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		return $liste;
	}
	function recupUnEleve($liste, $i)
	{
	//choix de l'occurrence dans le tableau
			$ligne = $liste[$i];
	// alimentation du tableau $_POST
			$_POST["idEleve"]=$ligne->idEleve;
			$_POST["nom"]=$ligne->nom;
			$_POST["prenom"]=$ligne->prenom;
			$_POST["idFiliere"]=$ligne->idFiliere;
			$_POST["idClasse"]=$ligne->idClasse;
			$_POST["idOption"]=$ligne->idOption;
			$_POST["anneeDiplome"]=$ligne->anneeDiplome;
			$_POST["adresseEmail"]=$ligne->adresseEmail;
			$_POST["photo"]=$ligne->photo;
			$_POST["CV"]=$ligne->CV;
			// retour du tableau
			return $_POST;
	}

	// Fonction pour supprimer un élève d'une base de données
	function supprimerEleve($idEleve, $connexion){
		//var_dump ($idEleve);
		echo 'Eleve supprimer sur le SQL';
		#SQL
		$requete_prepare_delete = $connexion->prepare ("
		DELETE from eleve where idEleve = :idEleve");
		$requete_prepare_delete -> execute(array('idEleve' => $idEleve));
	}
	
	//Fonction pour insérer un élève dans la base de données
	function insererEleve($nom, $prenom,$idFiliere,$idClasse, $idOption, $anneeDiplome, $adresseEmail, $photo, $CV, $connexion)
	{
		/*if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['filiere']) && isset($_POST['classe']) && isset($_POST['option']) && isset($_POST['anneeDiplome']) && isset($_POST['adresseEmail']) && isset($_POST['photo']) && isset($_POST['cv'])){*/
			#var_dump ($nom,$prenom,$idClasse,$idOption,$anneeDiplome,$adresseEmail,$photo,$CV);
			
			$request_prepare_insert = $connexion -> prepare ("INSERT INTO eleve (nom,prenom,idFiliere,idClasse,idOption,anneeDiplome,adresseEmail,photo,CV)
			VALUES (:nom,:prenom,:idFiliere,:idClasse,:idOption,:anneeDiplome,:adresseEmail,:photo,:CV)");
														
			$request_prepare_insert -> execute(
									array(':nom'=> $nom,
									':prenom'=>$prenom,
									':idFiliere'=>$idFiliere,
									':idClasse'=>$idClasse,
									':idOption'=>$idOption,
									':anneeDiplome'=>$anneeDiplome,
									'adresseEmail'=>$adresseEmail,
									':photo'=>$photo,
									':CV'=>$CV)
									);
	
	}

	// Fonction pour modifier un élève d'une base de données
	 function modifierEleve($idEleve ,$nom, $prenom, $idFiliere, $idClasse, $idOption, $anneeDiplome, $adresseEmail, $photo, $CV, $connexion){
		echo 'Eleve modifier sur le SQL';
		$requete_prepare_update = $connexion->prepare ("
		update eleve set nom = :nom,
						prenom = :prenom,
						idFiliere = :idFiliere,
						idClasse = :idClasse,
						idOption = :idOption,
						anneeDiplome = :anneeDiplome,
						adresseEmail = :adresseEmail,
						photo = :photo,
						CV = :CV
						where idEleve = :idEleve
						");
		$requete_prepare_update -> execute(array('nom' => $nom,
		'prenom' => $prenom,
		'idFiliere' => $idFiliere,
		'idClasse' => $idClasse,
		'idOption' => $idOption,
		'anneeDiplome' => $anneeDiplome,
		'adresseEmail' => $adresseEmail,
		'photo' => $photo,
		'CV' => $CV,
		'idEleve' => $idEleve));
		
	}
	function nbrEleve($liste)
	{
		$_SESSION['nbrEleveMax']=0;
		foreach ($liste as $ligne)
		{
			$_SESSION['nbrEleveMax'] = $_SESSION['nbrEleveMax'] + 1;
		}
		
	}
 ?>



		

		

		
		
		
		
		
	
	

	