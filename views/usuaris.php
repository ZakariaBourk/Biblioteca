<?php
$usuaris = $biblioteca->getUsuaris();
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Usuaris</title>
</head>
<body>

<h1>Usuaris de la biblioteca</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Préstecs actius</th>
        <th>Accions</th>
    </tr>

    <?php foreach ($usuaris as $usuari): ?>
        <tr>
            <td><?= $usuari->getId() ?></td>
            <td><?= htmlspecialchars($usuari->getNom()) ?></td>
            <td><?= htmlspecialchars($usuari->getEmail()) ?></td>
            <td><?= $usuari->getNumeroMaterialsPrestats() ?></td>
            <td>
                <a href="index.php?page=usuari&id=<?= $usuari->getId() ?>">
                    Veure perfil
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
