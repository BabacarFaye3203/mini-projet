<?php
session_start();
include '../database/DatabaseCreat.php';
if (isset($_SESSION['idP_Patient'])) {
  $idP_Patient = $_SESSION['idP_Patient'];
  $_SESSION["nomP_Patient"]=$_SESSION["nomP_Patient"];
} else {
  //echo "Identifiant patient non défini dans la session.";
  exit;
}
// Vérifier si un ID de document a été envoyé par POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['document_id'])) {
    $document_id = $_POST['document_id']; // Récupérer l'ID du document à supprimer

    // Préparer la requête pour récupérer le chemin du fichier dans la base de données
    $stmt = $connect->prepare("SELECT doc_path FROM documents WHERE id = ?");
    $stmt->bind_param("i", $document_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $doc = $result->fetch_assoc();
        $docPath = $doc['doc_path']; // Récupérer le chemin complet du fichier

        // Supprimer le fichier du système de fichiers
        if (file_exists($docPath)) {
            unlink($docPath); // Supprimer le fichier
        }

        // Supprimer le document de la base de données
        $stmt = $connect->prepare("DELETE FROM documents WHERE id = ?");
        $stmt->bind_param("i", $document_id);

        if ($stmt->execute()) {
            echo 'Document supprimé avec succès.';
            header("Location: " . $_SERVER['PHP_SELF']); // Rediriger pour actualiser la page
            exit();
        } else {
            echo 'Erreur lors de la suppression du document dans la base de données.';
        }
    } else {
        echo 'Le document n\'a pas été trouvé.';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_SESSION['idP_Patient'])) {
      $idP_Patient = $_SESSION['idP_Patient'];
      $dossier = "../uploads/"; // Dossier cible pour les fichiers
      $nomDocument = basename($_FILES["document"]["name"]);
      $targerdocpath = $dossier . $nomDocument;
      $description=$_POST["description"];

      // Vérification si le fichier a été téléchargé
      if (move_uploaded_file($_FILES["document"]["tmp_name"], $targerdocpath)) {
          // Insertion du doc dans la table documents de la bdd
          $stmt = $connect->prepare("INSERT INTO documents (idP_Patient, doc_name, doc_path,description) VALUES (?, ?, ?,?)");
          $stmt->bind_param("isss", $idP_Patient, $nomDocument, $targerdocpath,$description);

          if ($stmt->execute()) {
              header("Location: " . $_SERVER['PHP_SELF']);
              exit();
          } else {
              echo '<div class="alert alert-danger">Erreur lors de l\'insertion : ' . htmlspecialchars($stmt->error) . '</div>';
          }
      } else {
          echo '<div class="alert alert-danger">Erreur lors du téléchargement du fichier.</div>';
      }
  } else {
      echo "Identifiant patient non défini dans la session.";
  }
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
            <p> Cette page est conçue pour vous permettre de gérer 
              vos documents médicaux de manière simple et sécurisée. vous pouvez ajouter de nouveaux documents 
              tels que des ordonnances, des analyses ou des rapports médicaux, les organiser et les consulter à tout moment. 
              La plateforme offre également une fonctionnalité pour supprimer des documents obsolètes ou inutiles, 
              tout en garantissant que les fichiers importants restent accessibles.
               Grâce à cette interface intuitive, vous pouvez centraliser et sécuriser l’ensemble de vos données médicales,
               évitant ainsi les pertes ou dispersions d’informations importantes.</p>
  </div>
 

<!--  ajout des documents du patient -->
  <div class="container">
  <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" class="form-control"  name="document" required>
            <input type="text" class="form-control"  name="description" value="la description" required>
            <button type="submit" class="btn btn-primary">Ajouter ce document</button>
        </div>
    </form>
  </div>
    

<h3>Vos documents</h3>
    <?php
 // Préparation de la requete
 $stmt = $connect->prepare("SELECT * FROM documents WHERE idP_Patient = ?");
 $stmt->bind_param("i", $idP_Patient);
 
 if ($stmt->execute()) {
     $result = $stmt->get_result();
 
     if ($result->num_rows > 0) {
         echo '<div class="container mt-4">';
         echo '<h3>Liste des documents du patient</h3>';
         echo '<table class="table table-striped table-bordered">';
         echo '<thead class="table-dark">';
         echo '<tr>';
         echo '<th>#</th>';
         echo '<th>Nom du document</th>';
         echo '<th>Description</th>';
         echo '<th>Suppression</th>';
         echo '</tr>';
         echo '</thead>';
         echo '<tbody>';
 
         while ($doc = $result->fetch_assoc()) {
             echo '<tr>';
             echo '<td>' . $doc['id'] . '</td>';
             echo '<td><a href="uploads/' . htmlspecialchars($doc['doc_path']) . '" target="_blank">' . htmlspecialchars(@$doc['doc_name']) . '</a></td>';
             echo '<td>' . htmlspecialchars($doc['description']) . '</td>';
             echo '<td>';
             echo '<form action="" method="POST" class="d-inline">';
             echo '<input type="hidden" name="document_id" value="' . htmlspecialchars(@$doc['id']) . '">';
             echo '<button type="submit" class="btn btn-danger btn-sm">Supprimer</button>';
             echo '</form>';
             echo '</td>';
             echo '</tr>';
         }
 
         echo '</tbody>';
         echo '</table>';
         echo '</div>';
     } else {
         echo '<div class="alert alert-warning">Aucun documents</div>';
     }
 } else {
     echo '<div class="alert alert-danger">Erreur lors de l\'exécution de la requête : ' . htmlspecialchars($stmt->error) . '</div>';
 }
 ?>

<script>
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function(e) {
        if (!confirm('Vous etes sûr de vouloir supprimer ce document ?')) {
            e.preventDefault();
        }
    });
});
</script>


<?php
include '../configuration/footer.php';
 include '../configuration/pied.php';?>