Carnet de Santé Numérique (CSN)

Description

Le Carnet de Santé Numérique (CSN) est une plateforme digitale conçue pour simplifier et sécuriser la gestion des données médicales des patients. Ce projet académique vise à offrir une solution pratique permettant aux patients et aux professionnels de la santé de gérer efficacement les informations de santé, les rendez-vous médicaux et leur suivi.

Fonctionnalités principales
	•	Gestion des patients : Enregistrement et mise à jour des informations personnelles et médicales des patients.
	•	Prise de rendez-vous : Interface intuitive pour planifier des consultations médicales en ligne.
	•	Suivi médical : Historique des visites, prescriptions et traitements pour chaque patient.
	•	Notifications : Alertes pour les rendez-vous et rappels de suivi.
	•	Sécurité des données : Authentification utilisateur et gestion des accès.

Technologies utilisées

Le projet est développé en utilisant les technologies suivantes :
	•	Frontend : HTML, CSS, Bootstrap, JavaScript.
	•	Backend : PHP (natif) avec MySQL pour la gestion des données.
	•	Base de données : MySQL pour le stockage et l’organisation des informations.
	•	Outils : XAMPP/WAMP pour le serveur local, Git pour le contrôle de version.

Installation et configuration
	1.	Clonez ce dépôt sur votre machine locale :
 git clone 
 2.	Configurez votre serveur local (XAMPP ou WAMP).
	3.	Importez le fichier de base de données dans MySQL :
	•	Ouvrez phpMyAdmin.
	•	Créez une nouvelle base de données nommée csn.
	•	Importez le fichier csn.sql fourni dans le dossier /database.
	4.	Configurez le fichier connexion_db.php avec vos paramètres MySQL :
 <?php
$host = 'localhost';
$db = 'csn';
$user = 'root';
$password = '';
?>
5.	Accédez au projet via votre navigateur en ouvrant :
http://localhost/csn-projet.

Contribution

Les contributions sont les bienvenues ! Si vous souhaitez participer :
	1.	Forkez le projet.
	2.	Créez une branche pour vos modifications :
 git checkout -b feature/ma-nouvelle-fonctionnalite

 3.	Envoyez une pull request après vos modifications.

Équipe de développement
	•	Babacar Faye : Chef de projet et développeur backend.
	•	Membres de l’équipe : [Ajoutez les noms des autres membres].

Licence

Ce projet est sous licence MIT. Consultez le fichier LICENSE pour plus d’informations.

Contact

Pour toute question ou suggestion, veuillez contacter :
Babacar Faye
	•	Email : bf322003@gmail.com
	•	GitHub : @babacar faye
