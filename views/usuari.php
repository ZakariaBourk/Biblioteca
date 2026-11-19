<?php
$id = (int) ($_GET['id'] ?? 0);
$usuari = $biblioteca->cercarUsuari($id);
$prestecs = $biblioteca->llistarPrestecsUsuari($id);
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Perfil usuari</title>
</head>
<body>

<h1>Perfil de l'usuari</h1>

<?php if ($usuari === null): ?>

    <p>Usuari no trobat.</p>

<?php else: ?>

    <p>Nom: <?= htmlspecialchars($usuari->getNom()) ?></p>
    <p>Email: <?= htmlspecialchars($usuari->getEmail()) ?></p>
    <p>Data de registre: <?= $usuari->getDataRegistre()->format('d/m/Y') ?></p>

    <h2>Préstecs</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>Material</th>
            <th>Data préstec</th>
            <th>Estat</th>
        </tr>

        <?php foreach ($prestecs as $prestec): ?>
            <tr>
                <td><?= htmlspecialchars($prestec->getMaterial()->getTitol()) ?></td>
                <td><?= $prestec->getDataPrestec()->format('d/m/Y') ?></td>
                <td>
                    <?= $prestec->estaActiu() ? 'Actiu' : 'Retornat' ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Notificacions</h2>

    <?php foreach ($usuari->obtenirNotificacions() as $notificacio): ?>
        <p><?= htmlspecialchars($notificacio) ?></p>
    <?php endforeach; ?>

<?php endif; ?>

<a href="index.php?page=usuaris">Tornar als usuaris</a>

</body>
</html>
