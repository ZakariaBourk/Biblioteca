<?php

$usuari = $biblioteca->cercarUsuari(1);

$usuari->afegirNotificacio('Notificació de prova');

$serialitzat = serialize($usuari);

$recuperat = unserialize($serialitzat);

$notificacions = $recuperat->obtenirNotificacions();

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Demo Serialization</title>
</head>
<body>

<h1>Demostració de serialització</h1>

<h2>Objecte serialitzat</h2>

<pre><?= htmlspecialchars($serialitzat) ?></pre>

<h2>Notificacions després de recuperar l'objecte</h2>

<?php if (empty($notificacions)): ?>

    <p>No hi ha notificacions. El mètode __wakeup() les ha reinicialitzat.</p>

<?php else: ?>

    <?php foreach ($notificacions as $notificacio): ?>
        <p><?= htmlspecialchars($notificacio) ?></p>
    <?php endforeach; ?>

<?php endif; ?>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
