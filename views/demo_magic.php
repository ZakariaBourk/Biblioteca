<?php

$material = $biblioteca->cercarPerId(1);

$usuari = $biblioteca->cercarUsuari(1);

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Demo Magic</title>
</head>
<body>

<h1>Demostració de mètodes màgics</h1>

<h2>__toString()</h2>

<p><?= htmlspecialchars((string) $material) ?></p>

<p><?= htmlspecialchars((string) $usuari) ?></p>

<h2>__call()</h2>

<h3>Llibres</h3>

<?php foreach ($biblioteca->getLlibres() as $llibre): ?>
    <p><?= htmlspecialchars($llibre->getTitol()) ?></p>
<?php endforeach; ?>

<h2>__get()</h2>

<p>Nom de l'usuari: <?= htmlspecialchars($usuari->nom) ?></p>

<p>Email: <?= htmlspecialchars($usuari->email) ?></p>

<h2>__set()</h2>

<?php
try {
    $usuari->email = 'nouemail@mail.com';

    echo '<p>Email modificat correctament.</p>';

    $usuari->nom = 'Un altre nom';

} catch (\Exception $e) {
    echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
