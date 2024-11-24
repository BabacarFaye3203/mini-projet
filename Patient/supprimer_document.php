<?php
// inclusion de la Connexion à la base de données
include '../database/connexion_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);

    // Récupérer le chemin du fichier depuis la base de données
    $stmt = $connect->prepare("SELECT chemin FROM documents WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($filePath);
    if ($stmt->fetch()) {
        // Supprimer le fichier du serveur
        if (unlink($filePath)) {
            // Supprimer l'entrée de la base de données
            $stmt->close();
            $stmt = $connect->prepare("DELETE FROM documents WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "Le document a été supprimé avec succès.";
            } else {
                echo "Erreur : Impossible de supprimer le fichier de la base de données.";
            }
        } else {
            echo "Erreur : Impossible de supprimer le fichier du serveur.";
        }
    } else {
        echo "Document introuvable.";
    }
    $stmt->close();
}
?>
<?php include '../configuration/head.php';?>

<form action="" method="post">
  <div class="mb-3">
    <label for="id" class="form-label">ID du document que vous voulez supprimer:</label>
    <input type="number" class="form-control"  name="id" required>
  </div>
  <button type="submit" class="btn btn-primary">Supprimer le document</button>
</form>

<?php include '../configuration/pied.php';?>
