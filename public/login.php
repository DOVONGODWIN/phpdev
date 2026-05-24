<?php
require_once __DIR__ . '/../src/Auth.php';

$message = '';
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth();
    [$success, $message] = $auth->login(
        $_POST['mail']     ?? '',
        $_POST['password'] ?? ''
    );
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php include __DIR__ . "/../src/partial/head.php"; ?>
<title>Connexion</title>
</head>
<body>
<main class="auth">
    <h1>Connexion</h1>
    <p class="lead">Heureux de vous revoir.</p>

    <form action="login.php" method="POST">
        <label for="mail">Email</label>
        <input type="email" id="mail" name="mail"
               value="<?php echo htmlspecialchars($_POST['mail'] ?? ''); ?>"
               placeholder="vous@exemple.com" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"
               placeholder="Votre mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <?php if ($message): ?>
        <p class="msg <?php echo $success ? 'msg-ok' : 'msg-err'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <p class="switch">Pas encore de compte ? <a href="register.php">Créer un compte</a></p>
</main>
<?php include __DIR__ . "/../src/partial/footer.php"; ?>
</body>
</html>