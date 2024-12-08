<?php
session_start();
include ("insMedecinAction.php")
?>
<?php
include 'configuration/headindex.php';
?>
<h3>Inscription Madecin</h3>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    connexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="connMed.php">Me Connecter</a></li>
  </ul>
</div>
<section class="notrecouleur text-secondary px-1 py-2 text-center">
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

 </section id="insPatient">
<br></br>
    <div class="container">
      <form action="" method="POST">
        <div class="mb-3">
          <label for="nom" class="form-label">nom</label>
          <input type="text" class="form-control" id="nom" name="nom" required                                                                                                                                                                                                                                                                                                                                                                                                                                   >
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">prenom</label>
          <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="mb-3">
          <label for="adresse" class="form-label">adresse</label>
          <input type="text" class="form-control" id="adresse"  name="adresse" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
          <label for="pays" class="form-label">pays</label>
          <input type="text" class="form-control" id="pays" name="pays" required>
        </div>
        <div class="mb-3">
          <label for="ville" class="form-label">ville</label>
          <input type="text" class="form-control" id="ville" name="ville" required>
        </div>
          <div class="mb-3">
          <label for="specialite" class="form-label">spécialité</label>
          <input type="text" class="form-control" id="specialite"  name="specialite" required>
        </div>
        <div class="mb-3">
          <label for="sexe" class="form-label">sexe</label>
          <input type="text" class="form-control" id="sexe"  name="sexe" required>
        </div>
          <div class="mb-3">
              <label for="age" class="form-label">Âge</label>
              <input type="number" class="form-control" name="age" id="age" required>
          </div>
        <div class="mb-3">
          <label for="code" class="form-label">Numéro de service</label>
          <input type="text" class="form-control" id="code"  name="numservice" required>
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">contact</label>
          <input type="text" class="form-control" id="contact"  name="contact" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Confirmez votre Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd" required>
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>
<?php
include 'configuration/pied.php';
include 'configuration/footer.php';
?>

