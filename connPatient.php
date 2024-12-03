<?php
session_start();
include 'database/DatabaseCreat.php'; //connexion à la base
ob_start(); // Évitez les problèmes de sortie avant les en-têtes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    // Utilisation d'une requête préparée pour éviter les injections SQL
    $stm = $connect->prepare("SELECT * FROM patient WHERE emailP = ? AND password = ?");
    $stm->bind_param("ss", $email, $pwd); // "ss" signifie deux chaînes (string)

    if ($stm->execute()) {
        $res = $stm->get_result(); // Récupération du résultat
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $_SESSION['idP_Patient'] = $row['idP_Patient'];
            $_SESSION['nomP_Patient'] = $row['nomP_Patient'];

            // Redirection vers le profil du patient
            header("Location: Patient/accueilPatient.php");
            exit;
        } else {
            echo "Email ou mot de passe incorrect";
        }
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $stm->error;
    }
}


?>
<?php
include 'configuration/headindex.php';?>


 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <h3>Connexion en tant que patient</h3><br>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    S'inscrire
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="insPatient.php">Oui, je suis Sur</a></li>
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
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="pwd">
        </div>

        <input type="submit" class="btn btn-primary" value="je me connecte" name="ok">
      </form>
    </div>
<?php include 'configuration/footer.php';
  include 'configuration/pied.php';
?>
