<?php
$estadistiques = $biblioteca->obtenirEstadistiques();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Estadístiques</title>
</head>
<body>

<h1>Estadístiques de la biblioteca</h1>

<h2>Resum general</h2>

<ul>
    <li>Total: <?= $estadistiques['total'] ?></li>
    <li>Disponibles: <?= $estadistiques['disponibles'] ?></li>
    <li>Prestats: <?= $estadistiques['prestats'] ?></li>
    <li>Reservats: <?= $estadistiques['reservats'] ?></li>
    <li>Multes pendents: <?= number_format($estadistiques['multesPendents'], 2) ?> €</li>
</ul>

<h2>Materials per tipus</h2>

<ul>
    <?php foreach ($estadistiques['perTipus'] as $tipus => $quantitat): ?>
        <li><?= htmlspecialchars($tipus) ?>: <?= $quantitat ?></li>
    <?php endforeach; ?>
</ul>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
