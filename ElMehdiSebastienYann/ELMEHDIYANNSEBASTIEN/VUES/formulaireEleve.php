<br/>

<?php

//print_r($_POST);
if($connexion){
	
	
if (isset($_POST['Valider'])){
	$choix = $_POST['Valider'];
	$liste = listeEleves($connexion);
	nbrEleve($liste);
switch ($choix){
	
	case 'Inserer':
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['idFiliere']) && isset($_POST['idClasse']) && isset($_POST['idOption']) && isset($_POST['anneeDiplome']) && isset($_POST['adresseEmail']) && isset($_POST['photo']) && isset($_POST['CV']))
		{	
			$nom = $_POST['nom'];
			$prenom=$_POST['prenom'];
			$idFiliere=(int)$_POST['idFiliere'];
			$idClasse=(int)$_POST['idClasse'];
			$idOption=(int)$_POST['idOption'];
			$anneeDiplome=$_POST['anneeDiplome'];
			$adresseEmail=$_POST['adresseEmail'];
			$photo=$_POST['photo'];
			$CV=$_POST['CV'];
			insererEleve($nom, $prenom,$idFiliere,$idClasse, $idOption, $anneeDiplome, $adresseEmail, $photo, $CV, $connexion);
		} 
	break;
	
	case 'Afficher':
		
		//var_dump($_SESSION["idEleve"]);
		//var_dump($_SESSION['rechercheIdEleve']);
		/*$i = $_POST["Recherche"];
		
		$_POST = recupUnEleve($liste,$j);		*/
		//$_SESSION['idEleve'] = $_SESSION['rechercheIdEleve'];			
		
	break;
	
	case 'Supprimer':
		$idEleve=$_POST["Recherche"];
		supprimerEleve($idEleve, $connexion);
	break;
	
	case 'Modifier':
			$idEleve = $_POST['idEleve'];
			$nom = $_POST['nom'];
			$prenom=$_POST['prenom'];
			$idFiliere=(int)$_POST['idFiliere'];
			$idClasse=(int)$_POST['idClasse'];
			$idOption=(int)$_POST['idOption'];
			$anneeDiplome=$_POST['anneeDiplome'];
			$adresseEmail=$_POST['adresseEmail'];
			$photo=$_POST['photo'];
			$CV=$_POST['CV'];
			var_dump($idFiliere);
			var_dump($idClasse);
			var_dump($idOption);
			modifierEleve($idEleve ,$nom, $prenom,$idFiliere,$idClasse,$idOption, $anneeDiplome, $adresseEmail, $photo, $CV, $connexion);
	break;
	
	case "<<":
		$_SESSION['idEleve'] = 0;
		$_POST=recupUnEleve($liste,$_SESSION['idEleve']);
		$_POST["Recherche"] = $_POST['idEleve'];
	break;
	
	case "<":
		if ($_SESSION['idEleve']>0)
		{
			$_SESSION['idEleve'] = $_SESSION['idEleve'] - 1;
		}
		else
		{
			$_SESSION['idEleve'] = $_SESSION['nbrEleveMax']-1;
		}
			$_POST=recupUnEleve($liste,$_SESSION['idEleve']);
			$_POST["Recherche"] = $_POST['idEleve'];
	break;
	
	case ">":
		if ($_SESSION['idEleve']<$_SESSION['nbrEleveMax']-1)
		{
			$_SESSION['idEleve'] = $_SESSION['idEleve'] + 1;
		}
		else
		{
			$_SESSION['idEleve'] = 0;
		}
			$_POST=recupUnEleve($liste,$_SESSION['idEleve']);
			$_POST["Recherche"] = $_POST['idEleve'];
	break;
	
	case ">>":
		$_SESSION['idEleve'] = $_SESSION['nbrEleveMax']-1;
		$_POST=recupUnEleve($liste,$_SESSION['idEleve']);
		$_POST["Recherche"] = $_POST['idEleve'];
		
	break;
	}
}
}
?>


<Form method="post" action="./index.php?page=formulaireEleve">
<table>
<tr><td>Rechercher par nom:</td><td> <select name = "Recherche">
<?php
if($connexion){
		$requete = "select * from eleve order by nom;";
		$resultat = $connexion->query($requete);
		$liste=$resultat->FetchAll((PDO::FETCH_OBJ));
		$j = 0;
		foreach($liste as $ligne){
?>
		<option value=
<?php
		 
		echo $ligne->idEleve;
		if(isset($_POST["Recherche"]) && $ligne->idEleve==$_POST["Recherche"])
		{
			echo " selected ='selected'";
			$_POST = recupUnEleve($liste, $j);
			$eleveActuelFiliere = $ligne ->idFiliere;
			$eleveActuelClasse = $ligne ->idClasse;
			$eleveActuelOption = $ligne ->idOption;
			$_SESSION["idEleve"] = $j;
			
			
		}
?>
>
<?php
		echo $ligne->nom;
		$j++;
		}
?>
		
<?php
		$resultat->closeCursor();
	}

?>

</select></td></tr>

<?php
//var_dump ($_SESSION['rechercheIdEleve']);
//var_dump ($Recherche);
?>
<tr><td>	Nom: </td>
<td><input type="text" name="nom" value="
<?php
 if (!empty($_POST['nom'])){
  echo htmlspecialchars($_POST['nom'],ENT_QUOTES);
 }
