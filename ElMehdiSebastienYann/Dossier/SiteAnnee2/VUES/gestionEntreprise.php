<br/>
<?php
if($connexion){

if(isset($_POST['valider']) ){
$choix=$_POST['valider'];

switch ($choix) {
	case "afficher":
	
		$requete=$connexion->prepare("select * from entreprise where idEntreprise = :id;"); 
		$requete->execute(array(':id'=> $_POST["choixEntreprise"] ));
			if ($requete != null){
				$tab=$requete->fetch(PDO::FETCH_OBJ);
				if ($tab!=null){
					$_POST['id']=$tab->idEntreprise; 
					$_POST["raisonSociale"]=$tab->raisonSocial;
					$_POST['adresseEntreprise']=$tab->ad1;
					$_POST['adresseEntreprise2']=$tab->ad2;
					$_POST['adresseEntreprise3']=$tab->ad3;
					$_POST["codePostal"]=$tab->codePostal; 
					$_POST["villeEntreprise"]=$tab->ville;
					$_POST["numTelEntreprise"]=$tab->numTelPro;		
				}
			}
			$requete->closeCursor();
			break;
	case "ok":
			if (isset($_POST['raisonSociale']) && isset($_POST['adresseEntreprise']) && isset($_POST['adresseEntreprise2']) && isset($_POST['adresseEntreprise3']) && isset($_POST['codePostal']) && isset($_POST['villeEntreprise']) && isset($_POST['numTelEntreprise']) && isset($_POST['adresseEmailEntreprise']) && isset($_POST['id']) && isset($_POST['villeEntreprise'])){
				$raisonSociale = $_POST['raisonSociale'];
				$add1=$_POST['adresseEntreprise'];
				$add2=$_POST['adresseEntreprise2'];
				$add3=$_POST['adresseEntreprise3'];
				$codePostal=$_POST['codePostal'];
				$tel=$_POST['numTelEntreprise'];
				$mail=$_POST['adresseEmailEntreprise'];
				$ville=$_POST['villeEntreprise'];
				$id=$_POST['id'];
				$requete=$connexion->prepare("INSERT INTO entreprise  (idEntreprise, RaisonSocial, ad1, ad2, ad3, codePostal,ville, numtelPro,retourNpai) VALUES (:id,:raisonSociale,:add1,:add2,:add3,:codePostal,:ville,:tel,:rNpai)");
				$requete->execute(array( ':id' => $id ,':raisonSociale'=> $raisonSociale,':add1'=>$add1,':add2'=>$add2,':add3'=>$add3,':codePostal'=>$codePostal,':ville'=>$ville,':tel'=>$tel,':rNpai'=>Null));
			}
			$requete->closeCursor();
			break;
	}
}

}
/*$requete=$connexion->prepare("INSERT INTO entreprise  (idEntreprise, RaisonSocial, ad1, ad2, ad3, codePostal,ville, numtelPro,retourNpai) VALUES ('$id','$raisonSociale','$add1','$add2','$add3','$codePostal','$ville','$tel','$rNpai')");
$resultats=$connexion->query($requete) ;*/

?>
<Form method="post" action="./index.php?page=formulaire">
<table>
<tr>
	<td>recherche par raison sociale</td>
	<td>
	<select name="choixEntreprise">
<?php
		$requete="select * from entreprise order by idEntreprise;";
		$resultats=$connexion->query($requete);
		$liste=$resultats->FetchAll((PDO::FETCH_OBJ));
		foreach($liste as $ligne){
?>
			<option value="
<?php
			
			echo $ligne->idEntreprise;
			
?>
"
<?php
if(isset($_POST["choixEntreprise"]) && $ligne->idEntreprise==$_POST["choixEntreprise"] ){
				echo 'selected="selected"';
				}
?>
>
<?php
			echo $ligne->raisonSocial;
?>
			</option>
<?php

			$resultats->closeCursor();
		}
?>
<tr><td>	Raison Sociale: </td>
<td><input type="text" name="raisonSociale" value="
<?php
 if (!empty($_POST['raisonSociale'])){
  echo htmlspecialchars($_POST['raisonSociale'],ENT_QUOTES);
 }
?>
"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	id : </td>
<td><input type="text" name="id" value="
<?php
 if (!empty($_POST['id'])){
  echo htmlspecialchars($_POST['id'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Adresse : </td>
<td><input type="text" name="adresseEntreprise" value="
<?php
 if (!empty($_POST['adresseEntreprise'])){
  echo htmlspecialchars($_POST['adresseEntreprise'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Adresse 2 : </td>
<td><input type="text" name="adresseEntreprise2" value="
<?php
 if (!empty($_POST['adresseEntreprise2'])){
  echo htmlspecialchars($_POST['adresseEntreprise2'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Adresse 3 : </td>
<td><input type="text" name="adresseEntreprise3" value="
<?php
 if (!empty($_POST['adresseEntreprise3'])){
  echo htmlspecialchars($_POST['adresseEntreprise3'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>	Code Postal : </td>
<td><input type="text" name="codePostal" value="
<?php
 if (!empty($_POST['codePostal'])){
  echo htmlspecialchars($_POST['codePostal'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>
	Ville:  </td><td><input type="text" name="villeEntreprise" value="
<?php
 if (!empty($_POST['villeEntreprise'])){
  echo htmlspecialchars($_POST['villeEntreprise'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
<tr><td>
	Numéro Téléphone: </td><td><input type="text" name="numTelEntreprise" value="
<?php
 if (!empty($_POST['numTelEntreprise'])){
  echo htmlspecialchars($_POST['numTelEntreprise'],ENT_QUOTES);
 }
 ?>"/></td></tr><tr><td></td><td></td>
</tr>
<tr>
<td>
	Adresse Électronique: </td><td><input type="text" name="adresseEmailEntreprise" value="
<?php
 if (!empty($_POST['adresseEmailEntreprise'])){
  echo htmlspecialchars($_POST['adresseEmailEntreprise'],ENT_QUOTES);
 }
?>"/></td></tr>
<tr><td></td><td></td></tr>
</table>
 <br/><br/><br/>
		<input type="reset" name="valider" value="Annuler"/>
		<input type="submit" name="valider" value="afficher"/>
		<input type="submit" name="valider" value="OK"/>
		<input type="submit" name="valider" value="supprimer"/>
</Form>
<br/><br/><br/><br/><br/><br/><br/><br/><br/>