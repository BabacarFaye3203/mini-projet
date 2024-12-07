<?php
session_start();
include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté comme médecin
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connPatient.php");
    exit();
}

// Récupérer l'ID du médecin depuis la session
$idM_Medecin = $_SESSION['id_Medecin'];

// Préparer et exécuter la requête pour récupérer les informations du médecin
$stmt = $connect->prepare("SELECT * FROM Medecin WHERE idM_Medecin = ?");
$stmt->bind_param("i", $idM_Medecin);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $medecin = $result->fetch_assoc();
    } else {
        echo "Aucun médecin trouvé avec cet identifiant.";
        exit();
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
    exit();
}
?>


<?php
//  l'en-tête de la page
include '../configuration/headMed.php';
?>

    <div class="container mt-5">
        <h1>Informations personnelles du Médecin</h1>
        <br><br>
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th>Nom</th>
                    <td><?php echo htmlspecialchars($medecin["nomM_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td><?php echo htmlspecialchars($medecin["prenomM_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($medecin["email"]); ?></td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td><?php echo htmlspecialchars($medecin["adresseM_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Pays</th>
                    <td><?php echo htmlspecialchars($medecin["paysM_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Ville</th>
                    <td><?php echo htmlspecialchars($medecin["villeM_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Spécialité</th>
                    <td><?php echo htmlspecialchars($medecin["specialite_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Sexe</th>
                    <td><?php echo htmlspecialchars($medecin["sexe_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Âge</th>
                    <td><?php echo htmlspecialchars($medecin["age"]); ?></td>
                </tr>
                <tr>
                    <th>Numéro de Service</th>
                    <td><?php echo htmlspecialchars($medecin["matriculeM_Medecin"]); ?></td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><?php echo htmlspecialchars($medecin["contactM_Medecin"]); ?></td>
                </tr>
            </tbody>
        </table>
      
        <form action="updateProfil.php" method="POST">
            <div class="text-center">
                <button type="submit" id="butprofpatient">Mettre à jour</button>
            </div>
        </form>
        </div>
    </div>

    <?php


include '../configuration/footer.php';
?>
<?php
include '../configuration/pied.php';
?>
