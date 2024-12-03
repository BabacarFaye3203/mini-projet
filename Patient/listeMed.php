<?php
session_start();
@include '../database/DatabaseCreat.php';


// Récupérer la liste de tous les patients
$queryPatients = "SELECT idM_Medecin, nomM_Medecin, prenomM_Medecin, emailM_Medecin,villeM_Medecin,specialite_Medecin FROM medecin";
$stmtPatients = $connect->prepare($queryPatients);
$stmtPatients->execute();
$resultPatients = $stmtPatients->get_result();

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

<h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nomP_Patient']); ?></h1>
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
 <br><br><br>
 <p class="container">Bienvenue sur la page des médecins
Découvrez notre liste de médecins qualifiés prêts à vous accompagner pour vos besoins de santé.
 Sur cette page, vous pouvez consulter les profils des médecins, leurs spécialités,
 et leurs horaires disponibles. Prenez rendez-vous facilement en quelques clics en sélectionnant
  le médecin de votre choix et en choisissant un créneau qui vous convient.
   Nous mettons tout en œuvre pour rendre votre expérience simple et rapide,
afin que vous puissiez recevoir les soins dont vous avez besoin, au moment opportun.</p>
 <div style="padding: 10% 200px 0% 200px; margin: 8% 23px 10% auto;">
    <h1>Nos Médecins</h1>
    <div class="row">
        <?php if ($resultPatients->num_rows > 0){ 
            $i = 0;
            ?>
           <?php while ($row = $resultPatients->fetch_assoc()) {
                $i++;
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Image de la carte -->
                    <img src="../images/mon Med.webp" class="card-img-top" alt="Image de <?= htmlspecialchars($row['nomM_Medecin']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['nomM_Medecin']) . ' ' . htmlspecialchars($row['prenomM_Medecin']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['emailM_Medecin']); ?></p>
                        <p class="card-text"><?= htmlspecialchars($row['specialite_Medecin']); ?></p>
                        <p class="card-text"><?= htmlspecialchars($row['villeM_Medecin']); ?></p>
                        <form action="planifier_rendezVous.php" method="post">
                            <input type="hidden" name="idM" value="<?= $row['idM_Medecin']; ?>">
                            <input type="submit" class="btn btn-success" name="RDV" value="Prendre rendez-vous">
                        </form>
                        <a href="../patient/profilPatient.php?id=<?= $row['idM_Medecin']; ?>" class="btn btn-primary mt-3">Voir le Profil</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        
   
    </div>
</div>

<?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>