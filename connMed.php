<?php
session_start();
include 'database/DatabaseCreat.php'; //connexion à la base

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pwd= $_POST['pwd'];

    // Vérification des informations du patient dans la base de données
    $query = "SELECT * FROM medecin WHERE emailM_Medecin = '$email' AND password = '$pwd'";
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
    }
}
?>
<?php
include 'configuration/headindex.php';?>
<h3>Connexion en tant que medecin</h3><br>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    S'inscrire
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="inscMedecin.php">Oui, je suis Sur</a></li>
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
 </section>


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

        <input type="submit" class="btn btn-primary" value="je me connecte" name="ok">
      </form>
    </div>
<?php include 'configuration/pied.php';
      include 'configuration/footer.php';
?>