<?php 
session_start();
include '../database/DatabaseCreat.php';
if (!isset($_SESSION['id_Medecin'])) {
    header("Location: ../connPatient.php");
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idP_Patient = $_SESSION['id_Medecin'];

   
    @$email = htmlspecialchars($_POST["email"]);
    @$nom=$_POST["nom"];
    @$prenom=$_POST["prenom"];
    @$code=$_POST["numservice"];
    @$pays=$_POST["pays"]; @$adresse=$_POST["adresse"]; @$ville=$_POST["ville"];
    @$age=$_POST["age"]; @$sexe=$_POST["sexe"];  @$contact=$_POST["contact"];
    @$specialite=$_POST['specialite'];
    $pwd=$_POST["pwd"];
    // Préparer la requête
    $req1=("UPDATE FROM medecin SET nomM_Medecin=?, prenomM_Medecin=?, matriculeM_Medecin=?,
    emailM_Medecin=?, adresseM_Medecin=?, paysM_Medecin=?,
    villeM_Medecin=?, specialite_Medecin=?, contactM_Medecin=?,
    age=?, sexe_Medecin=?, password=?");
$stm=$connect->prepare($req1);
$stm->bind_param("sssssssssiss",$nom,$prenom,$code,$email,$adresse,
$pays,$ville,$specialite,$contact,$age,$sexe,$pwd);
if($stm->execute()){
    header("location:accueil.php");
}

}

//include '../configuration/headPatient.php';
?>
<?php
//  l'en-tête de la page
include '../configuration/headMed.php';
?>
 
<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Déconnexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="../deconnexion.php">Se Déconnecter</a></li>
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
<form action="ProfilMed.php" method="POST" class="container mt-4">
    <div class="mb-3">
        <label for="cin" class="form-label">Id:</label>
        <input type="tel" class="form-control"  id="cin" value="<?php echo $medecin["idM_Medecin"]; ?>" disabled>
    </div>
    
    <div class="mb-3">
        <label for="nom" class="form-label">NOM:</label>
        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $medecin["nomM_Medecin"]; ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">EMAIL:</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo $medecin["email"]; ?>">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom:</label>
        <input type="text" class="form-control" name="prenom" id="prenom"  value="<?php echo $medecin["prenomM_Medecin"]; ?>">
    </div>
    <div class="mb-3">
        <label for="adresse" class="form-label">Adresse:</label>
        <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $medecin["adresseM_Medecin"]; ?>">
    </div>
    <div class="mb-3">
        <label for="pays" class="form-label">Pays:</label>
        <input type="text" class="form-control" name="pays" id="pays" value="<?php echo $medecin["paysM_Medecin"]; ?>">
    </div>
    <div class="mb-3">
        <label for="ville" class="form-label">Ville:</label>
        <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $medecin["villeM_Medecin"]; ?>">
    </div>
  
    <div class="mb-3">
        <label for="age" class="form-label">Âge:</label>
        <input type="number" class="form-control" name="age" id="age" value="<?php echo $medecin["age"]; ?>">
    </div>
    <div class="mb-3">
        <label for="sexe" class="form-label">Sexe:</label>
        <input type="text" class="form-control" name="sexe" id="sexe" value="<?php echo $medecin["sexe_Medecin"]; ?>">
    </div>
    <div class="mb-3">
        <label for="contact" class="form-label">Contact:</label>
        <input type="text" class="form-control" name="contact" id="contact" value="<?php echo $medecin["contactM_Medecin"]; ?>">
    </div>
    <div class="mb-3">
        <label for="pwd" class="form-label">password:</label>
        <input type="password" class="form-control" name="pwd" id="pwd" value="<?php echo $medecin["password"]; ?>">
    </div>
    <div class="mb-3">
        <label for="specialite" class="form-label">Specialite:</label>
        <input type="text" class="form-control" name="spc" id="specialite" value="<?php echo $medecin["specialite_Medecin"]; ?>">
    </div>
    <button type="submit" id="btn">Mettre à jour</button>
</form>

<?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>