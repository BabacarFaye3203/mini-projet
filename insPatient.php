<?php
session_start();
  include 'insPatientAction.php';
?>

<?php
include 'configuration/headindex.php'; 
?>
<h3>Inscription du patient</h3>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    connexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="connPatient.php">Me Connecter</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
           Que vous soyez patient ou professionnel de santé,<br>
           Prenez le contrôle de votre santé dès aujourd’hui avec CSN, <br>votre compagnon numérique pour un bien-être optimal.

Accédez à vos données en toute simplicité, où que vous soyez !</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold"></button>
          <button type="button" class="btn btn-outline-light btn-lg px-4"></button>
        </div>
      </div>
    </div>
  </div>


 </section>
    <br><br>
    <div class="container">
      <form action="" method="POST">
        <div class="mb-3">
          <label for="ecin" class="form-label">cin</label>
          <input type="text" class="form-control" name="cin" id="ecin" required>
        </div>
        <div class="mb-3">
          <label for="nom" class="form-label">nom</label>
          <input type="text" class="form-control" name="nom" id="nom" required>
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">prenom</label>
          <input type="text" class="form-control"  name="prenom" id="prenom" required>
        </div>
        <div class="mb-3">
          <label for="adresse" class="form-label">adresse</label>
          <input type="text" class="form-control"  name="adresse" id="adresse" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
          <label for="pays" class="form-label">pays</label>
          <input type="text" class="form-control" name="pays" id="pays" required>
        </div>
        <div class="mb-3">
          <label for="ville" class="form-label">ville</label>
          <input type="text" class="form-control" name="ville" id="ville" required>
        </div>
        <div class="mb-3">
          <label for="gsang" class="form-label">gsang</label>
          <input type="text" class="form-control" name="gsang" id="gsang" required>
        </div>
        <div class="mb-3">
          <label for="matrimonialle" class="form-label">situation matrimoniale</label>
          <input type="text" class="form-control" name="matri" id="matrimonialle" required>
        </div>
        <div class="mb-3">
          <label for="profession" class="form-label">profession</label>
          <input type="text" class="form-control"  name="profession" id="profession" required>
        </div>
        <div class="mb-3">
          <label for="statut" class="form-label">statut</label>
          <input type="text" class="form-control"  name="statut" id="statut" required>
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">age</label>
          <input type="number" class="form-control"  name="age" id="age" required>
        </div>
        <div class="mb-3">
          <label for="sexe" class="form-label">sexe</label>
          <input type="text" class="form-control"  name="sexe" id="sexe" required>
        </div>
        <div class="mb-3">
          <label for="poids" class="form-label">poids</label>
          <input type="text" class="form-control" name="poids" id="poids" required>
        </div>
        <div class="mb-3">
          <label for="taille" class="form-label">taille</label>
          <input type="text" class="form-control"  name="taille" id="taille" required>
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">contact</label>
          <input type="tel" class="form-control"  name="contact" id="contact" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Confirmez votre Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd" required>
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>
<?php
include 'configuration/footer.php';
include 'configuration/pied.php';
?>