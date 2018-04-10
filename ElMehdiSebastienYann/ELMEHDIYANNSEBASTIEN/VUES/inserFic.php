bonjour BTS SIO1 option SISR et SLAM" 
<h1>
<?php
	$monfichier = fopen('BDD\listeSio12017.csv','r');
	$ligne = fgets($monfichier);
	$info = explode(';',$ligne);
 ?>
<table>
   <caption>Liste des élèves de BTS SIO1</caption>
   <thead> <!-- En-tête du tableau -->
       <tr>
<?php
	    forEach ($info as $texte){
?>
			<th>
<?php
			echo $texte;
?>
			</th>
<?php
		}
?>   <tfoot> <!-- Pied de tableau -->
       <tr>
<?php
			for ($i=0;$i<sizeOf($info);$i++){
?>
			<th><?php echo $info[$i]; ?></th>
<?php
			}
?>
       </tr>
   </tfoot>   <tbody> <!-- Corps du tableau -->
<?php
		$ligne = fgets($monfichier);
		$info = explode(';',$ligne);
		//faire une boucle de traitement
		while($ligne){
			// appel fonction pour insérer la ligne dans la table eleve 
				 insererEleve($info[0],$info[1],$info[2],$info[3],$info[4],$info[5],$info[6],$info[7],$info[8],$connexion);
			// faire l'insertion de la ligne dans la base de données
			
?>
	<tr>
<?php
			$i =0;
			
				
				
			while ($i < sizeOf($info)){
?>
		<td><?php  echo $info[$i]; ?>
		</td>
<?php
				$i++;
			}
?>
	</tr>
<?php
			$ligne = fgets($monfichier);
			$info = explode(';',$ligne);
		}
		fclose($monfichier);
	?>
	<tbody>
</table>
