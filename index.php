
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="/docs/5.3/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>CSN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link rel="stylesheet" href="style.css">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="dart-sass/bootstrap/bootstrap.scss" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
<link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#712cf9">

  <link href="carousel.css" rel="stylesheet">
  </head>
  <body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
              id="bd-theme"
              type="button"
              aria-expanded="false"
              data-bs-toggle="dropdown"
              aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
          </button>
        </li>
      </ul>
    </div>
<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/CSN Contact.webp" alt="Logo CSN" class="logo-navbar">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse"  >
      <ul class="navbar-nav" id="navbarNav">
        <li class="nav-item"  >
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#temoig">Temoignages</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#About">A Propos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#FAQ">FAQ</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>

<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Se connecter
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Je me connecte</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
           Que vous soyez patient ou professionnel de santé,<br>
           Prenez le contrôle de votre santé dès aujourd’hui avec CSN, <br>votre compagnon numérique pour un bien-être optimal.

Accédez à vos données en toute simplicité, où que vous soyez !</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold"></button>
          <button type="button" class="btn btn-outline-light btn-lg px-4"></button>
        </div>
      </div>
    </div>
  </div>


 </section>

<!-- section a propos-->
 <section id="About">

 <div class="container mt-5">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <h2 class="text-center">À propos du Carnet de Santé Numérique</h2>
        <p>
          Le carnet de santé numérique (CSN) est une plateforme innovante qui centralise toutes les informations médicales importantes d'un patient de manière sécurisée et accessible. Ce carnet permet aux patients de suivre leurs antécédents médicaux, leurs prescriptions, et d'autres informations importantes liées à leur santé. En plus de cela, il facilite la gestion des soins de santé en permettant une communication fluide entre le patient et les professionnels de santé.
        </p>
        <p>
          Le système est conçu pour garantir la confidentialité et la sécurité des données des utilisateurs, tout en offrant une interface intuitive. Il permet également une meilleure gestion des traitements et des rendez-vous médicaux, ce qui peut améliorer la prise en charge globale des patients. Grâce à son accès en ligne, il offre une grande flexibilité pour consulter les informations médicales, même à distance.
        </p>
        <p>
            Ce carnet de santé numérique vise à améliorer la qualité des soins de santé en offrant une vision complète et accessible de l'historique médical d'un patient. Il est également conçu pour être facile à utiliser, avec des fonctionnalités adaptées aux besoins des patients et des professionnels de santé. En plus des informations de santé, le carnet inclura des rappels pour les traitements à suivre et les examens à réaliser. Il s'agit d'une véritable révolution dans la gestion de la santé, qui va au-delà du simple stockage d'informations médicales pour offrir une solution complète et pratique.
        </p>
        
        <p>
          <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#extraText" aria-expanded="false" aria-controls="extraText" id="voirplus">Voir plus</button>
        </p>
        <div class="collapse" id="extraText">
          
          <p>
            Il permet également de centraliser les informations provenant de différents professionnels de santé. Les patients peuvent facilement partager leurs données médicales avec plusieurs médecins ou spécialistes, améliorant ainsi la coordination des soins. Il favorise la dématérialisation des dossiers médicaux et offre une vue d'ensemble sur les traitements reçus, les prescriptions effectuées, et même les analyses de laboratoire. Le carnet peut également être relié à des appareils médicaux connectés pour suivre en temps réel des paramètres vitaux comme la tension artérielle, le rythme cardiaque, ou le taux de glucose, offrant ainsi une surveillance continue.
          </p>
        </div>
      </div>
    </div>
  </div>
 </section>



 <!-- section FAQ-->
  <br><br>
  <section class="container" id="FAQ">
  <h1>FAQ - Carnet de Santé Numérique (CSN)</h1>
  <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="fag">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
      Qu'est-ce que le Carnet de Santé Numérique (CSN) ?<code>.CSN</code>
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Le CSN est une application numérique qui permet aux utilisateurs de centraliser 
        et de gérer leurs informations médicales. L'objectif est de simplifier le suivi de la santé 
        et d'améliorer la communication entre les patients et les professionnels de santé. </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
      À qui s'adresse le CSN ?
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Le CSN s'adresse :

Aux particuliers souhaitant un suivi structuré de leur santé.
Aux professionnels de santé désirant accéder rapidement aux informations médicales de leurs patients. <code>.CSN</code>.</div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Quelles fonctionnalités propose le CSN ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Gestion des dossiers médicaux : Ajout et suivi des antécédents médicaux,
         ordonnances, vaccins, etc. <br>
