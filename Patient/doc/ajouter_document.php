<?php
session_start();
include '../../database/DatabaseCreat.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idP_Patient = $_SESSION['idP_Patient'];
    $dossier = "../uploads/"; // Dossier cible pour les fichiers
    $nomDocument = basename($_FILES["document"]["name"]);
    $targerdocpath = $dossier.$nomDocument;

    // Vérifier si le fichier a été téléchargé
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $targerdocpath)) {
        // insertion du doc dans la base de données
/*$stmt = $connect->prepare("INSERT INTO documents (idP_Patient,doc_name ,
                       doc_path) 
VALUES ($idP_Patient,$nomDocument, $targerdocpath)");*/
$req="INSERT INTO documents (idP_Patient,doc_name ,
                       doc_path) 
VALUES (?,?,?)";
        $stmt = $connect->prepare($req);
        if(!$stmt){
            echo "erreur";
        }
        $stmt->bind_param("sss",$idP_Patient,$nomDocument, $targerdocpath);
        if ($stmt->execute()) {
            echo "Le document a été ajouté avec succès.";
        } else {
            echo "Erreur : Impossible d'enregistrer le document dans la base de données.";
        }
        $stmt->close();
    } else {
        echo "Erreur lors du telechargement du document.";
    }
}
?>

<?php
include '../../configuration/patient/headPatient.php';
?>
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="document" class="form-label">Choisissez un document</label>
    <input type="file" name="document" id="document" class="form-control" required >
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php include '../../configuration/patient/piedPatient.php';?>