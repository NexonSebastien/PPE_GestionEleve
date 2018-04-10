<br/>

<?php
if($connexion){
if (isset($_POST['insert'])){
$valider = $_POST['insert'];
switch ($valider){
	case 'Ajouter':
		if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['filiere']) && isset($_POST['classe']) && isset($_POST['option']) && isset($_POST['anneeDiplome']) && isset($_POST['adresseEmail']) && isset($_POST['photo']) && isset($_POST['cv'])){
			print_r($_POST);
			$nomEleve=$_POST['nom'];
			$prenomEleve=$_POST['prenom'];
			$idFiliere=$_POST['filiere'];
			$idClasse=$_POST['classe'];
			$idOption=$_POST['option'];
			$anneeDiplome=$_POST['anneeDiplome'];
			$mailEleve=$_POST['adresseEmail'];
			$photo=$_POST['photo'];
			$cvEleve=$_POST['cv'];
			
			$requete=$connexion->prepare("INSERT INTO snBTSSIO  (nom, prenom, idFiliere,idClasse, idOption,anneeDiplome, adresseEmail,photo,cv) VALUES (:nom,:prenom,:idFiliere,:idClasse,:idOption,:anneeDiplome,:adresseEmail,:photo,:cv)");
			$requete->execute(array( ':nom'=> $nomEleve,':prenom'=>$prenomEleve,':idFiliere'=>$idFiliere,':idClasse'=>$idClasse,':idOption'=>$idOption,':anneeDiplome'=>$anneeDiplome,'adresseEmail'=>$mailEleve,':photo'=>$photo,':cv'=> $cvEleve));
		}
	break;
}
}
}A
?>


