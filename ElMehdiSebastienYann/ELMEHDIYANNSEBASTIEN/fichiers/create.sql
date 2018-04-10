drop database if exists snEleve;
create database snEleve;
use snEleve;

Create table Eleve(
nom char (50) not null,
prenom char (50) not null,
adresseMail varchar(100),
primary key (nom)
);
insert into Eleve VALUES ('EDMON','CEDRIC','edmon.cedricmarvin@gmail.com');
insert into Eleve VALUES ('ADRIAENSSENS','QUENTIN','quentin.adriaenssens@sfr.fr');
insert into Eleve VALUES ('BONIX','DAN','bonix.dan@gmail.com');
insert into Eleve VALUES ('NEXON','SEBASTIEN','nexon.sebastien@gmail.com');
insert into Eleve VALUES ('BEN ATIA','YASMINE','');




