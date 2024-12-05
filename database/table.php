<?php
//include 'connexion_db.php';
include 'DatabaseCreat.php';
try{
    $rq1="
     CREATE TABLE IF NOT EXISTS Patient (idP_Patient INT AUTO_INCREMENT NOT NULL,
    nomP_Patient VARCHAR(50),
    prenomP VARCHAR(50),
    adresseP VARCHAR(100),
    emailP VARCHAR(100),
    paysP VARCHAR(20),
    villeP VARCHAR(20),
    groupe_sanguin_Patient varchar(2),
    situation_matri_Patient varchar(15),
    profession_Patient varchar(70),
    statut_Patient VARCHAR(15),
    ageP INT(3),
    check ( ageP<=120 ),
    sexeP varchar(15),
    poids_Patient DOUBLE,
    taille_Patient DOUBLE,
    contactP VARCHAR(20),
    CIN_Patient VARCHAR(15),
    password VARCHAR(20),
    PRIMARY KEY (idP_Patient)) ENGINE=InnoDB;";
    $connect->query($rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    //echo"erreur lors de la création de la base".$e->getMessage();
    exit();
}
try{
    $rq1="
     CREATE TABLE IF NOT EXISTS RendezVous (idR_RendezVous INT AUTO_INCREMENT NOT NULL,
     dateR_RendezVous DATETIME,
    type_RendezVous varchar(20),
    idP_Patient INT,
    idM_Medecin INT,
    lieu text,
    PRIMARY KEY (idR_RendezVous),
   FOREIGN KEY (idP_Patient) REFERENCES patient(idP_Patient),
    FOREIGN KEY (idM_Medecin) REFERENCES medecin(idM_Medecin))
 ENGINE=InnoDB; ";
    $connect->query($rq1);
   // echo"créer avec succes";
}catch(Exception $e){
    //echo"<br>erreur lors de la création de la base ".$e->getMessage();
    exit();
}
try{
    $rq1="
    CREATE TABLE IF NOT EXISTS Medecin (idM_Medecin INT AUTO_INCREMENT NOT NULL,
    nomM_Medecin VARCHAR(50),
    prenomM_Medecin VARCHAR(50),
    matriculeM_Medecin VARCHAR(15),
    emailM_Medecin VARCHAR(100),
    adresseM_Medecin VARCHAR(100),
    paysM_Medecin VARCHAR(20),
    villeM_Medecin VARCHAR(20),
    specialite_Medecin VARCHAR(100),
    contactM_Medecin VARCHAR(20),
    age int not null,
    sexe_Medecin VARCHAR(15),
    password varchar(255),
    check ( age<=120 ),
    PRIMARY KEY (idM_Medecin)) ENGINE=InnoDB;";
    $connect->query($rq1);
   // echo"créer avec succes";
}catch(Exception $e){
    //echo"erreur lors de la création de la base".$e->getMessage();
    exit();
}

try{
    $rq1="
    CREATE TABLE IF NOT EXISTS avoir (idP_Patient INT AUTO_INCREMENT NOT NULL,
    idM_Medecin INt NOT NULL,
    PRIMARY KEY (idP_Patient,  idM_Medecin)) ENGINE=InnoDB;";
    $connect->query($rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    //echo"erreur lors de la création de la base".$e->getMessage();
    exit();
}
try{
    $rq1="
    CREATE TABLE IF NOT EXISTS documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idP_Patient INT,
    doc_name VARCHAR(255),
    doc_path VARCHAR(255),
    FOREIGN KEY (idP_Patient) REFERENCES patient(idP_Patient)
)";
    $connect->query($rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    //echo"erreur lors de la création de la base".$e->getMessage();
    exit();
}
try {
    $req1="create table if not exists rdva
    (
        IDA  int auto_increment
        primary key,
    idR  int         null,
    type varchar(20) null,
    dat  datetime    null,
    idP  int         null,
    idM  int         null,
    lieu text,
    constraint rdva_pk
        unique (idR)
);";
    $connect->query($rq1);
}catch (Exception $e){
    exit();
}
try {
    $req1="create table if not exists rdvn
(
    IDN  int auto_increment
        primary key,
    idR  int         null,
    type varchar(20) null,
    dat  datetime    null,
    idP  int         null,
    idM  int         null,
    lieu text,
    constraint idR
        unique (idR),
    constraint rdvn_pk
        unique (idR),
    constraint rdvn_pk2
        unique (idR)
);
";
    $connect->query($rq1);
}catch (Exception $e){
    exit();
}
try {
    $req1="create table if not exists rdv_commun
(
    id  int auto_increment
        primary key,
    idP int not null,
    idM int not null
);
";
    $connect->query($rq1);
}catch (Exception $e){
    exit();
}

