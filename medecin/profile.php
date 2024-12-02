<?php
session_start();
@include '../database/DatabaseCreat.php';

// Vérifier si le medecin est connecté
if (!isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}

$idM_Med = $_SESSION['idM_Medecin'];
//******************************************************************************************
$req="SELECT nomM_Medecin as nom,prenomM_Medecin as pre,emailM_Medecin as email,
       age,contactM_Medecin as tel,villeM_Medecin as ville,
       paysM_Medecin as pays,adresseM_Medecin as addr,matriculeM_Medecin as code,
       specialite_Medecin as spe,sexe_Medecin as sex,password as pwd
FROM medecin WHERE idM_Medecin= ? ";
$stmt0 = $connect->prepare($req);
$stmt0->bind_param("i", $idM_Med);
$stmt0->execute();
$res=$stmt0->get_result();
//******************************************************************************************
?>
<?php //include '../configuration/headPatient.php';
include '../configuration/head.php';
;?>
<!-- Modifier les informations personnelles du patient -->
<?php if ($res->num_rows > 0) {?>
    <?php if($med=  $res->fetch_assoc()){?>
        <div class="container" >
            <form action="modifProfilMed.php" method="POST" style="margin: 0 50% 3% 0 ;">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  id="cod" value="<?php echo $med['code']; ?>" disabled><label for="cod" class="form-label">Matricule</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION['nomM_Medecin']; ?>" disabled><label for="nom" class="form-label">Nom</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="prenom" id="prenom" value="<?php echo $med['pre']; ?>" disabled><label for="prenom" class="form-label">Prénom</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="email" class="form-control" id="exampleInputEmail1"  value="<?php echo $med['email']; ?>" disabled><label for="exampleInputEmail1" class="form-label">Email</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"   id="adresse" value="<?php echo $med['addr']; ?>" disabled><label for="adresse" class="form-label">adresse</label>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  id="pays" value="<?php echo $med['pays']; ?>" disabled><label for="pays" class="form-label">Pays</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  id="ville" value="<?php echo $med['ville']; ?>" disabled><label for="ville" class="form-label">Ville</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"   id="spe" value="<?php echo $med['spe']; ?>" disabled><label for="spe" class="form-label">Spécialité</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"   id="age" value="<?php echo $med['age']; ?>" disabled><label for="age" class="form-label">Âge</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"   id="sex" value="<?php echo $med['sex']; ?>" disabled><label for="sex" class="form-label">Sexe</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"   id="contact" value="<?php echo $med['tel']; ?>" disabled><label for="contact" class="form-label">contact</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="exampleInputPassword1"  value="<?php echo $med['pwd']; ?>" disabled><label for="exampleInputPassword1" class="form-label">Password</label>
                </div>
                <button type="submit" class="btn btn-info">Mettre à jour</button>
            </form>
        </div>

    <?php }
}?>
<?php
include '../configuration/pied.php';
?>


