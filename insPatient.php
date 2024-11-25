<?php
session_start();
  include 'insPatientAction.php';
?>

<?php
include 'configuration/head.php'; 
?>
<h3>Inscription du patient</h3>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    connexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="/connPatient.php">Me Connecter</a></li>
  </ul>
</div>
    <br><br>
    <div class="container">
      <form action="" method="POST">
        <div class="mb-3">
          <label for="ecin" class="form-label">cin</label>
          <input type="text" class="form-control" name="cin">
        </div>
        <div class="mb-3">
          <label for="nom" class="form-label">nom</label>
          <input type="text" class="form-control" name="idpatient">
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">prenom</label>
          <input type="text" class="form-control"  name="prenom">
        </div>
        <div class="mb-3">
          <label for="adresse" class="form-label">adresse</label>
          <input type="text" class="form-control"  name="adresse">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3">
          <label for="pays" class="form-label">pays</label>
          <input type="text" class="form-control" name="pays">
        </div>
        <div class="mb-3">
          <label for="ville" class="form-label">ville</label>
          <input type="text" class="form-control" name="ville">
        </div>
        <div class="mb-3">
          <label for="gsang" class="form-label">gsang</label>
          <input type="text" class="form-control" name="gsang">
        </div>
        <div class="mb-3">
          <label for="matrimonialle" class="form-label">situation matrimoniale</label>
          <input type="text" class="form-control" name="matri">
        </div>
        <div class="mb-3">
          <label for="profession" class="form-label">profession</label>
          <input type="text" class="form-control"  name="profession">
        </div>
        <div class="mb-3">
          <label for="statut" class="form-label">statut</label>
          <input type="text" class="form-control"  name="statut">
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">age</label>
          <input type="text" class="form-control"  name="age">
        </div>
        <div class="mb-3">
          <label for="sexe" class="form-label">sexe</label>
          <input type="text" class="form-control"  name="sexe">
        </div>
        <div class="mb-3">
          <label for="poids" class="form-label">poids</label>
          <input type="text" class="form-control" name="poids">
        </div>
        <div class="mb-3">
          <label for="taille" class="form-label">taille</label>
          <input type="text" class="form-control"  name="taille">
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">contact</label>
          <input type="text" class="form-control"  name="contact">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Confirmez votre Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd">
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>
<?php
include 'configuration/pied.php';
?>