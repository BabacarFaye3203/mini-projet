<?php
session_start();
include '../database/DatabaseCreat.php';
if (isset($_SESSION['idP_Patient'])) {
  $idP_Patient = $_SESSION['idP_Patient'];
  $patient["nomP_Patient"]=$_SESSION["nomP_Patient"];
} else {
  //echo "Identifiant patient non défini dans la session.";
  exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $date = $_POST['dateR_RendezVous'];
    $type = $_POST['type_RendezVous'];
    $idM_Medecin=$_POST["idM_Medecin"];

        // insertion du doc dans la base de données
            // Préparer la requête
            $stmt = $connect->prepare("INSERT INTO rendezvous (dateR_RendezVous	,type_RendezVous ,idP_Patient,idM_Medecin) VALUES (?,?,?,?)");
            $stmt->bind_param("iss", $date,$type,$idP_Patient,$idM_Medecin);

        if ($stmt->execute()) {
        
            echo " Rendez-vous planifié avec succes";
    } else {
        echo $stmt->error;
    }

} else {
   // echo "Identifiant patient non défini dans la session.";
}

if (isset($_SESSION['idP_Patient'])) {
  $idP_Patient = $_SESSION['idP_Patient'];
} else {
  echo "Identifiant patient non défini dans la session.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idP_Patient = $_SESSION['idP_Patient'];
  $idR_RendezVous = $_POST['idR_RendezVous'];

  $query = "DELETE FROM rendezvous WHERE idR_RendezVous = $idR_RendezVous AND idP_Patient = $idP_Patient";
  mysqli_query($connect, $query);

  header("Location: profilPatient.php");
  exit();
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
<h1>Bienvenue, <?php echo $patient['nomP_Patient'].". Ici, vous pouvez planifiez des rendez-vous avec vos medecins préférés !"; ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      Deconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="deconnexion.php">Medecin</a></li>
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
    <!-- Gestion des rendez-vous du patient-->
    <h3>Mes rendez-vous</h3>
    <?php
      $stmt = $connect->prepare("SELECT * FROM rendezvous WHERE idP_Patient = ?");
      $stmt->bind_param("i", $idP_Patient); // Utilisez "i" si `idP_Patient` est un entier
  
      if ($stmt->execute()) {
          $result = $stmt->get_result();
  
          if ($result->num_rows > 0) {
              $rdv = $result->fetch_assoc();
              if($rdv) {
                echo "<div>";
                echo "Date : " . $rdv['dateR_RendezVous'] . "   type : " . $rdv['type_RendezVous'];
                echo "<form action='annulerRendezVous.php' method='POST'>
                    <div class='mb-3'>
                        <input type='hidden' class='form-control' name='rdv_id' value='" . @$rdv['idR_RendezVous'] . "'>
                        <button type='submit' class='btn btn-primary'>Annuler le rendez-vous</button>
                    </div>
                    </form>";
           }
          } else {
              echo "Aucun rendez-vous actuellement.";
          }
      } else {
          echo $stmt->error;
      }
    
    ?>

    <form action="planifier_rendezVous.php" method="POST">
        <input type="date" name="date" required>
        <input type="text" name="type" placeholder="type du rendez-vous" required>
        <input type="idM_Medecin" name="idM" required>

        <button type="submit">Planifier un rendez-vous</button>
    </form>

<?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>
