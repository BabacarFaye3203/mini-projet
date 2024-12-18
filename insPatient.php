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
    <br><br>
    <div class="container my-5">
        <form action="" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="nomP_Patient" class="form-label">Nom:</label>
                <input type="text" id="nomP_Patient" name="nomP" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="prenomP" class="form-label">Prénom:</label>
                <input type="text" id="prenomP" name="prenomP" class="form-control" required>
            </div>
            <div class="col-md-12">
                <label for="adresseP" class="form-label">Adresse:</label>
                <input type="text" id="adresseP" name="adresseP" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="contactP" class="form-label">Contact:</label>
                <input type="text" id="contactP" name="contactP" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="paysP" class="form-label">Pays:</label>
                <input type="text" id="paysP" name="paysP" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="villeP" class="form-label">Ville:</label>
                <input type="text" id="villeP" name="villeP" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="groupe_sanguin_Patient" class="form-label">Groupe sanguin:</label>
                <input type="text" id="groupe_sanguin_Patient" name="groupe_sanguin_Patient" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="situation_matri_Patient" class="form-label">Situation matrimoniale:</label>
                <input type="text" id="situation_matri_Patient" name="situation_matri_Patient" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="profession_Patient" class="form-label">Profession:</label>
                <input type="text" id="profession_Patient" name="profession_Patient" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="statut_Patient" class="form-label">Statut:</label>
                <input type="text" id="statut_Patient" name="statut_Patient" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="ageP" class="form-label">Âge:</label>
                <input type="number" id="ageP" name="ageP" class="form-control" max="120" required>
            </div>
            <div class="col-md-6">
                <label for="sexeP" class="form-label">Sexe:</label>
                <select id="sexeP" name="sexeP" class="form-select" required>
                    <option value="Homme">Homme</option>
                    <option value="Femme">Femme</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="poids_Patient" class="form-label">Poids (kg):</label>
                <input type="number" id="poids_Patient" name="poids_Patient" class="form-control" step="0.1">
            </div>
            <div class="col-md-6">
                <label for="taille_Patient" class="form-label">Taille (m):</label>
                <input type="text" id="taille_Patient" name="taille_Patient" class="form-control" step="0.01">
            </div>
            <div class="col-md-6">
                <label for="CIN_Patient" class="form-label">CIN:</label>
                <input type="number" id="CIN_Patient" name="CIN_Patient" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Mot de passe:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="col-12 text-center mt-3">
                <button type="submit" class="btn btn-primary">M'inscrire</button>
            </div>
        </form>
    </div>
<?php
include 'configuration/footer.php';
?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>
<?php
include 'configuration/pied.php';
?>