<?php
session_start();
//include 'database/DatabaseCreat.php'; //connexion à la base
$connect = new mysqli('localhost', 'root', '', 'carnet');
if (isset($_POST["ok"])) {
    $email = strip_tags($_POST['email']);
    $pwd= strip_tags($_POST['pwd']);
    // Vérification des informations du patient dans la base de données
  /*  $query = "SELECT * FROM medecin WHERE emailM_Medecin = '$email' AND password = '$pwd'";
    $result =$connect->query($query);
    if($result===false){
      echo"erreur de selection";
    }
    if ($row =mysqli_fetch_assoc($result)) {
        $_SESSION['id_Medecin'] = $row['idM_Medecin'];
        $_SESSION['nomM_Medecin'] = $row['nomM_Medecin'];
        header("Location:medecin/profilMed.php"); // Redirection vers le profil du medecin
        exit();
    } else {
        echo "Identifiants incorrects.";
    }*/
    $req="SELECT idM_Medecin,nomM_Medecin FROM `medecin` WHERE `emailM_Medecin`= ? AND `password`= ?";
    $stmt = $connect->prepare($req);
    $stmt->bind_param("ss", $email, $pwd);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id,$nom);
        $stmt->fetch();
        @$_SESSION['idM_Medecin'] = $id;
        @$_SESSION['nomM_Medecin'] = $nom;
        //@$_SESSION['prenomM_Medecin']=$pren;
        header("Location:medecin/profilMed.php"); // Redirection vers le profil du patient
        exit();
    } else {
        echo "Identifiants incorrects !";
    }
}

?>
<?php
include 'configuration/head.php';?>
<h3>Connexion en tant que medecin</h3><br>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    S'inscrire
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="inscMedecin.php">Oui, je suis Sur</a></li>
  </ul>
</div>

    <br><br>
    <div class="container">
      <form method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="mail professionnelle" name="email" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="pwd" placeholder="Votre mot de passe" required>
        </div>

        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
      </form>
    </div>
<?php include 'configuration/pied.php';?>