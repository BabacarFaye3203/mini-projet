<?php
include 'connexion_db.php';
include 'connexion_db.php';
try{
    $rq1="DROP TABLE IF EXISTS Patient ;
     CREATE TABLE Patient (idP_Patient INT AUTO_INCREMENT NOT NULL,
    nomP_Patient VARCHAR(50),
    prenomP VARCHAR(50),
    adresseP VARCHAR(100),
    emailP VARCHAR(100),
    paysP VARCHAR(20),
    villeP VARCHAR(20),
    groupe_sanguin_Patient ENUM,
    situation_matri_Patient ENUM,
    profession_Patient VARCHAR(50),
    statut_Patient VARCHAR(15),
    ageP INT(3),
    sexeP ENUM,
    poids_Patient DOUBLE,
    taille_Patient DOUBLE,
    contactP VARCHAR(20),
    CIN_Patient VARCHAR,
    PRIMARY KEY (idP_Patient)) ENGINE=InnoDB;";
    $res=mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    $rq1="DROP TABLE IF EXISTS Rendez-Vous ;
     CREATE TABLE Rendez-Vous (idR_Rendez-Vous INT AUTO_INCREMENT NOT NULL,
     dateR_Rendez-Vous DATETIME,
    type_Rendez-Vous ENUM,
    idP_Patient **NOT FOUND**,
    idM_Medecin **NOT FOUND**,
    PRIMARY KEY (idR_Rendez-Vous)) ENGINE=InnoDB; ";
    mysqli_query($connect,$rq1);
   // echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    $rq1="DROP TABLE IF EXISTS Medecin ;
    CREATE TABLE Medecin (idM_Medecin INT AUTO_INCREMENT NOT NULL,
    nomM_Medecin VARCHAR(50),
    prenomM_Medecin VARCHAR(50),
    emailM_Medecin VARCHAR(100),
    adresseM_Medecin VARCHAR(100),
    paysM_Medecin VARCHAR(20),
    matriculeM_Medecin VARCHAR(15),
    villeM_Medecin VARCHAR(20),
    specialite_Medecin VARCHAR,
    contactM_Medecin VARCHAR(20),
    sexe_Medecin ENUM,
    PRIMARY KEY (idM_Medecin)) ENGINE=InnoDB;";
    mysqli_query($connect,$rq1);
   // echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    $rq1="DROP TABLE IF EXISTS avoir ;
    CREATE TABLE avoir (idP_Patient **NOT FOUND** AUTO_INCREMENT NOT NULL,
    idM_Medecin **NOT FOUND** NOT NULL,
    PRIMARY KEY (idP_Patient,  idM_Medecin)) ENGINE=InnoDB;";
    mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
