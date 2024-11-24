<?php
session_start();
include '../database/connexion_db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idP_Patient'])) {
    header("Location: ../connPatient.php");
    exit();
}

$idP_Patient = $_SESSION['idP_Patient'];
$query = "SELECT * FROM patient WHERE id = $idP_Patient";
$result = mysqli_query($connect, $query);
$patient = mysqli_fetch_assoc($result);

?>
<?php include '../configuration/headPatient.php';?>

    <h1>Bienvenue, <?php echo $patient['nomP_patient']; ?></h1>

    <!-- Modifier les informations personnelles du patient -->
    <h3>Modifier votre profil</h3>
    <form action="modificationProfil.php" method="POST">
        <input type="text" name="nom" value="<?php echo $patient['nom']; ?>" required>
        <input type="email" name="email" value="<?php echo $patient['email']; ?>" required>
        <button type="submit">Mettre à jour</button>
    </form>

    <!--  gestions des documents du patient -->
    <h3>Vos documents</h3>
    <?php
     $doc_query = "SELECT * FROM documents WHERE idP_Patient =$idP_patient";
     $doc_result = mysqli_query($connect, $doc_query);

    while ($doc = mysqli_fetch_assoc($doc_result)) {
        echo "<div>";
        echo "<a href='uploads/" . @$doc['doc_path'] . "'>" . @$doc['doc_name'] . "</a>";
        echo"<form action='supprimer_document.php' method='POST'>
              <div class='mb-3'>
                <input type='hidden' class='form-control'  name='document_id' value='" . @$doc['id'] . "'>
              </div>
              <button type='submit' class='btn btn-primary'>Supprimer ce document</button>
            </form>";
    }
    ?>
    <form action="ajouter_document.php" method="POST" enctype="multipart/form-data">
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
        echo"<form action='annulerRendezVous.php' method='POST'>
            <div class='mb-3'>
                <input type='hidden' class='form-control' name='rdv_id' value='" . @$rdv['idR_RendezVous'] . "'>
                <button type='submit' class='btn btn-primary'>Annuler le rendez-vous</button>
            </div>
            </form>";
   }
    ?>

    <form action="planifier_rendezVous.php" method="POST">
        <input type="date" name="date" required>
        <input type="text" name="type" placeholder="type du rendez-vous" required>
        <input type="idM_Medecin" name="idM" required>

        <button type="submit">Planifier un rendez-vous</button>
    </form>

<?php
include '../configuration/pied.php';
?>
