<?php
$materials = $biblioteca->getMaterials();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Auditoria</title>
</head>
<body>

<h1>Historial d'auditoria</h1>

<?php foreach ($materials as $material): ?>

    <h2>
        <?= htmlspecialchars($material->getTitol()) ?>
    </h2>

    <?php $historial = $material->obtenirHistorial(); ?>

    <?php if (empty($historial)): ?>

        <p>Sense accions registrades.</p>

    <?php else: ?>

        <table border="1" cellpadding="8">
            <tr>
                <th>Data</th>
                <th>Acció</th>
                <th>Detalls</th>
            </tr>

            <?php foreach ($historial as $accio): ?>
                <tr>
                    <td><?= htmlspecialchars($accio['data']) ?></td>
                    <td><?= htmlspecialchars($accio['accio']) ?></td>
                    <td><?= htmlspecialchars($accio['detalls']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php endif; ?>

<?php endforeach; ?>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