Rappels : Notifications pour les rendez-vous médicaux et les prises de médicaments. <br>
Partage sécurisé : Transmission des données médicales à des professionnels autorisés. <code>.CSN</code></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Le CSN est-il sécurisé ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Oui. La sécurité des données personnelles et médicales est une priorité. 
        Les informations sont cryptées et accessibles uniquement aux utilisateurs autorisés.

. <code>.CSN</code></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Le projet est-il disponible au public ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Ce projet est actuellement un projet académique réalisé dans le cadre de nos études
         en informatique. Il a été conçu par : <br>

Babacar Faye <br>
Felix Plaisir Ngamakita <br>
Emmanuel Kant <br>
Il n'est pas encore déployé pour une utilisation publique.. <code>.CSN</code></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Quelles fonctionnalités propose le CSN ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Gestion des dossiers médicaux : Ajout et suivi des antécédents médicaux,
         ordonnances, vaccins, etc. <br>
Rappels : Notifications pour les rendez-vous médicaux et les prises de médicaments. <br>
Partage sécurisé : Transmission des données médicales à des professionnels autorisés. <code>.CSN</code></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="faqbi">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Comment contacter les développeurs du projet ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Pour toute question ou demande concernant le projet, vous pouvez nous contacter à l'adresse suivante : <br>
      [bf322003@gmail.com] <code>.CSN</code></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Pourquoi ce projet a-t-il été réalisé ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Ce projet a été développé dans le cadre d’un travail académique pour mettre en pratique nos
         compétences en développement logiciel, gestion de bases de données et sécurité informatique,
          tout en répondant à une problématique réelle 
        : la digitalisation des informations médicales. <code>.CSN</code></div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Quelles technologies ont été utilisées pour développer le CSN ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Le projet repose sur des technologies modernes et robustes : <br>

Frontend : HTML, CSS, JavaScript,bootstrap <br>
Backend : PHP, MySQL <br>
Sécurité : Cryptage des données pour protéger les informations sensibles <br>
Outils de développement : VSCODE, WAMPP, PhpMyAdmin,Eclipse, XAMPP, Git, Github. <code>.CSN</code></div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
      Ce projet peut-il être étendu ?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Oui, le projet a été conçu avec une architecture évolutive.
         Il peut intégrer des fonctionnalités supplémentaires comme :

La synchronisation avec des appareils de santé connectés (montres, tensiomètres). <br>
Des modules d’intelligence artificielle pour des recommandations personnalisées. <br>
Une application mobile dédiée. <code>.CSN</code></div>
    </div>
  </div>
</div>
</section>
 

 <!--section avis-->
 <br><br><br><br><br><br>
<div class="container overflow-hidden" >
    <div class="row gy-4 gy-md-0 gx-xxl-5" >
      <div class="text-center mb-4">
            <h2 class="fw-bold" id="titleAvis">CE QU'ILS PENSENT DE NOUS</h2>
            <p class="text-muted" id="temoig">Découvrez ce que les utilisateurs pensent  du CSN .</p>
</div>
<div class="container">

      
    <div class="card testimonial-card mt-2 mb-3">
      <div class="card-up aqua-gradient"></div>
      <div class="avatar mx-auto white">
        <img src="images/fadal.jpeg" class="rounded-circle img-fluid"
          alt="woman avatar">
      </div>
      <div class="card-body text-center">
        <h4 class="card-title font-weight-bold">Fadal</h4>
        <hr>
        <p><i class="fas fa-quote-left"></i>"En tant que patient souffrant d'une maladie chronique, <br>
          ce site est une bénédiction pour moi.<br>
           Mon médecin peut suivre mon état de santé à distance <br>
           et ajuster mon traitement sans que je me déplace constamment.<br>
            La messagerie sécurisée est parfaite pour poser mes questions entre deux consultations.<br>
           Je recommande vivement ce service."</p>
      </div>
    </div>
    
    <div class="container">
  
      
    <div class="card testimonial-card mt-2 mb-3">
      <div class="card-up aqua-gradient"></div>
      <div class="avatar mx-auto white">
        <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20%2831%29.jpg" class="rounded-circle img-fluid"
          alt="woman avatar">
      </div>
      <div class="card-body text-center">
        <h4 class="card-title font-weight-bold">Rosaline</h4>
        <hr>
        <p><i class="fas fa-quote-left"></i> "J’ai découvert cette plateforme récemment, <br>
           et je dois dire qu’elle est très intuitive.<br>
            Trouver un spécialiste dans ma ville est devenu facile,<br>
             et le système de visioconférence m’a sauvé plusieurs fois quand je n’ai pas pu me déplacer.<br>
           Merci pour cette initiative qui rend la santé plus accessible à tous !"</p>
      </div>
    </div>



