<?php
session_start();
@include '../database/DatabaseCreat.php';


if (isset($_POST['RDV'])) {
    $_SESSION['id_Medecin'] = $_SESSION['id_Medecin'];
    $idP= $_SESSION['idP_Patient'];
}

// Récupérer les rendez-vous du patient avec les informations du médecin
$queryRendezvous = "
    SELECT rdv.idR_RendezVous, rdv.dateR_RendezVous, p.nomP_Patient, p.prenomP, rdv.type_RendezVous, rdv.Lieu,rdv.statut,rdv.dateR_RendezVous
    FROM RendezVous rdv
    JOIN patient p ON rdv.idP_Patient = p.idP_Patient
    WHERE rdv.idM_Medecin = ?
    ORDER BY rdv.dateR_RendezVous DESC
";
$stmtRendezvous = $connect->prepare($queryRendezvous);
$stmtRendezvous->bind_param("i", $_SESSION['id_Medecin']);
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



//la liste de tous les patients
$query = "SELECT idP_Patient, nomP_Patient, prenomP, email FROM patient";
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
    $stm->bind_param("ssiis",$date,$motif,$rows["idP_Patient"],$_SESSION['id_Medecin'],$lieu);
    if($stm->execute()){
        $resultat=$stm->get_result();
        echo"rendez-vous planifié";
    }else{
        echo"erreur de planification";
    }
    
    
}

 // Mise à jour du statut du rendez-vous

if (isset($_GET['idR_RendezVous']) && isset($_GET['statut'])) {
    $idRdv = $_GET['idR_RendezVous'];
    $statut = $_GET['statut']; // Récupérer le statut depuis la requête GET

    $sq = "UPDATE RendezVous SET statut = ? WHERE idR_RendezVous = ?";
    $stmt = $connect->prepare($sq);
    $stmt->bind_param('si', $statut, $idRdv); // Passer les valeurs de statut et idRdv
    if ($stmt->execute()) {
        echo "Statut du rendez-vous mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du statut.";
    }
    $stmt->close();
}

?>
<?php
//en-tête de la page
include '../configuration/headMedsous.php';

?>

<h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nomM_Medecin']); ?></h1>
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="../deconnexion.php">Se Deconnecter?</a></li>
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
<div style="padding: 10% 200px 0% 200px; margin: 8% 23px 10% auto;">
    <h2>Liste de vos rendez-vous</h2>
    <?php if ($resultRendezvous->num_rows > 0) { ?>
        <table class="table" id="myRDV">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom du patient</th>
                    <th>Prénom du patient</th>
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
                    $dateRDv=$rdv['dateR_RendezVous'];
                    $i++;
                ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= htmlspecialchars($rdv['nomP_Patient']); ?></td>
                        <td><?= htmlspecialchars($rdv['prenomP']); ?></td>
                        <td><?= htmlspecialchars($rdv['dateR_RendezVous']); ?></td>
                        <td><?= htmlspecialchars($rdv['Lieu']); ?></td>
                        <td><?= htmlspecialchars($rdv['statut']); ?></td>
                        <td>
                        <button onclick="updateStatut(<?= $rdv['idR_RendezVous']; ?>, 'Accepté')">Accepter</button>
                        <button onclick="updateStatut(<?= $rdv['idR_RendezVous']; ?>, 'Refusé')">Refuser</button>
                        <?php if(abs(strtotime("now")-strtotime($dateRDv))>= 86400){?>
                            <button onclick="updateStatut(<?= $rdv['idR_RendezVous']; ?>, 'annulé')">annulé</button>
                        <?php } else { ?>
                            <p id="annulOver">vous ne pouvez malheureusement plus supprimer le rendez-vous. Delai de suppression écoulé</p>
                        <?php } ?>

                        

                      
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
    <input type="submit" class="form-label btn btn-primary" name="ok">Confirmer</input>
</form>
</div>
-->
<?php
?>
<?php


include '../configuration/pied.php';
?>
<script>
    function updateStatut(idRdv, statut) {
    fetch(`planifier_rendezVous.php?idR_RendezVous=${idRdv}&statut=${statut}`)
        .then(response => response.text())
        .then(data => {
            alert(data);  // Affiche la réponse
            location.reload();  // Recharge la page pour afficher les changements
        });
}

</script>
<script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

<?php
include '../configuration/footer.php';
?>