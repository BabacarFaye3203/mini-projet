<?php
session_start();
include 'database/connexion_db.php'; //connexion à la base

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pwd= $_POST['pwd'];

    // Vérification des informations du patient dans la base de données
    $query = "SELECT * FROM medecin WHERE emailM = '$email' AND password = '$pwd'";
    $result =$connect->query($query);
    if($result===false){
      echo"erreur de selection";
    }
    if ($row =mysqli_fetch_assoc($result)) {
        $_SESSION['id_Medecin'] = $row['idP_Medecin'];
        $_SESSION['username'] = $row['nomM_Medecin'];
        header("Location:medecin/profilMed.php"); // Redirection vers le profil du medecin
        exit();
    } else {
        echo "Identifiants incorrects.";
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