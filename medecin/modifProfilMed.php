<?php 
session_start();

include '../database/DatabaseCreat.php';
if (!isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connMed.php");
    exit();
}
$idM_Med = $_SESSION['idM_Medecin'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req="SELECT nomM_Medecin as nom,prenomM_Medecin as pre,emailM_Medecin as email,
       age,contactM_Medecin as tel,villeM_Medecin as ville,
       paysM_Medecin as pays,adresseM_Medecin as addr,matriculeM_Medecin as code,
       specialite_Medecin as spe,sexe_Medecin as sex,password as pwd
FROM medecin WHERE idM_Medecin= ? ";
    $stmt0 = $connect->prepare($req);
    $stmt0->bind_param("i", $idM_Med);
    $stmt0->execute();
    $res=$stmt0->get_result();

    if(isset($_POST['update'])){
        $idM = $_SESSION['idM_Medecin'];
        $email = $_POST['email'];
        $vi = $_POST['ville'];
        $p = $_POST['pays'];
        $add = $_POST['adr'];
        $cod = $_POST['cod'];
        $age = $_POST['age'];
        $tel = $_POST['tel'];
        $pwd = $_POST['pwd'];

        $query = "UPDATE medecin 
              SET emailM_Medecin = ?, adresseM_Medecin = ?, paysM_Medecin = ?, 
                  villeM_Medecin = ?, contactM_Medecin = ?, age = ?, matriculeM_Medecin = ?          
              WHERE idM_Medecin = ?";
        $stmt = $connect->prepare($query);
        //$connect->query($query);
        $stmt = $connect->prepare($query);
        $stmt->bind_param("ssssisss", $email, $add, $p, $vi, $tel, $age, $cod, $idM);
        $stmt->execute();
        header("Location: profilMed.php");
        exit();
    }

}
?>
<?php
include '../configuration/patient/headPatient.php';?>
<?php if ($res->num_rows > 0) {?>
    <?php if($med=  $res->fetch_assoc()){?>
        <div class="container" >
            <form action="modifProfilMed.php" method="POST" style="margin: 0 50% 3% 0 ;">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="cod" id="cod" value="<?php echo $med['code']; ?>" required><label for="cod" class="form-label">Matricule</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION['nomM_Medecin']; ?>" disabled><label for="nom" class="form-label">Nom</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="prenom" id="prenom" value="<?php echo $med['pre']; ?>" disabled><label for="prenom" class="form-label">Prénom</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $med['email']; ?>" required><label for="exampleInputEmail1" class="form-label">Email</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="adr" id="adresse" value="<?php echo $med['addr']; ?>" required><label for="adresse" class="form-label">adresse</label>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="pays" id="pays" value="<?php echo $med['pays']; ?>" required><label for="pays" class="form-label">Pays</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $med['ville']; ?>" required><label for="ville" class="form-label">Ville</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="spe" id="spe" value="<?php echo $med['spe']; ?>" disabled><label for="spe" class="form-label">Spécialité</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="age" id="age" value="<?php echo $med['age']; ?>" required><label for="age" class="form-label">Âge</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="sex" id="sex" value="<?php echo $med['sex']; ?>" disabled><label for="sex" class="form-label">Sexe</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control"  name="tel" id="contact" value="<?php echo $med['tel']; ?>" required><label for="contact" class="form-label">contact</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="exampleInputPassword1" name="pwd" value="<?php echo $med['pwd']; ?>" required><label for="exampleInputPassword1" class="form-label">Password</label>
                </div>
                <input type="submit" class="btn btn-info" name="update" value="Mettre à jour">
            </form>
        </div>

    <?php }
}?>
<?php
include '../configuration/patient/piedPatient.php';
?>