<div class="container">
  
      
    <div class="card testimonial-card mt-2 mb-3">
      <div class="card-up aqua-gradient"></div>
      <div class="avatar mx-auto white">
        <img src="images/Thione.jpeg" class="rounded-circle img-fluid"
          alt="woman avatar">
      </div>
      <div class="card-body text-center">
        <h4 class="card-title font-weight-bold">Thione</h4>
        <hr>
        <p><i class="fas fa-quote-left"></i> "J'utilise le Carnet de Santé Numérique depuis quelques mois,<br>
            et je suis ravie de cette solution.<br> J’ai pu centraliser tous mes résultats d’examens médicaux <br>et 
            mes ordonnances en un seul endroit. En plus, la prise de rendez-vous est super simple, <br>
            et je n’ai plus besoin de passer des heures au téléphone avec les cabinets médicaux.<br>
             Un vrai gain de temps et d’efficacité !"</p>
      </div>
    </div>
<!-- section contact-->
<section id="contact" class="py-5 contact-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Contactez-nous</h2>
            <p class="text-muted">Pour toute question ou assistance, CSN consacre une  équipe dediée à votre disposition.</p>
        </div>
        <div class="row">
            <!-- Formulaire pou nous contacter  -->
  <section id="contact"  class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image symbolisant le contact -->
            <div class="col-lg-6 text-center mb-4 mb-lg-0">
                <img src="images/CSN Contact.webp" alt="contactez nous" class="img-fluid rounded-circle shadow">
            </div>
            <!-- Formulaire de contact -->
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4"></h2>
                <p class="text-muted mb-4">Notre equipe veillera a votre satisfaction</p>
                <form action="traitement_contact.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
                        <div class="invalid-feedback">Veuillez entrer votre nom.</div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Votre email" required>
                        <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Votre message" required></textarea>
                        <div class="invalid-feedback">Veuillez entrer votre message.</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>

</main>
<div class="allitem">
  <div class="blog-allof">
    <div class="img-date">
     <img src="icons/DALL·E 2024-11-29 21.44.22 - A standalone icon in a minimalist flat design style_ an interconnected network of medical files, symbolizing the centralization of medical data. The i.webp" id="ic">
     <br><br><br><br><br>
    </div>
   <div class="discretion-blog">
      <h3 id="iconTitle">Centralisation des données médicales</h3>
     <p>Offrir une plateforme unique pour regrouper et consulter les informations médicales des patients en toute simplicité..</p>
    </div>
   </div>
</div>
<div class="allitem">
  <div class="blog-allof">
    <div class="img-date">
     <img src="icons/calicon.jpg">    
    </div>
    <div class="discretion-blog">
    <h3 id="iconTitle">Amélioration du suivi médical</h3>
    <p>Permettre un suivi précis et continu grâce à un accès rapide et sécurisé à l’historique de santé..</p>
    </div>
  </div>
</div>
    
<div class="allitem">
  <div class="blog-allof">
    <div class="img-date">
      <img  src=" icons/deuxIcons.jpg" >
                                    
    </div>
    <div class="discretion-blog">
    <h3 id="iconTitle">Facilitation de la collaboration médicale</h3>
    <p>Favoriser l’échange d’informations entre les patients et les professionnels de santé pour une prise en charge optimale..</p>
     </div>
  </div>
</div>
</section>
<div class="container my-5 text-center">
    <h2 class="mb-4" id="devs">Équipe de Développement - CSN</h2>
    <div class="d-flex flex-column align-items-center">
        <!-- Développeur 1 -->
        <div class="mb-5">
            <img src="images/WhatsApp Image 2024-11-16 at 16.07.00 (1).jpeg" alt="Photo du développeur 1" 
                 class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            <h5 class="fw-bold">Babacar Faye</h5>
            <p class="mb-1">Etudiant en  Informatique</p>
            <p>Université Sultan Moulay Slimane</p>
        </div>
        <!-- Développeur 2 -->
        <div class="mb-5">
            <img src="images/WhatsApp Image 2024-11-27 at 21.37.58.jpeg" alt="Photo du développeur 2" 
                 class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            <h5 class="fw-bold">Felix Plaisir Ngamakita</h5>
            <p class="mb-1">Etudiant en  Informatique</p>
            <p>Université Sultan Moulay Slimane</p>
        </div>
        <!-- Développeur 3 -->
        <div class="mb-5">
            <img src="images/WhatsApp Image 2024-11-27 at 21.46.47.jpeg" alt="Photo du développeur 3" 
                 class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
            <h5 class="fw-bold">Emmanuel Kant</h5>
            <p class="mb-1">Etudiant en  Informatique</p>
            <p>Université Sultan Moulay Slimane</p>
        </div>
    </div>
</div>

<!--footer -->

<?php
include 'configuration/footer.php';
 include 'configuration/piedindex.php';
?>