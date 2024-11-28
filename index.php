<?php include 'configuration/headindex.php'
?>


<div class="dropdown" class="container" id="logid">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Se connecter
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php" id="connbutton">Patient</a></li>
    <li><a class="dropdown-item" href="connMed.php">Medecin</a></li>
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



<!-- avis des utilisateurs(patients et medecins)-->




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
            Ce carnet numérique vise à améliorer la qualité des soins de santé en offrant une vision complète et accessible de l'historique médical d'un patient. Il est également conçu pour être facile à utiliser, avec des fonctionnalités adaptées aux besoins des patients et des professionnels de santé. En plus des informations de santé, le carnet inclura des rappels pour les traitements à suivre et les examens à réaliser. Il s'agit d'une véritable révolution dans la gestion de la santé, qui va au-delà du simple stockage d'informations médicales pour offrir une solution complète et pratique.
        </p>
        
        <p>
          <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#extraText" aria-expanded="false" aria-controls="extraText" id="voirplus">Voir plus</button>
        </p>
        <div class="collapse" id="extraText">
          
          <p>
            Ce carnet numérique permet aussi de centraliser les informations provenant de différents professionnels de santé. Les patients peuvent facilement partager leurs données médicales avec plusieurs médecins ou spécialistes, améliorant ainsi la coordination des soins. Il favorise la dématérialisation des dossiers médicaux et offre une vue d'ensemble sur les traitements reçus, les prescriptions effectuées, et même les analyses de laboratoire. Le carnet peut également être relié à des appareils médicaux connectés pour suivre en temps réel des paramètres vitaux comme la tension artérielle, le rythme cardiaque, ou le taux de glucose, offrant ainsi une surveillance continue.
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

. <code>.accordion-flush</code></div>
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
    <h2 class="accordion-header" id="flush-headingThree">
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

  <div class="container overflow-hidden">
    <div class="row gy-4 gy-md-0 gx-xxl-5" >
      <div class="col-12 col-md-4" >
 
        <div class="card border-0 border-bottom border-primary shadow-sm" id="temoig">
          <div class="card-body p-4 p-xxl-5">
            <figure>
            <img class="img-fluid rounded rounded-circle mb-4 border border-5" loading="lazy"  src="images/WhatsApp Image 2024-11-27 at 21.37.58.jpeg" alt="Felix">
              <figcaption>
                <div class="bsb-ratings text-warning mb-3" data-bsb-star="4" data-bsb-star-off="1"></div>
                <blockquote class="bsb-blockquote-icon mb-4">"En tant que patient souffrant d'une maladie chronique, 
          ce site est une bénédiction pour moi.
           Mon médecin peut suivre mon état de santé à distance 
           et ajuster mon traitement sans que je me déplace constamment.
            La messagerie sécurisée est parfaite pour poser mes questions entre deux consultations.
           Je recommande vivement ce service.</blockquote>
                <h4 class="mb-2">Felix Ngamakita</h4>
                <h5 class="fs-6 text-secondary mb-0">Etudiant en <b>Informatique</b> <br>Maroc</h5>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4" >
      <div class="card border-0 border-bottom border-primary shadow-sm" id="temoig">
          <div class="card-body p-4 p-xxl-5">
            <figure>
            <img class="img-fluid rounded rounded-circle mb-4 border border-5" loading="lazy"  src="images/WhatsApp Image 2024-11-16 at 16.07.00 (1).jpeg" alt="Babacar">
              <figcaption>
                <div class="bsb-ratings text-warning mb-3" data-bsb-star="5" data-bsb-star-off="0"></div>
                <blockquote class="bsb-blockquote-icon mb-4">"J’ai découvert cette plateforme récemment,
           et je dois dire qu’elle est très intuitive.
            Trouver un spécialiste dans ma ville est devenu facile,
             et le système de visioconférence m’a sauvé plusieurs fois quand je n’ai pas pu me déplacer.
           Merci pour cette initiative qui rend la santé plus accessible à tous !"</blockquote>
                <h4 class="mb-2">Babacar</h4>
                <h5 class="fs-6 text-secondary mb-0">Etudiant en <b>Informatique</b> <br>Maroc</h5>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4" >
        <div class="card border-0 border-bottom border-primary shadow-sm" id="temoig">
          <div class="card-body p-4 p-xxl-5">
            <figure>
            <img class="img-fluid rounded rounded-circle mb-4 border border-5 "  loading="lazy" src="images/WhatsApp Image 2024-11-27 at 21.46.47.jpeg" alt="Emmanuel">
              <figcaption>
                <div class="bsb-ratings text-warning mb-3" data-bsb-star="5" data-bsb-star-off="0"></div>
                <blockquote class="bsb-blockquote-icon mb-4">"J'utilise le Carnet de Santé Numérique depuis quelques mois, 
            et je suis ravie de cette solution. J’ai pu centraliser tous mes résultats d’examens médicaux et 
            mes ordonnances en un seul endroit. En plus, la prise de rendez-vous est super simple, 
            et je n’ai plus besoin de passer des heures au téléphone avec les cabinets médicaux.
             Un vrai gain de temps et d’efficacité !"</blockquote>
                <h4 class="mb-2">Emmanuel</h4>
                <h5 class="fs-6 text-secondary mb-0">Etudiant en <b>informatique</b> <br>Maroc</h5>
              </figcaption>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- fin de la section avis-->

<!-- section contact-->
<section id="contact" class="py-5 contact-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Contactez-nous</h2>
            <p class="text-muted">Pour toute question ou assistance, CSN consacre une  équipe dediée à votre disposition.</p>
        </div>
        <div class="row">
            <!-- Formulaire pou nous contacter  -->
  <section id="contact" class="py-5 bg-light">
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



<!--footer -->
<section>
<div class="container" id="fotpieds">
  <footer class="" >
    <div class="row" >
      <div class="col-6 col-md-2 mb-3" >
        <h5>Redirigez-vous!</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#logid" class="nav-link p-0 text-body-secondary">Accueil</a></li>
          <li class="nav-item mb-2"><a href="#temoignage" class="nav-link p-0 text-body-secondary">Temoignages</a></li>
          <li class="nav-item mb-2"><a href="#contact" class="nav-link p-0 text-body-secondary">Nous Contacter</a></li>
          <li class="nav-item mb-2"><a href="#FAQ" class="nav-link p-0 text-body-secondary">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#About" class="nav-link p-0 text-body-secondary">A Propos</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Notre Devise</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-body-secondary">Effort</a></li>
          <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-body-secondary">Discipline</a></li>
          <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-body-secondary">Rigueur</a></li>
          <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-body-secondary">Disponibles</a></li>
          <li class="nav-item mb-2"><a href="" class="nav-link p-0 text-body-secondary">Santé</a></li>
        </ul>
      </div>
      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Chokran!</h5>
          <p>CSN Vous Remercie pour votre Visite !</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <button class="btn btn-primary" type="button" id="footerbutton"><a href="contact.php" id="prenezcontact">Prenez Contact avec notre equipe</a></button>
          </div>
        </form>
      </div>
      <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text"> Votre <b>Santé</b>, notre <b>Fierté!</b> </p>
    <a href="insPatient.php" class="btn btn-primary" id="sinscfooter">S'inscrire</a>
  </div>
  <div>
      <p class="float-end" ><a href="#" id="verslehaut">Retour vers le haut</a></p>
    </div>
  </footer>
</div>
</section>
 
<?php

 include 'configuration/piedindex.php';
?>