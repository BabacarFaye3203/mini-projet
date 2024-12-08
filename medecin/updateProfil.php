<?php 
session_start();
include '../database/DatabaseCreat.php';

// Vérification de la session
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connPatient.php");
    exit();
}

// Gestion du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $idM_Medecin = $_SESSION['id_Medecin']; // ID du médecin depuis la session
    $email = htmlspecialchars($_POST["email"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $code = htmlspecialchars($_POST["numservice"]);
    $pays = htmlspecialchars($_POST["pays"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $age = (int)$_POST["age"];
    $sexe = htmlspecialchars($_POST["sexe"]);
    $contact = htmlspecialchars($_POST["contact"]);
    $specialite = htmlspecialchars($_POST["specialite"]);
    $pwd = htmlspecialchars($_POST["pwd"]);

    // Préparation de la requête SQL
    $req1 = "UPDATE medecin SET 
        nomM_Medecin = ?, 
        prenomM_Medecin = ?, 
        matriculeM_Medecin = ?, 
        email= ?, 
        adresseM_Medecin = ?, 
        paysM_Medecin = ?, 
        villeM_Medecin = ?, 
        specialite_Medecin = ?, 
        contactM_Medecin = ?, 
        age = ?, 
        sexe_Medecin = ?, 
        password = ? 
        WHERE idM_Medecin = ?";

    // Exécution sécurisée avec `bind_param`
    $stm = $connect->prepare($req1);
    $stm->bind_param(
        "sssssssssissi", 
        $nom, $prenom, $code, $email, $adresse, 
        $pays, $ville, $specialite, $contact, 
        $age, $sexe, $pwd, $idM_Medecin
    );

    if ($stm->execute()) {
        header("Location: accueil.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . $stm->error;
    }
}
?>

<?php
// Inclusion de l'en-tête
include '../configuration/headMed.php';
?>

<!-- Bouton de déconnexion -->
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="../deconnexion.php">Se Déconnecter</a></li>
  </ul>
</div>

<section class="notrecouleur text-secondary px-4 py-5 text-center">
  <div>
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white">Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">
          CSN est une plateforme innovante conçue pour centraliser, organiser et sécuriser toutes vos informations médicales.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Formulaire -->
<form action="ProfilMed.php" method="POST" class="container mt-4">
    <div class="mb-3">
        <label for="nom" class="form-label">NOM:</label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo htmlspecialchars($medecin["nomM_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom:</label>
        <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo htmlspecialchars($medecin["prenomM_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">EMAIL:</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($medecin["email"]); ?>">
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse:</label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo htmlspecialchars($medecin["adresseM_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="pays" class="form-label">Pays:</label>
        <input type="text" class="form-control" name="pays" id="pays" value="<?php echo htmlspecialchars($medecin["paysM_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville:</label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?php echo htmlspecialchars($medecin["villeM_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Âge:</label>
        <input type="number" class="form-control" name="age" id="age" value="<?php echo (int)$medecin["age"]; ?>">
    </div>
    <div class="mb-3">
        <label for="sexe" class="form-label">Sexe:</label>
        <input type="text" class="form-control" name="sexe" id="sexe" value="<?php echo htmlspecialchars($medecin["sexe_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="contact" class="form-label">Contact:</label>
        <input type="text" class="form-control" name="contact" id="contact" value="<?php echo htmlspecialchars($medecin["contactM_Medecin"]); ?>">
    </div>
    <div class="mb-3">
        <label for="pwd" class="form-label">Password:</label>
        <input type="password" class="form-control" name="pwd" id="pwd" value="<?php echo htmlspecialchars($medecin["password"]); ?>">
    </div>
    <div class="mb-3">
        <label for="specialite" class="form-label">Spécialité:</label>
        <input type="text" class="form-control" name="specialite" id="specialite" value="<?php echo htmlspecialchars($medecin["specialite_Medecin"]); ?>">
    </div>
    <button type="submit" id="btn" class="btn btn-primary">Mettre à jour</button>
</form>

<?php
// Inclusion du pied de page
include '../configuration/footer.php';
include '../configuration/pied.php';
?>
