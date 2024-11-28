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
    $res=mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    $rq1="
     CREATE TABLE IF NOT EXISTS RendezVous (idR_RendezVous INT AUTO_INCREMENT NOT NULL,
     dateR_RendezVous DATETIME,
    type_RendezVous varchar(20),
    idP_Patient INT,
    idM_Medecin INT,
    PRIMARY KEY (idR_RendezVous)) ENGINE=InnoDB; ";
    mysqli_query($connect,$rq1);
   // echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
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
    mysqli_query($connect,$rq1);
   // echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try{
    $rq1="
    CREATE TABLE IF NOT EXISTS avoir (idP_Patient INT AUTO_INCREMENT NOT NULL,
    idM_Medecin INt NOT NULL,
    PRIMARY KEY (idP_Patient,  idM_Medecin)) ENGINE=InnoDB;";
    mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
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
    mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}

try{
    $rq1="INSERT INTO Patient (nomP_Patient, prenomP, adresseP, emailP, paysP, villeP, groupe_sanguin_Patient, situation_matri_Patient, profession_Patient, statut_Patient, ageP, sexeP, poids_Patient, taille_Patient, contactP, CIN_Patient, password)
    VALUES
    ('Dupont', 'Marie', '123 Rue des Fleurs, Paris', 'marie.dupont@example.com', 'France', 'Paris', 'A+', 'Célibataire', 'Infirmière', 'Actif', 30, 'Femme', 60.5, 1.65, '0601234567', 'CIN1234567890', 'password123'),
    ('Martin', 'Pierre', '456 Avenue de la République, Lyon', 'pierre.martin@example.com', 'France', 'Lyon', 'O-', 'Marié', 'Médecin', 'Actif', 45, 'Homme', 80.0, 1.78, '0602345678', 'CIN2345678901', 'password123'),
    ('Lemoine', 'Claire', '789 Boulevard Victor Hugo, Marseille', 'claire.lemoine@example.com', 'France', 'Marseille', 'B+', 'Divorcée', 'Cadre', 'Actif', 28, 'Femme', 58.2, 1.60, '0603456789', 'CIN3456789012', 'password123'),
    ('Bernard', 'Jacques', '12 Rue de la Liberté, Bordeaux', 'jacques.bernard@example.com', 'France', 'Bordeaux', 'AB+', 'Veuf', 'Commerçant', 'Actif', 62, 'Homme', 70.5, 1.72, '0604567890', 'CIN4567890123', 'password123'),
    ('Durand', 'Sophie', '34 Rue des Écoles, Toulouse', 'sophie.durand@example.com', 'France', 'Toulouse', 'O+', 'Célibataire', 'Professeur', 'Actif', 35, 'Femme', 65.4, 1.70, '0605678901', 'CIN5678901234', 'password123'),
    ('Lefevre', 'Marc', '56 Rue de la Gare, Nice', 'marc.lefevre@example.com', 'France', 'Nice', 'A-', 'Marié', 'Ingénieur', 'Actif', 50, 'Homme', 75.3, 1.80, '0606789012', 'CIN6789012345', 'password123'),
    ('Michel', 'Isabelle', '78 Boulevard Jean Jaurès, Lille', 'isabelle.michel@example.com', 'France', 'Lille', 'AB-', 'Divorcée', 'Avocat', 'Actif', 40, 'Femme', 68.0, 1.65, '0607890123', 'CIN7890123456', 'password123'),
    ('Pires', 'Julien', '90 Avenue des Champs-Élysées, Paris', 'julien.pires@example.com', 'France', 'Paris', 'O-', 'Célibataire', 'Journaliste', 'Actif', 25, 'Homme', 85.0, 1.90, '0608901234', 'CIN8901234567', 'password123'),
    ('Petit', 'Caroline', '123 Rue de la République, Nantes', 'caroline.petit@example.com', 'France', 'Nantes', 'A+', 'Mariée', 'Médecin', 'Actif', 50, 'Femme', 62.0, 1.67, '0609012345', 'CIN9012345678', 'password123'),
    ('Girard', 'Henri', '234 Rue des Acacias, Lyon', 'henri.girard@example.com', 'France', 'Lyon', 'B+', 'Divorcé', 'Technicien', 'Actif', 55, 'Homme', 72.3, 1.75, '0610123456', 'CIN0123456789', 'password123'),
    ('Dubois', 'Nathalie', '345 Avenue de la Liberté, Bordeaux', 'nathalie.dubois@example.com', 'France', 'Bordeaux', 'O+', 'Mariée', 'Cadre', 'Actif', 38, 'Femme', 60.0, 1.62, '0611234567', 'CIN1234567890', 'password123'),
    ('Roussel', 'Thierry', '567 Boulevard des Fleurs, Toulouse', 'thierry.roussel@example.com', 'France', 'Toulouse', 'A-', 'Célibataire', 'Commerçant', 'Actif', 42, 'Homme', 85.4, 1.82, '0612345678', 'CIN2345678901', 'password123'),
    ('Moreau', 'Lucie', '789 Boulevard Victor Hugo, Marseille', 'lucie.moreau@example.com', 'France', 'Marseille', 'B+', 'Veuve', 'Infirmière', 'Actif', 29, 'Femme', 55.8, 1.68, '0613456789', 'CIN3456789012', 'password123'),
    ('Schmitt', 'Laurent', '234 Rue du Parc, Strasbourg', 'laurent.schmitt@example.com', 'France', 'Strasbourg', 'O-', 'Marié', 'Cadre', 'Actif', 60, 'Homme', 78.0, 1.80, '0614567890', 'CIN4567890123', 'password123'),
    ('Vidal', 'Élise', '345 Avenue de la Paix, Lille', 'elise.vidal@example.com', 'France', 'Lille', 'AB+', 'Divorcée', 'Avocat', 'Actif', 33, 'Femme', 65.2, 1.72, '0615678901', 'CIN5678901234', 'password123'),
    ('Boucher', 'Maxime', '456 Rue des Lilas, Paris', 'maxime.boucher@example.com', 'France', 'Paris', 'A+', 'Célibataire', 'Ingénieur', 'Actif', 27, 'Homme', 80.1, 1.85, '0616789012', 'CIN6789012345', 'password123'),
    ('Dufresne', 'Hélène', '567 Rue de l'Indépendance, Nantes', 'helene.dufresne@example.com', 'France', 'Nantes', 'O+', 'Mariée', 'Professeur', 'Actif', 37, 'Femme', 70.0, 1.68, '0617890123', 'CIN7890123456', 'password123'),
    ('Vasseur', 'Antoine', '678 Boulevard de la République, Nice', 'antoine.vasseur@example.com', 'France', 'Nice', 'B+', 'Divorcé', 'Technicien', 'Actif', 48, 'Homme', 82.0, 1.77, '0618901234', 'CIN8901234567', 'password123'),
    ('Fournier', 'Sophie', '789 Rue du Bonheur, Bordeaux', 'sophie.fournier@example.com', 'France', 'Bordeaux', 'A-', 'Célibataire', 'Commerçant', 'Actif', 32, 'Femme', 68.3, 1.65, '0619012345', 'CIN9012345678', 'password123'),
    ('Vernet', 'Gérard', '890 Avenue des Champs, Toulouse', 'gerard.vernet@example.com', 'France', 'Toulouse', 'O+', 'Veuf', 'Médecin', 'Actif', 58, 'Homme', 90.2, 1.85, '0620123456', 'CIN0123456789', 'password123');
)";
    mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}