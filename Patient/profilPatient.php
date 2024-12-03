<?php
session_start();
include '../database/DatabaseCreat.php';

// Vérifier si l'utilisateur est connecté (Médecin ou Patient)
if (!isset($_SESSION['idP_Patient']) && !isset($_SESSION['idM_Medecin'])) {
    header("Location: ../connexion.php");
    exit();
}

// Vérification si un ID de patient est passé en paramètre pour l'acces du medecin
if (isset($_GET['id'])) {
    $idP_Patient = intval($_GET['id']);
} else {
    // Sinon,on verifie la connexion  du patient 
    if (isset($_SESSION['idP_Patient'])) {
        $idP_Patient = $_SESSION['idP_Patient'];
    } else {
        echo "Erreur : Aucun patient sélectionné.";
        exit();
    }
}


$stmt = $connect->prepare("SELECT * FROM Patient WHERE idP_Patient = ?");
$stmt->bind_param("i", $idP_Patient);

if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        echo "Aucun patient trouvé avec cet identifiant.";
        exit();
    }
} else {
    echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="../style.css">
    <style>
      
    nav{
            background:rgb(0,100,0);
            text-align: center;
        }
                {
                    background:rgb(0,100,0);
                    text-align: center;
                }

    </style>
</head>
<body>
  <header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../images/CSN Contact.webp" alt="Logo CSN" class="logo-navbar">
        </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="accueilPatient.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ProfilPatient">Informations personnelles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="planifier_rendezVous.php">Mes Rendez-vous</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mesDocuments.php">Mes documents</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listeMed.php">La liste des medecins</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
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

 <div class="text-center">
            <h2>Bienvenue, <?= htmlspecialchars($_SESSION['nomP_Patient']); ?></h2>
            <p> Sur cette page, vous avez la possibilité de consulter 
                et de modifier vos informations personnelles à tout moment.
                 Cela comprend des données importantes telles que votre nom, prénom,
                  adresse email, numéro de téléphone, ainsi que d'autres informations de contact.
                   Cette fonctionnalité vous permet de maintenir vos coordonnées à jour,
                    facilitant ainsi la communication avec vos médecins et la gestion de vos rendez-vous.
                     La page vous offre une interface simple et sécurisée pour effectuer ces modifications,
                      afin que vous puissiez garder 
                votre profil à jour tout en respectant votre vie privée.</p>
  </div>

    <!--les informations personnelles du patient -->
    <div class="container mt-5">
    <h1 id="titreprofilpatient"> informations personnelles: </h1>
    <br><br>
    <form action="modificationProfil.php" method="POST">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th>CIN</th>
                    <td><?php echo $patient["CIN_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Nom</th>
                    <td><?php echo $patient["nomP_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $patient["emailP"]; ?></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td><?php echo $patient["prenomP"]; ?></td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td><?php echo $patient["adresseP"]; ?></td>
                </tr>
                <tr>
                    <th>Pays</th>
                    <td><?php echo $patient["paysP"]; ?></td>
                </tr>
                <tr>
                    <th>Ville</th>
                    <td><?php echo $patient["villeP"]; ?></td>
                </tr>
                <tr>
                    <th>Groupe sanguin</th>
                    <td><?php echo $patient["groupe_sanguin_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Situation matrimoniale</th>
                    <td><?php echo $patient["situation_matri_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Profession</th>
                    <td><?php echo $patient["profession_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td><?php echo $patient["statut_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Âge</th>
                    <td><?php echo $patient["ageP"]; ?></td>
                </tr>
                <tr>
                    <th>Sexe</th>
                    <td><?php echo $patient["sexeP"]; ?></td>
                </tr>
                <tr>
                    <th>Poids</th>
                    <td><?php echo $patient["poids_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Taille</th>
                    <td><?php echo $patient["taille_Patient"]; ?></td>
                </tr>
                <tr>
                    <th>Contact</th>
                    <td><?php echo $patient["contactP"]; ?></td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <?php if (isset($_SESSION['idP_Patient'])): ?>
                    <form action="modificationProfil.php" method="POST">
                        <div class="text-center">
                            <button type="submit" id="butprofpatient">Mettre à jour</button>
                        </div>
                    </form>
                <?php else: ?>
                    <p class="text-muted text-center">Vous consultez ce profil en tant que médecin.</p>
             <?php endif; ?>
            
        </div>
    </form>
</div>
<?php
include '../configuration/footer.php';
include '../configuration/pied.php';
?>
