<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si le patient est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}


//la liste de tous les medecins
$query = "SELECT idM_Medecin, nomM_Medecin, prenomM_Medecin, email, adresseM_Medecin FROM medecin";
$stmt = $connect->prepare($query);
$stmt->execute();
$resultMeds = $stmt->get_result();
$rows=$resultMeds->fetch_assoc();

if( $_SERVER['REQUEST_METHOD']="POST" && isset($_POST["ok"])){
  $date=htmlspecialchars($_POST["date_rdv"]);
  $motif=htmlspecialchars($_POST["motif"]);
  $lieu=htmlspecialchars($_POST["lieu"]);

  $rq="INSERT INTO rendezvous(dateR_RendezVous,type_RendezVous,idP_Patient,idM_Medecin,Lieu)VALUES(?,?,?,?,?)";
  $stm=$connect->prepare($rq);
  $stm->bind_param("ssiis",$date,$motif,$rows["idM_Medecin"],$_SESSION['idP_Patient'],$lieu);
  if($stm->execute()){
      $resultat=$stm->get_result();
      echo"rendez-vous planifié";
  }else{
      echo"erreur de planification";
  }
  
  
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
          <a class="nav-link active" aria-current="page" href="accueil.php">Accueil</a>
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

 <section class="notrecouleur text-secondary px-1 py-2 text-center">
 <div >
    <div class="py-1" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
        </div>
      </div>
    </div>
  </div>
 </section>

 <div class="text-center">
            <h2>Bienvenue, <?= htmlspecialchars($_SESSION['nomP_Patient']); ?></h2>
  </div>

<!--form pour rdv-->
<div class="container">
<form action="planifier_rendezVous.php" method="post" >
 
    <div class="mb-3">
    <label class="form-label" for="date">Date et heure :</label><br>
    <input class="form-label" type="datetime-local" id="date" name="date_rdv" required><br>
    </div>
    <div class="mb-3">
    <label class="form-label" for="motif">Motif</label><br>
    <input class="form-label" type="text" name="motif" id="motif" placeholder="motif du rendez-vous" required><br>
    </div>
    <div class="mb-3">
    <label class="form-label" for="motif">Lieu</label><br>
    <input class="form-label" type="text" name="lieu" id="motif" placeholder="Lieu du rendez-vous" value="<?php echo $rows["adresseM_Medecin"]; ?>" disabled><br>
    </div>
    <input type="submit" class="form-label btn btn-primary" name="ok"></input>
</form>
</div>


<?php
// Inclure le pied de page
include '../configuration/footer.php';
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<?php
include '../configuration/pied.php';
?>