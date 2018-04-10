Drop database if exists gp2BTSSIO;

CREATE DATABASE gp2BTSSIO;

use gp2BTSSIO;


Create table `Classe` (
	`idClasse` int(11) NOT NULL,
	`nomClasse` varchar(30) NOT NULL default '',
	`idFiliere` int(11) NOT NULL,
	Primary Key (`idClasse`)
);

Create table `Prof` (
	`idProf` int(11) NOT NULL auto_increment,
	`nomProf` varchar(30) NOT NULL default '',
	`prenomProf` varchar(30) NOT NULL default '',
	`adresseEmail` varchar(50) NOT NULL default '',
	Primary Key (`idProf`)
);

Create table `Filiere` (
	`idFiliere` int(11) NOT NULL,
	`nomFiliere` varchar(30) NOT NULL default '',
	Primary Key (`idFiliere`)
);

Create table `optionFiliere` (
	`idOption` int(11) NOT NULL,
	`nomOption` varchar(30) NOT NULL default '',
	Primary Key (`idOption`)
);


Create table `Eleve` (
	`idEleve` int(11) NOT NULL auto_increment,
	`nom` varchar(30) NOT NULL default '',
	`prenom` varchar(30) NOT NULL default '',
	`idFiliere` int(11) NOT NULL default '0',
	`idClasse` int(11) NOT NULL default '0',
	`idOption` int(11) NOT NULL default '0',
	`anneeDiplome` int(4) NOT NULL default '0000',
	`adresseEmail` varchar(50) NOT NULL default '',
	`photo` varchar (100),
	`CV` varchar(100),
	
	
	Primary Key (`idEleve`)
);


/* -- Clés étrangères */
Alter table `Eleve`
	add constraint FK_Eleve_idFiliere
	foreign key (`idFiliere`)
	references `Filiere`(`idFiliere`);
Alter table `Eleve`	
	add constraint FK_Eleve_idClasse
	foreign key (`idClasse`)
	references `Classe`(`idClasse`);
Alter table `Eleve`	
	add constraint FK_Eleve_idOption
	foreign key (`idOption`)
	references `optionFiliere`(`idOption`);	
	
	Alter table `Classe`
	add constraint FK_Classe_idFiliere_Filiere
	foreign key (`idFiliere`)
	references `Filiere`(`idFiliere`);

	
/* --Insert de la table filiere */
Insert into `Filiere` values (0,'null');
Insert into `Filiere` values (1,'CGO');
Insert into `Filiere` values (2,'SIO');
	
/* --Insert de la table classe */
Insert into `Classe` values (0,'null', 0);
Insert into `Classe` values (1,'SIO1', 2);
Insert into `Classe` values (2,'SIO2', 2);

/* --Insert de la table prof */
Insert into `Prof` values (1,'Benito','Jean-Michel','');
Insert into `Prof` values (2,'Brel','reine-Marie','brelrm@sfr.fr');
Insert into `Prof` values (3,'Debbache','Olivier','olivier.debbache@free.fr');
Insert into `Prof` values (4,'Malherbe','Eric','eric.malherbe@ymail.com');

/* --Insert de la table Option */
Insert into `optionFiliere` values (0,'null');
Insert into `optionFiliere` values (1,'SISR');
Insert into `optionFiliere` values (2,'SLAM');	

