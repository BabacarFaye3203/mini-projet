<?php
session_start();
if(isset($_POST["ok"])){
  if(!empty($_POST)){
    @$nom=$_POST["nom"];
    if($_POST["pwd"]==$_POST["cpwd"]){
      $pwd=$_POST["pwd"];
    }else{
      echo"les deux mdp doivent etre identiques";
      exit;
    }
    if(!preg_match("#^[a-zA-Z0-9]+@{1}[a-zA-Z0-9]+\.{1}[a-ZA-Z]{2,3}#",$_POST["email"])){
      echo"email invalide";
    }else{
      $email=$_POST["email"];
    }
    $_SESSION["autoriser"]="faux";
    header("location:connexion.php");

  }else{
    echo"toutes les pages doivent etre remplies";
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carnet-de-santé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
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
    <a class="navbar-brand" href="#">CSN</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.html">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mes Rendez-vous</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Mes documents</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  </header>
    <br><br>
    <div class="container">
      <form method="post">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">cin</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="cin">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">nom</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="idp">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">prenom</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="prenom">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">adresse</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="adr">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email">
        </div>

        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Confirmez votre Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd">
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>