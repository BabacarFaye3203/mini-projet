<?php
session_start();
?>
<?php include '../configuration/head.php';?>
<h1>Page de connexion</h1>

<div class="container">
      <form method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email:</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">mot de passe</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="pwd">
        </div>
       
        <input type="submit" class="btn btn-primary" value="Connexion" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>






<?php include '../configuration/pied.php';?>