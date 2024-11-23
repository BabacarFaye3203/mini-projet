<?php
session_start();

include 'configuration/head.php';?>
<h3>Connexion</h3><br>
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

        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
      </form>
    </div>
<?php include 'configuration/pied.php';?>
