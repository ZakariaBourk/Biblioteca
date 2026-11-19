<?php
$prestecs = $biblioteca->llistarPrestecsActius();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Préstecs</title>
</head>
<body>

<h1>Préstecs actius</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>Material</th>
        <th>Usuari</th>
        <th>Data préstec</th>
        <th>Dies pendents</th>
        <th>Estat</th>
        <th>Multa</th>
        <th>Acció</th>
    </tr>

    <?php foreach ($prestecs as $prestec): ?>
        <tr>
            <td><?= htmlspecialchars($prestec->getMaterial()->getTitol()) ?></td>
            <td><?= htmlspecialchars($prestec->getUsuari()->getNom()) ?></td>
            <td><?= $prestec->getDataPrestec()->format('d/m/Y') ?></td>
            <td><?= $prestec->getDiesPendents() ?></td>
            <td>
                <?= $prestec->estaVencut() ? 'VENÇUT' : 'En termini' ?>
            </td>
            <td><?= number_format($prestec->calcularMulta(), 2) ?> €</td>
            <td>
                <a href="index.php?page=retorn&material_id=<?= $prestec->getMaterial()->getId() ?>">
                    Retornar
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
