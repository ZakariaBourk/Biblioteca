<?php
$estadistiques = $biblioteca->obtenirEstadistiques();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca Digital</title>
</head>
<body>

<h1>Biblioteca Digital</h1>

<nav>
    <a href="index.php">Inici</a> |
    <a href="index.php?page=materials">Materials</a> |
    <a href="index.php?page=usuaris">Usuaris</a> |
    <a href="index.php?page=prestecs">Préstecs</a> |
    <a href="index.php?page=reserves">Reserves</a> |
    <a href="index.php?page=estadistiques">Estadístiques</a> |
    <a href="index.php?page=auditoria">Auditoria</a>
</nav>

<hr>

<h2>Resum de la biblioteca</h2>

<ul>
    <li>Total materials: <?= $estadistiques['total'] ?></li>
    <li>Disponibles: <?= $estadistiques['disponibles'] ?></li>
    <li>Prestats: <?= $estadistiques['prestats'] ?></li>
    <li>Reservats: <?= $estadistiques['reservats'] ?></li>
    <li>Multes pendents: <?= number_format($estadistiques['multesPendents'], 2) ?> €</li>
</ul>

<p>
    <a href="index.php?page=reset">Reiniciar dades</a>
</p>

</body>
</html>
