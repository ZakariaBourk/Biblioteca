<?php
$id = (int) ($_GET['id'] ?? 0);
$material = $biblioteca->cercarPerId($id);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Detall material</title>
</head>
<body>

<h1>Detall del material</h1>

<?php if ($material === null): ?>

    <p>Material no trobat.</p>

<?php else: ?>

    <p><?= htmlspecialchars((string) $material) ?></p>

    <?php if ($material instanceof \App\Models\Llibre): ?>
        <p>Pàgines: <?= $material->getNumeroPagines() ?></p>
    <?php elseif ($material instanceof \App\Models\Revista): ?>
        <p>Edició: <?= $material->getNumeroEdicio() ?></p>
    <?php elseif ($material instanceof \App\Models\DVD): ?>
        <p>Duració: <?= $material->getDuracioFormatada() ?></p>
    <?php endif; ?>

    <h2>Historial d'auditoria</h2>

    <ul>
        <?php foreach ($material->obtenirHistorial() as $accio): ?>
            <li>
                <?= htmlspecialchars($accio['data']) ?> -
                <?= htmlspecialchars($accio['accio']) ?> -
                <?= htmlspecialchars($accio['detalls']) ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>

<a href="index.php?page=materials">Tornar als materials</a>

</body>
</html>
