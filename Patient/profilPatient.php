<?php
session_start();

@include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}

 $idP_Patient = $_SESSION['idP_Patient'];
/*
$query = "SELECT * FROM patient WHERE idP_Patient = $idP_Patient";
$result = mysqli_query($connect, $query);
$patient = mysqli_fetch_assoc($result);
*/
$req="SELECT * FROM `patient` WHERE `idP_Patient`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idP_Patient);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    //$stmt->bind_result($id, $nom);
  $patient=  $stmt->fetch();
   // @$_SESSION['idP_Patient'] = $id;
   // @$_SESSION['nomP_Patient'] = $nom;
}
?>
<?php include '../configuration/headPatient.php';?>

    <h1>Bienvenue, <?php echo $_SESSION['nomP_Patient']; ?></h1>

    <!-- Modifier les informations personnelles du patient -->
    <h3>Modifier votre profil</h3>
    <form action="/Patient/modificationProfil.php" method="POST">
        <input type="text" name="nom" value="<?php echo $patient['nomP_Patient']; ?>" required>
        <input type="email" name="email" value="<?php echo $patient['emailP']; ?>" required>
        <button type="submit">Mettre à jour</button>
    </form>

    <!--  gestions des documents du patient -->
    <h3>Vos documents</h3>
    <?php
   /*  $doc_query = "SELECT * FROM documents WHERE idP_Patient =$idP_Patient";
     $doc_result = mysqli_query($connect, $doc_query);*/
    $req="SELECT * FROM `documents` WHERE `idP_Patient`= ? ";
    $stmt = $connect->prepare($req);
    $stmt->bind_param("i", $idP_Patient);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $doc=  $stmt->fetch();
        echo "<div>";
        echo "<img src=".$doc['doc_path']."/>";
        echo "<form action='/Patient/supprimer_document.php' method='POST'>
              <div class='mb-3'>
                <input type='hidden' class='form-control'  name='document_id' value='" . @$doc['id'] . "'>
              </div>
              <button type='submit' class='btn btn-primary'>Supprimer ce document</button>
            </form>";
    }
    ?>
    <form action="/Patient/ajouter_document.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" class="form-control"  name="document" required>
            <button type="submit" class="btn btn-primary">Ajouter ce document</button>
        </div>
    </form>
    <!-- Gestion des rendez-vous -->
    <h3>Mes rendez-vous</h3>
    <?php
    $rq = "SELECT * FROM rendezvous WHERE idP_Patient = $idP_Patient";
    $rdv_result = mysqli_query($connect, $rq);

    while ($rdv = mysqli_fetch_assoc($rdv_result)) {
        echo "<div>";
        echo "Date : " . @$rdv['dateR_RendezVous'] . "   type : " . @$rdv['type_RendezVous'];
        echo "<form action='/Patient/annulerRendezVous.php' method='POST'>
            <div class='mb-3'>
                <input type='hidden' class='form-control' name='rdv_id' value='" . @$rdv['idR_RendezVous'] . "'>
                <button type='submit' class='btn btn-primary'>Annuler le rendez-vous</button>
            </div>
            </form>";
   }
    ?>

    <form action="/Patient/planifier_rendezVous.php" method="POST">
        <input type="date" name="date" required>
        <input type="text" name="type" placeholder="type du rendez-vous" required>
        <input type="idM_Medecin" name="idM" required>

        <button type="submit">Planifier un rendez-vous</button>
    </form>

<?php
include '../configuration/pied.php';
?>
