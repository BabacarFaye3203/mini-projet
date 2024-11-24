<?php
session_start();
 include '../database/connexion_db.php';

 $erreur="";
if(isset($_POST["ok"])){
    if(empty($_POST["cin"]) || empty($_POST["nom"]) || empty($_POST["prenom"])||empty($_POST["email"])||empty($_POST["adresse"])||empty($_POST["pays"])||empty($_POST["ville"])||empty($_POST["gsang"])||empty($_POST["matri"])||empty($_POST["profession"])||empty($_POST["statut"])||empty($_POST["age"])||empty($_POST["sexe"])||empty($_POST["poids"])||empty($_POST["taille"])||empty($_POST["contact"])||empty($_POST["pwd"])||empty($_POST["cpwd"])){
      header("location:insPatient.php");
      $erreur="tous les champs doivent etre remplis";
    }else{
        @$nom=$_POST["nom"];
        @$prenom=$_POST["prenom"];
        @$cin=$_POST["cin"];
        @$pays=$_POST["pays"]; @$adresse=$_POST["adresse"]; @$ville=$_POST["ville"]; @$gsang=$_POST["gsang"]; @$matricule=$_POST["matri"]; @$profession=$_POST["profession"]; @$statut=$_POST["statut"]; @$age=$_POST["age"]; @$sexe=$_POST["sexe"]; @$poids=$_POST["poids"]; @$taille=$_POST["taille"]; @$contact=$_POST["contact"];
  
        if($_POST["pwd"]==$_POST["cpwd"]){
          $pwd=$_POST["pwd"];
        }else{
          echo"les deux mdp doivent etre identiques";
          
        }
        if(!preg_match("#^[a-zA-Z0-9]+@{1}[a-zA-Z0-9]+\.{1}[a-ZA-Z]{2,3}$#",$_POST["email"])){
          echo"email invalide";
        }else{
          $email=$_POST["email"];
        }
        $_SESSION["autosiser_connexion"]="oui";
        header("location:connexion.php");
        exit;
    }
  }
  ?>
<?php
include 'insPatient.php';