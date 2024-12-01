<?php
 include 'database/DatabaseCreat.php';
 $erreur="";
 if(isset($_POST["ok"])){
     if(empty($_POST["cin"]) || empty($_POST["nom"]) || empty($_POST["prenom"])||empty($_POST["email"])||empty($_POST["adresse"])||empty($_POST["pays"])||empty($_POST["ville"])||empty($_POST["gsang"])||empty($_POST["matri"])||empty($_POST["profession"])||empty($_POST["statut"])||empty($_POST["age"])||empty($_POST["sexe"])||empty($_POST["poids"])||empty($_POST["taille"])||empty($_POST["contact"])||empty($_POST["pwd"])||empty($_POST["cpwd"])){
       header("location:insPatient.php");
       $erreur="tous les champs doivent être remplis";
     }else{
         @$nom=$_POST["nom"];
         @$prenom=$_POST["prenom"];
         @$cin=$_POST["cin"];
         @$pays=$_POST["pays"]; @$adresse=$_POST["adresse"];
         @$ville=$_POST["ville"]; @$gsang=$_POST["gsang"]; @$matricule=$_POST["matri"];
         @$profession=$_POST["profession"]; @$statut=$_POST["statut"]; @$age=$_POST["age"];
         @$sexe=$_POST["sexe"]; @$poids=$_POST["poids"]; @$taille=$_POST["taille"];
         @$contact=$_POST["contact"];
         if($_POST["pwd"]==$_POST["cpwd"]){
           $pwd=$_POST["pwd"];
             $email=$_POST["email"];
         }else{
           echo"les deux mdp doivent etre identiques";
           
         }
         if(!preg_match("#^[a-zA-Z0-9]+@{1}[a-zA-Z0-9]+\.{1}[a-zA-Z]{2,3}#",$_POST["email"])){
           echo"email invalide";
         }else{
           $email=$_POST["email"];
         }
         $req1=("INSERT INTO patient (nomP_Patient,prenomP,adresseP,emailP,paysP,
                     villeP,groupe_sanguin_Patient,
    situation_matri_Patient,profession_Patient,
                     statut_Patient,ageP,sexeP,poids_Patient,
taille_Patient,contactP,CIN_Patient,password) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
         $stm=$connect->prepare($req1);
         $stm->bind_param("ssssssssssssddiss",$nom,$prenom,$adresse,$email,$pays,
             $ville,$gsang,$matricule,$profession,$statut,$age,$sexe,
             $poids,$taille,$contact,$cin,$pwd);
        if($stm->execute()){//cho "Inscription avec succes";
            header("Location:connPatient.php");}
        else{echo "Desole";}

     }
   }

