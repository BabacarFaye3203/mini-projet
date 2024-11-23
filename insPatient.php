<?php
session_start();
 @include 'database/connexion_db.php';
 @include 'database/table.php';
 @include 'database/DatabaseCreat.php';
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
        if(!preg_match("#^[a-zA-Z0-9]+@{1}[a-zA-Z0-9]+\.{1}[a-ZA-Z]{2,3}#",$_POST["email"])){
          echo"email invalide";
        }else{
          $email=$_POST["email"];
        }
        header("location:connPatient.php");
        exit;
    }
  }
?>
<?php 
include 'configuration/head.php'; ?>
<h3>Inscription du paient</h3>
    <br><br>
    <div class="container">
      <form action="" method="POST">
        <div class="mb-3">
          <label for="ecin" class="form-label">cin</label>
          <input type="text" class="form-control" name="cin">
        </div>
        <div class="mb-3">
          <label for="nom" class="form-label">nom</label>
          <input type="text" class="form-control" name="idpatient">
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">prenom</label>
          <input type="text" class="form-control"  name="prenom">
        </div>
        <div class="mb-3">
          <label for="adresse" class="form-label">adresse</label>
          <input type="text" class="form-control"  name="adresse">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3">
          <label for="pays" class="form-label">pays</label>
          <input type="text" class="form-control" name="pays">
        </div>
        <div class="mb-3">
          <label for="ville" class="form-label">ville</label>
          <input type="text" class="form-control" name="ville">
        </div>
        <div class="mb-3">
          <label for="gsang" class="form-label">gsang</label>
          <input type="text" class="form-control" name="gsang">
        </div>
        <div class="mb-3">
          <label for="matrimonialle" class="form-label">situation matrimoniale</label>
          <input type="text" class="form-control" name="matri">
        </div>
        <div class="mb-3">
          <label for="profession" class="form-label">profession</label>
          <input type="text" class="form-control"  name="profession">
        </div>
        <div class="mb-3">
          <label for="statut" class="form-label">statut</label>
          <input type="text" class="form-control"  name="statut">
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">age</label>
          <input type="text" class="form-control"  name="age">
        </div>
        <div class="mb-3">
          <label for="sexe" class="form-label">sexe</label>
          <input type="text" class="form-control"  name="sexe">
        </div>
        <div class="mb-3">
          <label for="poids" class="form-label">poids</label>
          <input type="text" class="form-control" name="poids">
        </div>
        <div class="mb-3">
          <label for="taille" class="form-label">taille</label>
          <input type="text" class="form-control"  name="taille">
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">contact</label>
          <input type="text" class="form-control"  name="contact">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Confirmez votre Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd">
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>
<?php
include 'configuration/pied.php';
?>