<?php

$materialId = (int) ($_GET['material_id'] ?? 0);

$multa = $biblioteca->retornarMaterial($materialId);

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Retorn</title>
</head>
<body>

<h1>Material retornat correctament</h1>

<p>Import de la multa: <?= number_format($multa, 2) ?> €</p>

<a href="index.php?page=prestecs">Tornar als préstecs</a>

</body>
</html>
