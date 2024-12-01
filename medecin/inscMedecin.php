<?php
session_start();
include ("insMedecinAction.php")
?>
<?php
include '../configuration/docteur/headPatient.php';
?>
<h3>Inscription</h3>

    <!--<div class="container">
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

      </form>
    </div>-->
<div class="container">

    <form action="insMedecinAction.php" method="POST">
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" name="cod" id="cod" required><label for="cod" class="form-label"><b>Matricule</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" name="nom" id="nom"  required><label for="nom" class="form-label">Nom</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control"  name="prenom" id="prenom" required><label for="prenom" class="form-label">Prénom</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" required><label for="exampleInputEmail1" class="form-label">Email</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control"  name="adr" id="adresse" required><label for="adresse" class="form-label">adresse</label>
        </div>

        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" name="pays" id="pays" required><label for="pays" class="form-label">Pays</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" name="ville" id="ville" required><label for="ville" class="form-label">Ville</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control"  name="spe" id="spe" required><label for="spe" class="form-label">Spécialité</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control"  name="age" id="age" required><label for="age" class="form-label">Âge</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control"  name="sex" id="sex" required><label for="sex" class="form-label">Sexe</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control"  name="tel" id="contact" required><label for="contact" class="form-label">contact</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required><label for="exampleInputPassword1" class="form-label">Password</label>
        </div>
        <div class="form-floating mb-3">

            <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd" required><label for="exampleInputPassword1" class="form-label">Confirmez votre Password</label>
        </div>
        <input type="submit" class="btn btn-primary" value="S'inscrire" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
    </form>
</div>
<?php
include '../configuration/patient/piedPatient.php';
?>

