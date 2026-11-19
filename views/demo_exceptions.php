<?php

use App\Exceptions\MaterialNoTrobatException;
use App\Exceptions\MaterialNoDisponibleException;
use App\Exceptions\MaterialNoPrestatException;
use App\Exceptions\UsuariNoTrobatException;
use App\Exceptions\EmailInvalidException;

$errors = [];

try {
    $biblioteca->prestarMaterial(999, 1);
} catch (MaterialNoTrobatException $e) {
    $errors[] = $e->getMessage();
}

try {
    $biblioteca->prestarMaterial(2, 3);
} catch (MaterialNoDisponibleException $e) {
    $errors[] = (string) $e;
}

try {
    $biblioteca->retornarMaterial(4);
} catch (MaterialNoPrestatException $e) {
    $errors[] = $e->getMessage();
}

try {
    $biblioteca->prestarMaterial(3, 999);
} catch (UsuariNoTrobatException $e) {
    $errors[] = $e->getMessage();
}

try {
    new \App\Models\Usuari(99, 'Prova', 'correuincorrecte');
} catch (EmailInvalidException $e) {
    $errors[] = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Demo Exceptions</title>
</head>
<body>

<h1>Demostració d'excepcions</h1>

<?php foreach ($errors as $error): ?>

    <p><?= htmlspecialchars($error) ?></p>

<?php endforeach; ?>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
