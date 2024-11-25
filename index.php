<?php
include 'configuration/head.php';
?>
<h1>Bienvenue dans votre carnet de santé numerique</h1>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Se connecter
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item active" href="connPatient.php">Patient</a></li>
    <li><a class="dropdown-item" href="/connMed.php">Medecin</a></li>
  </ul>
</div>





<?php
include 'configuration/pied.php';
?>