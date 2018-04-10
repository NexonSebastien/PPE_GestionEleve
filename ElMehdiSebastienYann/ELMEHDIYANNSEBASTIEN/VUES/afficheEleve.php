<Form method="post" action="./index.php?page=afficheEleve">
<table>
<link type="text/css" rel="stylesheet" href="css/style3.css" />
<tr><td>Rechercher par nom:</td><td> <select name = "Recherche">
<?php
if($connexion){
		$requete = "select * from eleve order by nom";
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
			$_SESSION['IdEleveIndividuel']=$j;
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
</table>



 <br/><br/><br/>
		<input type="submit" name="Valider" value="Afficher"/>
</Form>
 <br/>

<?php

//print_r($_POST);
if($connexion){
	
	
if (isset($_POST['Valider'])){
	$choix = $_POST['Valider'];

	$liste = listeEleves($connexion);
switch ($choix){
	
	case 'Afficher':
		
		$requete = "select * from eleve e,filiere f,classe c,optionfiliere o where e.idFiliere=f.idFiliere and e.idClasse=c.idClasse and e.idOption=o.idOption order by nom;";
		$resultat = $connexion->query($requete);
		$liste=$resultat->FetchAll((PDO::FETCH_OBJ));
		$cptAct=(int) 0;
		$s =(int) $_SESSION['IdEleveIndividuel'];
		foreach($liste as $ligne){
			
			if($cptAct == $s)
			{
				echo "<table><caption><strong>Elèves de BTS SIO</strong></caption>";
				echo "<thead> <!-- En-tête du tableau -->";
				echo "<tr><th>Photo</th><td><img src='./Photos/".$ligne->photo."'</td></tr></thead>";
				echo "<tr><th>Numéro élève</th>  <td>".$ligne->idEleve."</td></tr>";
				echo "<tr><th>Nom élève</th>  <td>".$ligne->nom."</td></tr>";
				echo "<tr><th>Prenom élève</th> <td>".$ligne->prenom."</td></tr>";
				echo "<tr><th>Filière</th> <td>".$ligne->nomFiliere."</td></tr>";
				echo "<tr><th>Classe</th>  <td>".$ligne->nomClasse."</td></tr>";
				echo "<tr><th>Option</th>  <td>".$ligne->nomOption."</td></tr>";
				echo "<tr><th>Année Diplôme</th>  <td>".$ligne->anneeDiplome."</td></tr>"; 
				echo "<tr><th>Adresse électronique</th>  <td>".$ligne->adresseEmail."</td></tr>";  
				$rep = explode ('.', $ligne->CV);
				echo "<tr><th>cv</th> ";
			
			
				
				$rep = explode ('.', $ligne->CV);
				echo "<td> <a href = './CV/".$rep[0]."/".$ligne->CV."'/>CV </td>";
				
			}
			$cptAct = $cptAct +1;
		}
			
		
		
		
	break;
	}
}
}
?>