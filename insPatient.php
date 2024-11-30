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
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" name="cin" id="ecin" required><label for="ecin" class="form-label"><b>CIN</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" name="nom" id="nom" required><label for="nom" class="form-label">Nom</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control"  name="prenom" id="prenom" required><label for="prenom" class="form-label">Prénom</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control"  name="adresse" id="adresse" required><label for="adresse" class="form-label">Adresse</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required><label for="exampleInputEmail1" class="form-label">Email</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" name="pays" id="pays" required><label for="pays" class="form-label">Pays</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" name="ville" id="ville" required><label for="ville" class="form-label">Ville</label>
        </div>
          <div class="form-floating mb-3">
              <select name="gsang" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Choisir</option>
                  <option value="A+">A+</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O-">O-</option>
                  <option value="O+">O+</option>
                  <option value="A">A</option>
                  <option value="AB">AB</option>
                  <option value="O">O</option>
                  <option value="B">B</option>
              </select>
              <label for="floatingSelect">Groupe sanguin</label>
          </div>
          <div class="form-floating mb-3">
              <select name="sexe" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Choisir</option>
                  <option value="Homme">Homme</option>
                  <option value="Femme">Femme</option>
              </select>
              <label for="floatingSelect">Sexe</label>
          </div>
          <div class="form-floating mb-3">
              <select name="matri" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Choisir</option>
                  <option value="Célibataire">Célibataire</option>
                  <option value="Mariée">Mariée</option>
                  <option value="Veuve">Veuve</option>
                  <option value="Divorcée">Divorcée</option>
              </select>
              <label for="floatingSelect">Situation matrimoniale</label>
          </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control"  name="profession" id="profession" required><label for="profession" class="form-label">profession</label>
        </div>
          <div class="form-floating mb-3">
              <select name="statut" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option selected>Choisir</option>
                  <option value="Employé">Employé</option>
                  <option value="Cadre">Cadre</option>
                  <option value="Freelance">Freelance</option>
                  <option value="Chômeur">Chômeur</option>
                  <option value="Étudiant(e)">Étudiant(e)</option>
              </select>
              <label for="floatingSelect">Statut</label>
          </div>
        <div class="form-floating mb-3 mt-3">
          <input type="number" class="form-control"  name="age" id="age" required><label for="age" class="form-label">Âge</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control" name="poids" id="poids" required><label for="poids" class="form-label">Poids</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="text" class="form-control"  name="taille" id="taille" required><label for="taille" class="form-label">Taille</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <input type="tel" class="form-control"  name="contact" id="contact" required><label for="contact" class="form-label">Contact</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required><label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd" required><label for="password" class="form-label">Confirmez votre Mot de Passe</label>
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>
<?php
include 'configuration/pied.php';
?>