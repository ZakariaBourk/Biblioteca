<?php

$materialId = (int) ($_GET['material_id'] ?? 0);
$usuariId = (int) ($_GET['usuari_id'] ?? 0);

$prestec = $biblioteca->prestarMaterial($materialId, $usuariId);

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Préstec realitzat</title>
</head>
<body>

<h1>Préstec realitzat correctament</h1>

<p>
    Material: <?= htmlspecialchars($prestec->getMaterial()->getTitol()) ?>
</p>

<p>
    Usuari: <?= htmlspecialchars($prestec->getUsuari()->getNom()) ?>
</p>

<a href="index.php?page=materials">Tornar als materials</a>

</body>
</html>
