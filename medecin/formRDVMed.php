<?php
session_start();
@include '../database/DatabaseCreat.php';


if (isset($_POST['RDV'])) {
    $_SESSION['id_Medecin'] = $_SESSION['id_Medecin'];
    $idP= $_SESSION['idP_Patient'];
}


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
    <input class="form-label" type="text" name="lieu" id="motif" placeholder="Lieu du rendez-vous" required><br>
    </div>
    <input type="submit" class="form-label btn btn-primary" name="ok"></input>
</form>
</div>
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