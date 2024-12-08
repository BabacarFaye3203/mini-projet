<?php
//include 'connexion_db.php';
include 'DatabaseCreat.php';
try{
    $rq1="
     CREATE TABLE IF NOT EXISTS Patient (idP_Patient INT AUTO_INCREMENT NOT NULL,
    nomP_Patient VARCHAR(50),
    prenomP VARCHAR(50),
    adresseP VARCHAR(100),
    email VARCHAR(100),
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
    lieu VARCHAR (200),
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
    email VARCHAR(100),
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
try{
    $rq1="INSERT INTO Medecin (nomM_Medecin, prenomM_Medecin, matriculeM_Medecin, emailM_Medecin, adresseM_Medecin, paysM_Medecin, villeM_Medecin, specialite_Medecin, contactM_Medecin, age, sexe_Medecin, password)
VALUES
('Diop', 'Aissatou', 'M001', 'aissatou.diop@example.com', 'Dakar, Sénégal', 'Sénégal', 'Dakar', 'Médecine générale', '778000001', 45, 'Femme', 'password1'),
('Fall', 'Mamadou', 'M002', 'mamadou.fall@example.com', 'Saint-Louis, Sénégal', 'Sénégal', 'Saint-Louis', 'Cardiologie', '778000002', 50, 'Homme', 'password2'),
('Sarr', 'Mouhamed', 'M003', 'mouhamed.sarr@example.com', 'Thiès, Sénégal', 'Sénégal', 'Thiès', 'Pédiatrie', '778000003', 38, 'Homme', 'password3'),
('Ba', 'Nafissatou', 'M004', 'nafissatou.ba@example.com', 'Ziguinchor, Sénégal', 'Sénégal', 'Ziguinchor', 'Gynécologie', '778000004', 42, 'Femme', 'password4'),
('Diagne', 'Ibrahime', 'M005', 'ibrahime.diagne@example.com', 'Kaolack, Sénégal', 'Sénégal', 'Kaolack', 'Dermatologie', '778000005', 48, 'Homme', 'password5'),
('Seck', 'Aminata', 'M006', 'aminata.seck@example.com', 'Louga, Sénégal', 'Sénégal', 'Louga', 'Ophtalmologie', '778000006', 37, 'Femme', 'password6'),
('Ndiaye', 'El Hadji', 'M007', 'elhadji.ndiaye@example.com', 'Thiès, Sénégal', 'Sénégal', 'Thiès', 'Chirurgie', '778000007', 46, 'Homme', 'password7'),
('Faye', 'Khady', 'M008', 'khady.faye@example.com', 'Dakar, Sénégal', 'Sénégal', 'Dakar', 'Neurologie', '778000008', 40, 'Femme', 'password8'),
('Diouf', 'Oumar', 'M009', 'oumar.diouf@example.com', 'Dakar, Sénégal', 'Sénégal', 'Dakar', 'Orthopédie', '778000009', 54, 'Homme', 'password9'),
('Mbow', 'Saliou', 'M010', 'saliou.mbow@example.com', 'Kaffrine, Sénégal', 'Sénégal', 'Kaffrine', 'Cardiologie', '778000010', 49, 'Homme', 'password10'),
('Toure', 'Ousmane', 'M011', 'ousmane.toure@example.com', 'Kaolack, Sénégal', 'Sénégal', 'Kaolack', 'Médecine interne', '778000011', 51, 'Homme', 'password11'),
('Sy', 'Fatoumata', 'M012', 'fatoumata.sy@example.com', 'Dakar, Sénégal', 'Sénégal', 'Dakar', 'Médecine générale', '778000012', 34, 'Femme', 'password12'),
('Mbaye', 'Alioune', 'M013', 'alioune.mbaye@example.com', 'Tivaouane, Sénégal', 'Sénégal', 'Tivaouane', 'Dentisterie', '778000013', 39, 'Homme', 'password13'),
('Senghor', 'Mame', 'M014', 'mame.senghor@example.com', 'Mbour, Sénégal', 'Sénégal', 'Mbour', 'Pédiatrie', '778000014', 43, 'Femme', 'password14'),
('Bamba', 'Abdoulaye', 'M015', 'abdoulaye.bamba@example.com', 'Ziguinchor, Sénégal', 'Sénégal', 'Ziguinchor', 'Chirurgie', '778000015', 55, 'Homme', 'password15'),
('Gueye', 'Coumba', 'M016', 'coumba.gueye@example.com', 'Dakar, Sénégal', 'Sénégal', 'Dakar', 'Ophtalmologie', '778000016', 41, 'Femme', 'password16'),
('Sall', 'Cheikh', 'M017', 'cheikh.sall@example.com', 'Saint-Louis, Sénégal', 'Sénégal', 'Saint-Louis', 'Gynécologie', '778000017', 47, 'Homme', 'password17'),
('Mane', 'Aminata', 'M018', 'aminata.mane@example.com', 'Kaffrine, Sénégal', 'Sénégal', 'Kaffrine', 'Psychiatrie', '778000018', 33, 'Femme', 'password18'),
('Niane', 'Lamine', 'M019', 'lamine.niane@example.com', 'Louga, Sénégal', 'Sénégal', 'Louga', 'Cardiologie', '778000019', 44, 'Homme', 'password19'),
('Demba', 'Khady', 'M020', 'khady.demba@example.com', 'Mbour, Sénégal', 'Sénégal', 'Mbour', 'Médecine générale', '778000020', 36, 'Femme', 'password20');
";
    mysqli_query($connect,$rq1);
    //echo"créer avec succes";
}catch(Exception $e){
    echo"erreur lors de la création de la base".$e->getMessage();
}
try {
    $req1="create table if not exists rdva
    (
        IDA  int auto_increment
        primary key,
    idR  int         not null,
    type varchar(20) not null,
    dat  datetime    not null,
    lieu varchar(200),
    idP  int         not null,
    idM  int         not null,
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
    idR  int         not null,
    type varchar(20) not null,
    dat  datetime    not null,
    lieu varchar(200),
    idP  int         not null,
    idM  int         not null,
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