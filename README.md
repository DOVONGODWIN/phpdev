phpdev — Système d'inscription et de connexion
Petit projet PHP en programmation orientée objet : inscription de visiteurs,
connexion sécurisée et gestion de session. Mots de passe hachés, requêtes
préparées contre les injections SQL.
Stack technique

PHP 8+ (mysqli)
MySQL / MariaDB
Serveur local : XAMPP

Structure du projet
mds-site/
├── .env                      # config (NON versionné — voir .env.example)
├── .htaccess
├── public/                   # racine web (DocumentRoot)
│   ├── index.php             # redirige vers login.php
│   ├── login.php             # page de connexion
│   ├── register.php          # page de création de compte
│   └── assets/
│       ├── css/style.css     # styles (dont le bloc .auth)
│       ├── js/
│       ├── fonts/
│       └── images/
└── src/
    ├── Auth.php              # logique inscription / connexion (classe Auth)
    ├── function.php
    ├── partial/
    │   ├── head.php          # <head> commun (charge le CSS)
    │   └── footer.php
    └── services/
        └── database.php      # connexion mysqli (fonction connexionDB)
Base de données
Nom de la base : phpexo_db
Table visiteur
ColonneTypeContraintesDescriptionidINTPRIMARY KEY, AUTO_INCREMENTIdentifiant unique du visiteurnomVARCHAR(255)NOT NULLNom du visiteurmailVARCHAR(255)NOT NULL, UNIQUEEmail (sert d'identifiant de connexion)passwordVARCHAR(255)NOT NULLMot de passe haché (bcrypt, ~60 car.)

Le champ password stocke un hash généré par password_hash(), jamais
le mot de passe en clair. Il commence par $2y$. La longueur 255 laisse de
la marge pour les futurs algorithmes de hachage.

Script de création
sqlCREATE TABLE visiteur (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    nom      VARCHAR(255) NOT NULL,
    mail     VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
Installation

Cloner le dépôt dans le dossier servi par XAMPP.
Créer la base phpexo_db et la table visiteur (script SQL ci-dessus).
Copier .env.example en .env et renseigner les identifiants de la base.
Démarrer Apache et MySQL depuis le panneau XAMPP.
Ouvrir la page de connexion dans le navigateur.

Configuration (.env)
Le fichier .env n'est pas versionné (il contient des identifiants).
Crée-le à partir de ce modèle :
iniDB_HOST=localhost
DB_PORT=3306
DB_NAME=phpexo_db
DB_USER=root
DB_PASS=
Fonctionnement

register.php : crée un compte (nom + email + mot de passe), puis connecte
directement la personne.
login.php : vérifie l'email et le mot de passe, ouvre la session.
La logique est centralisée dans la classe Auth (src/Auth.php), qui
s'appuie sur la connexion connexionDB() de src/services/database.php.

Sécurité

Mots de passe hachés avec password_hash() / vérifiés avec password_verify().
Requêtes SQL préparées (mysqli_prepare + bind_param).
session_regenerate_id() à la connexion contre le détournement de session.
Message d'erreur identique que l'email existe ou non (ne révèle pas les comptes).