?>
"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Id Eleve : </td>
<td><input type="text" name="idEleve" value="
<?php
 if (!empty($_POST['idEleve'])){
  echo htmlspecialchars($_POST['idEleve'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Prenom : </td>
<td><input type="text" name="prenom" value="
<?php
 if (!empty($_POST['prenom'])){
  echo htmlspecialchars($_POST['prenom'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Id Filiere  : </td>
<td>
<select name = "idFiliere">
<?php

if($connexion){
	
		$requeteFiliere = "select * from Filiere order by idFiliere;";
		$resultatFiliere = $connexion->query($requeteFiliere);
		$listeFiliere=$resultatFiliere->FetchAll((PDO::FETCH_OBJ));
		foreach($listeFiliere as $ligneFiliere)
		{
			?>		
			<option value="
				<?php	
				echo $ligneFiliere->idFiliere.'"';
				if(isset($eleveActuelFiliere))
				{
					if($eleveActuelFiliere==$ligneFiliere->idFiliere)
					{
						
						echo " selected ='selected'";
						$idFiliere=$ligneFiliere->idFiliere;
					}
				}
				else
				{
					if($ligneFiliere->nomFiliere == "SIO")
					{
						
						echo " selected ='selected'";
						
					}
				}
				?>
			>
			<?php
			echo $ligneFiliere->nomFiliere;

		}
?>
<?php
		#if(isset($_POST["idFiliere"]) && $ligne->idFiliere==$_POST["idFiliere"])
		#{
		#	echo "'selected ='selected";
		#}
?>

<?php
		$resultat->closeCursor();
	}

?>

</select></td></tr>

<tr><td></td><td></td></tr>
<tr><td>	Id Classe : </td>
<td>
<select name = "idClasse">
<?php
if($connexion){
		$requete = "select * from classe order by idClasse;";
		$resultat = $connexion->query($requete);
		$listeClasse=$resultat->FetchAll((PDO::FETCH_OBJ));
		foreach($listeClasse as $ligneClasse){
?>
		<option value="
				<?php
				echo $ligneClasse->idClasse.'"';
				if(isset($eleveActuelClasse))
				{
					if($eleveActuelClasse==$ligneClasse->idClasse)
					{
						echo " selected ='selected'";
					}
				}
				else
				{
					if($ligneClasse->nomClasse == "SIO1")
					{
						
						echo " selected ='selected'";
						
					}
				}
			?>
			>
<?php
		echo $ligneClasse->nomClasse;
		
 }
?>
<?php
		
?>

<?php
		$resultat->closeCursor();
	}

?>

</select></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Id Option : </td>
<td><select name = "idOption">
<?php
if($connexion){
		$requete = "select * from optionfiliere order by idOption;";
		$resultat = $connexion->query($requete);
		$listeOption=$resultat->FetchAll((PDO::FETCH_OBJ));
		foreach($listeOption as $ligneOption){
?>
		<option value="
				<?php
				echo $ligneOption->idOption.'"';
				if(isset($eleveActuelOption))
				{
					if($eleveActuelOption==$ligneOption->idOption)
					{
						echo " selected ='selected'";
					}
				}
				else
				{
					if($ligneOption->nomOption == "SLAM")
					{
						
						echo " selected ='selected'";
						
					}
				}
			?>
			>




<?php
		echo $ligneOption->nomOption;

 }
?>
<?php
		#if(isset($_POST["idOption"]) && $ligne->idOption==$_POST["idOption"])
		#{
		#	echo "'selected ='selected";
		#}
?>

<?php
		$resultat->closeCursor();
	}

?>

</select></td></tr>
<tr><td></td><td></td></tr>
<tr><td>
	Annee Diplome:  </td><td><input type="text" name="anneeDiplome" value="
<?php
 if (!empty($_POST['anneeDiplome'])){
  echo htmlspecialchars($_POST['anneeDiplome'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>
	 Adresse Email: </td><td><input type="text" name="adresseEmail" value="
<?php
 if (!empty($_POST['adresseEmail'])){
  echo htmlspecialchars($_POST['adresseEmail'],ENT_QUOTES);
 }
 ?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>
	Photo: </td><td><input type="text" name="photo" value="
<?php
 if (!empty($_POST['photo'])){
  echo htmlspecialchars($_POST['photo'],ENT_QUOTES);
 }
 ?>"/></td></tr><tr><td></td><td></td>
</tr>
<tr>
<td>
	CV: </td><td><input type="text" name="CV" value="
<?php
 if (!empty($_POST['CV'])){
  echo htmlspecialchars($_POST['CV'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>

</table>
 <br/><br/><br/>
		<INPUT type="submit" name="Valider" value="<<"/>	
		<INPUT type="submit" name="Valider" value="<"/>	
		<input type="submit" name="Valider" value="Modifier"/>
		<input type="submit" name="Valider" value="Inserer"/>
		<input type="submit" name="Valider" value="Afficher"/>
		<input type="submit" name="Valider" value="Supprimer"/>
		<INPUT type="submit" name="Valider" value=">"/>	
		<INPUT type="submit" name="Valider" value=">>"/>
</Form>