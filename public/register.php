<?php
require_once __DIR__ . '/../src/Auth.php';

$message = '';
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth();
    [$success, $message] = $auth->register(
        $_POST['nom']      ?? '',
        $_POST['mail']     ?? '',
        $_POST['password'] ?? ''
    );
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<?php include __DIR__ . "/../src/partial/head.php"; ?>
<title>Créer un compte</title>
</head>
<body>
<main class="auth">
    <h1>Créer un compte</h1>
    <p class="lead">Quelques secondes suffisent.</p>

    <form action="register.php" method="POST">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom"
               value="<?php echo htmlspecialchars($_POST['nom'] ?? ''); ?>"
               placeholder="Votre nom" required>

        <label for="mail">Email</label>
        <input type="email" id="mail" name="mail"
               value="<?php echo htmlspecialchars($_POST['mail'] ?? ''); ?>"
               placeholder="vous@exemple.com" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password"
               placeholder="6 caractères minimum" required>

        <button type="submit">S'inscrire</button>
    </form>

    <?php if ($message): ?>
        <p class="msg <?php echo $success ? 'msg-ok' : 'msg-err'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <p class="switch">Déjà un compte ? <a href="login.php">Se connecter</a></p>
</main>
<?php include __DIR__ . "/../src/partial/footer.php"; ?>
</body>
</html>