<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si le patient est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}

// Récupérer les rendez-vous du patient avec les informations du médecin
$queryRendezvous = "
    SELECT rdv.idR_RendezVous, rdv.dateR_RendezVous, m.nomM_Medecin, m.prenomM_Medecin, rdv.type_RendezVous, rdv.Lieu,rdv.statut
    FROM RendezVous rdv
    JOIN medecin m ON rdv.idM_Medecin = m.idM_Medecin
    WHERE rdv.idP_Patient = ?
    ORDER BY rdv.dateR_RendezVous DESC
";


$stmtRendezvous = $connect->prepare($queryRendezvous);
$stmtRendezvous->bind_param("i", $_SESSION['idP_Patient']);
$stmtRendezvous->execute();
$resultRendezvous = $stmtRendezvous->get_result();



// Annuler un rendez-vous
if (isset($_POST['annuler_rdv'])) {
  $idRdv = $_POST['idRdv'];
  $queryDelete = "DELETE FROM RendezVous WHERE idR_RendezVous = ?";
  $stmtDelete = $connect->prepare($queryDelete);
  $stmtDelete->bind_param("i", $idRdv);
  $stmtDelete->execute();
  echo "<p>Le rendez-vous a été annulé avec succès.</p>";
}

// Modifier la date d'un rendez-vous
if (isset($_POST['modifier_rdv'])) {
  $idRdv = $_POST['idRdv'];
  $nouvelle_date = $_POST['nouvelle_date'];
  $queryUpdate = "UPDATE RendezVous SET dateR_RendezVous = ? WHERE idR_RendezVous = ?";
  $stmtUpdate = $connect->prepare($queryUpdate);
  $stmtUpdate->bind_param("si", $nouvelle_date, $idRdv);
  $stmtUpdate->execute();
  echo "<p>La date du rendez-vous a été mise à jour avec succès.</p>";
}

// Supprimer un rendez-vous
if (isset($_POST['supprimer_rdv'])) {
  $idRdv = $_POST['idRdv'];
  $queryDelete = "DELETE FROM RendezVous WHERE idR_RendezVous = ?";
  $stmtDelete = $connect->prepare($queryDelete);
  $stmtDelete->bind_param("i", $idRdv);
  $stmtDelete->execute();
  echo "<p>Le rendez-vous a été supprimé définitivement.</p>";
}


//la liste de tous les medecins
$query = "SELECT idM_Medecin, nomM_Medecin, prenomM_Medecin, email FROM medecin";
$stmt = $connect->prepare($query);
$stmt->execute();
$resultPatients = $stmt->get_result();
$rows=$resultPatients->fetch_assoc();

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

 <div class="text-center">
            <h2>Bienvenue, <?= htmlspecialchars($_SESSION['nomP_Patient']); ?></h2>
            <p> Sur cette page, vous pouvez gérer efficacement tous vos rendez-vous médicaux. 
              Vous y trouverez la liste complète de vos rendez-vous planifiés,
               incluant des détails tels que la date, le type de consultation,
                le lieu, ainsi que le nom du médecin concerné.

Cette page vous permet également de :

Annuler un rendez-vous en cas d'empêchement.
Modifier la date ou l'heure pour mieux correspondre à votre emploi du temps.
Supprimer définitivement un rendez-vous si celui-ci n'est plus nécessaire.
De plus, vous avez la possibilité de planifier un nouveau rendez-vous directement depuis cette page,
 en choisissant le médecin et en précisant la date, le type, et le lieu souhaités.

L’objectif est de vous offrir une gestion centralisée et simplifiée de vos consultations 
médicales pour une meilleure organisation de votre santé.</p>
  </div>


<div style="padding: 10% 200px 0% 200px; margin: 8% 23px 10% auto;">
    <h2>Liste de vos rendez-vous</h2>
    <?php if ($resultRendezvous->num_rows > 0) { ?>
        <table class="table" id="myRDV">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom du Médecin</th>
                    <th>Prénom du Médecin</th>
                    <th>Date du Rendez-vous</th>
                    <th>Lieu du Rendez-vous</th>
                    <th>Statut</th>
                    <th>Actions</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($rdv = $resultRendezvous->fetch_assoc()) {
                    $i++;
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($rdv['nomM_Medecin']); ?></td>
                        <td><?= htmlspecialchars($rdv['prenomM_Medecin']); ?></td>
                        <td><?= htmlspecialchars($rdv['dateR_RendezVous']); ?></td>
                        <td><?= htmlspecialchars($rdv['Lieu']); ?></td>
                        <td><?= htmlspecialchars($rdv['statut']); ?></td>
                        <td>
                        <!-- Formulaire pour annuler un rendez-vous -->
                        <form action="planifier_rendezVous.php" method="post" style="display: inline;">
                            <input type="hidden" name="idRdv" value="<?= $rdv['idR_RendezVous']; ?>">
                            <input type="submit" class="btn btn-warning" name="annuler_rdv" value="Annuler">
                        </form>

                        <!-- Formulaire pour modifier la date d'un rendez-vous -->
                        <form action="planifier_rendezVous.php" method="post" style="display: inline;">
                            <input type="hidden" name="idRdv" value="<?= $rdv['idR_RendezVous']; ?>">
                            <input type="datetime-local" name="nouvelle_date" class="form-control" required>
                            <input type="submit" class="btn btn-info" name="modifier_rdv" value="Modifier la date">
                        </form>

                        <!-- Formulaire pour supprimer un rendez-vous -->
                        <form action="planifier_rendezVous.php" method="post" style="display: inline;">
                            <input type="hidden" name="idRdv" value="<?= $rdv['idR_RendezVous']; ?>">
                            <input type="submit" class="btn btn-danger" name="supprimer_rdv" value="Supprimer">
                        </form>
                    </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucun rendez-vous prévu.</p>
    <?php } ?>
</div>

<!--form pour rdv
<div class="container">
<form action="planifier_rendezVous.php" method="post" >
 
    <div class="mb-3">
    <label class="form-label" for="date">Date et heure :</label><br>
    <input class="form-label" type="datetime-local" id="date" name="date_rdv" required><br><br>
    </div>
    <div class="mb-3">
    <label class="form-label" for="motif">Motif</label><br>
    <input class="form-label" type="text" name="motif" id="motif" placeholder="motif du rendez-vous" required><br><br>
    </div>
    <div class="mb-3">
    <label class="form-label" for="motif">Lieu</label><br>
    <input class="form-label" type="text" name="lieu" id="motif" placeholder="Lieu du rendez-vous" required><br><br>
    </div>
    <input type="submit" class="form-label btn btn-primary" name="ok">Demandez le RDV</input>
</form>
</div>
-->
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


