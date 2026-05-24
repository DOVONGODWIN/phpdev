<?php

require_once __DIR__ . '/services/database.php';


class Auth
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = connexionDB();
    }

 
    public function register(string $nom, string $mail, string $password): array
    {
        $nom  = trim($nom);
        $mail = trim($mail);

        if ($nom === '' || $mail === '' || $password === '') {
            return [false, 'Tous les champs sont obligatoires.'];
        }
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            return [false, 'Adresse email invalide.'];
        }
        if (strlen($password) < 6) {
            return [false, 'Le mot de passe doit faire au moins 6 caractères.'];
        }
        if ($this->findByMail($mail) !== null) {
            return [false, 'Cet email est déjà utilisé.'];
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare(
            $this->db,
            'INSERT INTO visiteur (nom, mail, password) VALUES (?, ?, ?)'
        );
        mysqli_stmt_bind_param($stmt, 'sss', $nom, $mail, $hash);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $this->startSessionFor($nom, $mail);

        return [true, "Bonjour $nom.visiteur, vous venez de vous connecter."];
    }


    public function login(string $mail, string $password): array
    {
        $mail = trim($mail);
        $user = $this->findByMail($mail);

        if ($user === null || !password_verify($password, $user['password'])) {
            return [false, 'Email ou mot de passe incorrect.'];
        }

        $this->startSessionFor($user['nom'], $user['mail']);

        return [true, "Bonjour {$user['nom']}.visiteur, vous venez de vous connecter."];
    }

    
    private function findByMail(string $mail): ?array
    {
        $stmt = mysqli_prepare(
            $this->db,
            'SELECT id, nom, mail, password FROM visiteur WHERE mail = ? LIMIT 1'
        );
        mysqli_stmt_bind_param($stmt, 's', $mail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        return $row ?: null;
    }

    private function startSessionFor(string $nom, string $mail): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_regenerate_id(true);
        $_SESSION['nom']  = $nom;
        $_SESSION['mail'] = $mail;
    }
}