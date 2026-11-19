<?php

$materialId = (int) ($_GET['material_id'] ?? 0);
$usuariId = (int) ($_GET['usuari_id'] ?? 0);

$biblioteca->reservarMaterial($materialId, $usuariId);

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Reserva</title>
</head>
<body>

<h1>Reserva realitzada correctament</h1>

<p>El material s'ha reservat correctament.</p>

<a href="index.php?page=reserves">Veure reserves</a>

</body>
</html>
