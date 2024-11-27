<?php
session_start();
include '../database/DatabaseCreat.php';

//Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}
    $idP_Patient = $_SESSION['idP_Patient'];

    // Préparer la requête
    $stmt = $connect->prepare("SELECT * FROM patient WHERE idP_Patient = ?");
    $stmt->bind_param("i", $idP_Patient); 

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();
            $_SESSION["nomP_Patient"]=$patient["nomP_Patient"];
            $_SESSION["prenomP"]=$patient['prenomP'];
          
        } else {
            echo "Aucun patient trouvé avec cet identifiant.";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
    }




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
<h1>Bienvenue, <?php echo $patient['nomP_Patient']." ".$patient['prenomP']; ?></h1>
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



    <!--les informations personnelles du patient -->
    <div class="container mt-5">
    <h1 class="text-center mb-4">Profil Patient</h1>
    <form action="modificationProfil.php" method="POST">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th>CIN</th>
                    <td><input type="tel" class="form-control" value="<?php echo $patient["CIN_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td><input type="text" name="nom" class="form-control" value="<?php echo $patient["nomP_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input type="email" name="email" class="form-control" value="<?php echo $patient["emailP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["prenomP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["adresseP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Pays</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["paysP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Ville</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["villeP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Groupe sanguin</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["groupe_sanguin_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Situation matrimoniale</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["situation_matri_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Profession</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["profession_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["statut_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Âge</th>
                    <td><input type="number" class="form-control" value="<?php echo $patient["ageP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Sexe</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["sexeP"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Poids</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["poids_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Taille</th>
                    <td><input type="text" class="form-control" value="<?php echo $patient["taille_Patient"]; ?>" disabled></td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><input type="tel" class="form-control" value="<?php echo $patient["contactP"]; ?>" disabled></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
</div>
<?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>
