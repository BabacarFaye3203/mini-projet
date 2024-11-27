<?php 
session_start();
include '../database/DatabaseCreat.php';
if (isset($_SESSION['idP_Patient'])) {
    $idP_Patient = $_SESSION['idP_Patient'];
    $_SESSION["nomP_Patient"]=$_SESSION["nomP_Patient"];
} else {
    //echo "Identifiant patient non défini dans la session.";
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    // Préparer la requête
    $stmt = $connect->prepare("SELECT * FROM patient WHERE idP_Patient = ?");
    $stmt->bind_param("i", $idP_Patient); 

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();
        } else {
            echo "Aucun patient trouvé avec cet identifiant.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
    }

    // Préparer la requête
    $stmt = $connect->prepare("UPDATE patient SET nomP_Patient = ?, emailP = ?  WHERE idP_Patient = ?");
    $stmt->bind_param("sss", $nom,$email, $idP_Patient);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        echo"profil mis a jour avec succes";

    } else {
        echo "Erreur lors de l'exécution  : " . $stmt->error;
    }

}

//include '../configuration/headPatient.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carnet-de-santé</title>
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
        <a class="navbar-brand" href="#">
            <img src="../images/CSN Contact.webp" alt="Logo CSN" class="logo-navbar">
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ProfilPatient">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planifier_rendezVous.php">Mes Rendez-vous</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mesDocuments.php">Mes documents</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h1>Bienvenue, <?php echo $patient['nomP_Patient'].". Ici, vous pouvez planifiez des rendez-vous avec vos medecins préférés !"; ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Se connecter
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="connMed.php">Medecin</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
           Que vous soyez patient ou professionnel de santé,<br>
           Prenez le contrôle de votre santé dès aujourd’hui avec CSN, <br>votre compagnon numérique pour un bien-être optimal.

Accédez à vos données en toute simplicité, où que vous soyez !</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold"></button>
          <button type="button" class="btn btn-outline-light btn-lg px-4"></button>
        </div>
      </div>
    </div>
  </div>




 </section>
<form action="modificationProfil.php" method="POST" class="container mt-4">
    <div class="mb-3">
        <label for="cin" class="form-label">ID:</label>
        <input type="tel" class="form-control" id="cin" value="<?php echo $patient["idP_Patient"]; ?>" disabled>
    </div>
    <div class="mb-3">
        <label for="cin" class="form-label">CIN:</label>
        <input type="tel" class="form-control" id="cin" value="<?php echo $patient["CIN_Patient"]; ?>" >
    </div>
    <div class="mb-3">
        <label for="nom" class="form-label">NOM:</label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $patient["nomP_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">EMAIL:</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $patient["emailP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom:</label>
        <input type="text" class="form-control" id="prenom" value="<?php echo $patient["prenomP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse:</label>
        <input type="text" class="form-control" id="adresse" value="<?php echo $patient["adresseP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="pays" class="form-label">Pays:</label>
        <input type="text" class="form-control" id="pays" value="<?php echo $patient["paysP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville:</label>
        <input type="text" class="form-control" id="ville" value="<?php echo $patient["villeP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="gsang" class="form-label">Groupe sanguin:</label>
        <input type="text" class="form-control" id="gsang" value="<?php echo $patient["groupe_sanguin_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="matrimonialle" class="form-label">Situation matrimoniale:</label>
        <input type="text" class="form-control" id="matrimonialle" value="<?php echo $patient["situation_matri_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="profession" class="form-label">Profession:</label>
        <input type="text" class="form-control" id="profession" value="<?php echo $patient["profession_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="statut" class="form-label">Statut:</label>
        <input type="text" class="form-control" id="statut" value="<?php echo $patient["statut_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Âge:</label>
        <input type="number" class="form-control" id="age" value="<?php echo $patient["ageP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="sexe" class="form-label">Sexe:</label>
        <input type="text" class="form-control" id="sexe" value="<?php echo $patient["sexeP"]; ?>">
    </div>
    <div class="mb-3">
        <label for="poids" class="form-label">Poids:</label>
        <input type="text" class="form-control" id="poids" value="<?php echo $patient["poids_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="taille" class="form-label">Taille:</label>
        <input type="text" class="form-control" id="taille" value="<?php echo $patient["taille_Patient"]; ?>">
    </div>
    <div class="mb-3">
        <label for="contact" class="form-label">Contact:</label>
        <input type="tel" class="form-control" id="contact" value="<?php echo $patient["contactP"]; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>