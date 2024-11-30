<?php
include 'database/DatabaseCreat.php';
$erreur="";
if(isset($_POST["ok"])){
    if(empty($_POST["nom"]) || empty($_POST["prenom"])||empty($_POST["email"])
        ||empty($_POST["adr"])||empty($_POST["pays"])||empty($_POST["ville"])
        ||empty($_POST["age"])||empty($_POST["sex"])
        ||empty($_POST['spe'])||empty($_POST["tel"])
        ||empty($_POST["pwd"])||empty($_POST["cpwd"])|| empty($_POST["cod"])){
        header("location:inscMedecin.php");
        $erreur="tous les champs doivent être remplis";
    }else{
        @$nom=$_POST["nom"];
        @$prenom=$_POST["prenom"];
        @$code=$_POST["cod"];
        @$pays=$_POST["pays"]; @$adresse=$_POST["adr"]; @$ville=$_POST["ville"];
        @$age=$_POST["age"]; @$sexe=$_POST["sex"];  @$contact=$_POST["tel"];
        @$specialite=$_POST['spe'];
        if($_POST["pwd"]==$_POST["cpwd"]){
            $pwd=$_POST["pwd"];
        }else{
            echo"les deux mdp doivent être identiques";
        }
        if(!preg_match("#^[a-zA-Z0-9]+@{1}[a-zA-Z0-9]+\.{1}[a-zA-Z]{2,3}#",$_POST["email"])){
            echo"email invalide";
        }else{
            $email=$_POST["email"];
        }
        $req1=("INSERT INTO medecin (nomM_Medecin, prenomM_Medecin, matriculeM_Medecin,
                     emailM_Medecin, adresseM_Medecin, paysM_Medecin,
                     villeM_Medecin, specialite_Medecin, contactM_Medecin,
                     age, sexe_Medecin, password) values (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stm=$connect->prepare($req1);
        $stm->bind_param("sssssssssiss",$nom,$prenom,$code,$email,$adresse,
            $pays,$ville,$specialite,$contact,$age,$sexe,$pwd);
        if($stm->execute()){
            echo "<script>alert('Inscription avec succès')</script>";
            header("Location:connMed.php");}
        else{echo "Désolé";}

    }
}

