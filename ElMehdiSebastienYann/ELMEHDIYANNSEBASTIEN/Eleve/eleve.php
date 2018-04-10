<h1>ELEVE</h1>
<!-- on écrit le titre dans un chapître -->
<form method="post" action="index.php?page=traitementEleve"/>
	<p>Nom : </p>
		<INPUT type="text" name="nom"/>
	<p>Prenom : </p>
		<INPUT type="text" name="prenom"/>
	<p>Adresse Mail : </p>
		<INPUT type="text" name="adresseMail"/>
	</br>
	<INPUT type="Submit" name="OK" value="OK"/>	
	</form>
<form method="post" action="index.php?page=maj"/>
	<INPUT type="Submit" name="maj" value="Mise à Jour"/>	
</form>
<?php
$PARAM_hote='localhost';
$PARAM_port='3306';
$PARAM_nom_bd='snEleve';
$PARAM_utilisateur='root';
$PARAM_mot_passe="";

try{
	$connexion=new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
	$PARAM_utilisateur,$PARAM_mot_passe);
	}
	catch(exception$e){
		echo 'erreur:'.$e->getMessage().'<br/>';
		echo 'n°:'.$e->getcode();
	}
	#SQL REQUETE SELECT
	$requete="select *
	from Eleve
	order by nom";
	$resultats=$connexion->query($requete);
	$resultats->setFetchMode(PDO::FETCH_OBJ);
	$ligneSQL=$resultats->fetch();

	#$monfichier = fopen('BDD\\ELEVE.csv','r+');
	#	$ligne = fgets($monfichier);
	#	while($ligne)
	#	{
	#		$ligne = fgets($monfichier);
	#		echo $ligne.'<br/>';
	#	}
	#fputs($monfichier,'TEST;TEST;TEST(\br)');
	#fclose($monfichier);


#DEBUT TABLEAU?>
<table>
   <th>Nom</th>
   <th>Prenom</th>
   <th>AdresseMail</th>

<?php
	#$monfichier = fopen('BDD\\ELEVE.csv','r+');
#$ligne=fgets($monfichier);
#	while ($ligne){
	while ($ligneSQL){
		 $nomSQL=$ligneSQL->nom;
		 $prenomSQL=$ligneSQL->prenom;
		 $adresseMailSQL=$ligneSQL->adresseMail;
		 
#		$info = explode(';',$ligne);
#		?>
			<tr>
		<td><?php echo $nomSQL;?></td>
		<td><?php echo $prenomSQL;?></td>
		<td><?php echo $adresseMailSQL?></td>
			</tr>
<?php
	$ligneSQL=$resultats->fetch();
		}
#	$ligne=fgets($monfichier);
#	}
#fclose($monfichier);
#?>
</table>
<?php
#FIN TABLEAU

#AFFICHAGE SQL

	
	
	
	
	
	
	
	
	

	
?>





