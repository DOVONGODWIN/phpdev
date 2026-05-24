

<!DOCTYPE html>
<html lang="en">
    <head>
<?php
header('Location: login.php');
exit;
include "../src/partial/head.php";
require_once '../src/function.php';
$name = $_POST['name'] ?? '';
?>
<title>home</title>
</head>

<body>
<form action="#" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" placeholder="Enter your name" >
    <button type="submit">Greet</button>
</form>
<?php if (!empty($name)): ?>
    <p><?php echo htmlspecialchars(greet($name)); ?></p>
    
<?php endif; ?>
<?php

$env = parse_ini_file(__DIR__ . '/../.env');
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}
require_once __DIR__ . '/../src/services/database.php';


$pdo = Database::getConnection();
echo "✅ Connecté à la base de données !";
 ?>

</body>
</html>