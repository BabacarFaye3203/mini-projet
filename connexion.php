<?php
session_start();
if($_SESSION["connection"]!="oui"){
    echo"veuillez d abord vous inscrire";
    header("location:Patient/insPatient.php");
    exit;
}else{
    header("profilpatient.php");
}
?>
<?php include 'configuration/head.php';?>
    <br><br>
    <div class="container">
      <form method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
        </div>

        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
      </form>
    </div>
<?php include 'configuration/pied.php';?>