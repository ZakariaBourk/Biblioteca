<?php
$reserves = $biblioteca->llistarReserves();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Reserves</title>
</head>
<body>

<h1>Reserves actives</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Material</th>
        <th>Tipus</th>
        <th>Usuari</th>
    </tr>

    <?php foreach ($reserves as $material): ?>
        <tr>
            <td><?= $material->getId() ?></td>
            <td><?= htmlspecialchars($material->getTitol()) ?></td>
            <td><?= $material->getTipus() ?></td>
            <td><?= htmlspecialchars($material->getUsuariReserva()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
