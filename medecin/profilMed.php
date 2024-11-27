<?php
session_start();

@include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['id_Medecin'];
$req="SELECT * FROM `medecin` WHERE `idM_Medecin`= ? ";
$stmt = $connect->prepare($req);
$stmt->bind_param("i", $idM_Med);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $med=  $stmt->fetch();
}
?>
<?php include '../configuration/headPatient.php';?>

<h1>Bienvenue, <?php echo $_SESSION['nomM_Medecin']; ?></h1>

<!-- Modifier les informations personnelles du patient -->
<h3>Modifier votre profil</h3>
<form action="/Patient/modificationProfil.php" method="POST">
    <input type="text" name="nom" value="<?php echo $med['nomM_Medecin']; ?>" required>
    <input type="email" name="email" value="<?php echo $med['emailM_Medecin']; ?>" required>
    <button type="submit">Mettre à jour</button>
</form>

<form action="/Patient/ajouter_document.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <input type="file" class="form-control"  name="document" required>
        <button type="submit" class="btn btn-primary">Ajouter ce document</button>
    </div>
</form>
<!-- Gestion des rendez-vous -->
<h3>Mes rendez-vous</h3>
<?php
$rq = "SELECT * FROM rendezvous WHERE idM_Medecin = $idM_Med";
$rdv_result = mysqli_query($connect, $rq);

while ($rdv = mysqli_fetch_assoc($rdv_result)) {
    echo "<div>";
    echo "Date : " . @$rdv['dateR_RendezVous'] . "   type : " . @$rdv['type_RendezVous'];
    echo "<form action='../Patient/annulerRendezVous.php' method='POST'>
            <div class='mb-3'>
                <input type='hidden' class='form-control' name='rdv_id' value='" . @$rdv['idR_RendezVous'] . "'>
                <button type='submit' class='btn btn-primary'>Annuler le rendez-vous</button>
            </div>
            </form>";
}
?>

<form action="../Patient/planifier_rendezVous.php" method="POST">
    <input type="date" name="date" required>
    <input type="text" name="type" placeholder="type du rendez-vous" required>
    <input type="email" placeholder="le mail du medecin" name="mailM" required>
    <button type="submit">Planifier un rendez-vous</button>
</form>

<?php
include '../configuration/pied.php';
?>
