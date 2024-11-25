<?php
session_start();
include 'database/DatabaseCreat.php'; //connexion à la base
  if (isset($_POST["ok"])){
    $email = $_POST['email'];
    $pwd= $_POST['pwd'];
    $stm="SELECT * FROM `patient` WHERE `emailP`=$email AND `password`=$pwd";
    $res=mysqli_query($connect,$stm);
    if($res){
      echo"selection avec succes";
    }else{

      echo "erreur de selection";}
    while($rows=mysqli_fetch_assoc($res)) {
      @$_SESSION['idP_Patient'] = $rows['idP_Patient'];
      @$_SESSION['nomP_Patient'] = $rows['nomP_Patient'];
      header("Location:Patient/profilPatient.php"); // Redirection vers le profil du patient
      exit();
  }
 
}
?>
<?php
include 'configuration/head.php';?>
<h3>Connexion en tant que patient</h3><br>
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    S'inscrire
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="insPatient.php">Oui, je suis Sur</a></li>
  </ul>
</div>

    <br><br>
    <div class="container">
      <form method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" name="pwd">
        </div>

        <input type="submit" class="btn btn-primary" value="je me connecte" name="ok">
      </form>
    </div>
<?php include 'configuration/pied.php';?>
