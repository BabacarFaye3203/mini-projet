<?php
session_start();
include '../database/DatabaseCreat.php';

// si l'utilisateur est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}
$idP_Patient = $_SESSION['idP_Patient'];

$patients = "SELECT * FROM Patient WHERE idP_Patient = $idP_Patient";
$result = $connect->query($patients);

//  si le patient existe
if ($result->num_rows > 0) {
    $patient = $result->fetch_assoc();
    $_SESSION["nomP_Patient"]=$patient["nomP_Patient"];
    $_SESSION["prenomP"]=$patient['prenomP'];
} else {
    die("Aucun patient trouvé avec cet ID.");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
      
    nav{
            background:rgb(0,100,0);
            text-align: center;
        }
                {
                    background:rgb(0,100,0);
                    text-align: center;
                }

    </style>
</head>
<body>
  <header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../images/CSN Contact.webp" alt="Logo CSN" class="logo-navbar">
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="accueilPatient.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ProfilPatient">Informations personnelles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planifier_rendezVous.php">Mes Rendez-vous</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mesDocuments.php">Mes documents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listeMed.php">La liste des medecins</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="../deconnexion.php">Se Déconnecter</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
        </div>
      </div>
    </div>
  </div>


 </section>
    <!-- Contenu -->
    <main class="container my-4">
        <!-- message de  de Bienvenue -->
        <div class="text-center">
            <h2>Bienvenue, <?php echo $patient['prenomP'] . " " . $patient['nomP_Patient']; ?> !</h2>
            <p>Voici une vue d'ensemble de votre profil.</p>
        </div>

        <!-- Informations Personnelles -->
        <div class="my-4">
            <div class="card">
                <div class="card-header " id="colaccpatient">
                    Informations Personnelles
                </div>
                <div class="card-body">
                    <p><strong>Adresse :</strong> <?php echo $patient['adresseP']; ?></p>
                    <p><strong>Email :</strong> <?php echo $patient['emailP']; ?></p>
                    <p><strong>Pays :</strong> <?php echo $patient['paysP']; ?></p>
                    <p><strong>Ville :</strong> <?php echo $patient['villeP']; ?></p>
                    <p><strong>Contact :</strong> <?php echo $patient['contactP']; ?></p>
                    <p><strong>Âge :</strong> <?php echo $patient['ageP']; ?> ans</p>
                    <p><strong>Sexe :</strong> <?php echo $patient['sexeP']; ?></p>
                </div>
            </div>
        </div>

        <!-- Données Médicales -->
        <div class="my-4">
            <div class="card">
                <div class="card-header " id="colaccpatient">
                    Données Médicales
                </div>
                <div class="card-body">
                    <p><strong>Groupe Sanguin :</strong> <?php echo $patient['groupe_sanguin_Patient']; ?></p>
                    <p><strong>Poids :</strong> <?php echo $patient['poids_Patient']; ?> kg</p>
                    <p><strong>Taille :</strong> <?php echo $patient['taille_Patient']; ?> m</p>
                    <p><strong>Situation Matrimoniale :</strong> <?php echo $patient['situation_matri_Patient']; ?></p>
                    <p><strong>Profession :</strong> <?php echo $patient['profession_Patient']; ?></p>
                    <p><strong>Statut :</strong> <?php echo $patient['statut_Patient']; ?></p>
                </div>
            </div>
        </div>
    </main>
    <?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>



