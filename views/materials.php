<?php
$tipus = $_GET['type'] ?? '';

$materials = match ($tipus) {
    'llibre' => $biblioteca->getLlibres(),
    'revista' => $biblioteca->getRevistes(),
    'dvd' => $biblioteca->getDVDs(),
    default => $biblioteca->getMaterials()
};
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Materials</title>
</head>
<body>

<h1>Materials de la biblioteca</h1>

<nav>
    <a href="index.php">Inici</a> |
    <a href="index.php?page=materials">Tots</a> |
    <a href="index.php?page=materials&type=llibre">Llibres</a> |
    <a href="index.php?page=materials&type=revista">Revistes</a> |
    <a href="index.php?page=materials&type=dvd">DVDs</a>
</nav>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Títol</th>
            <th>Autor</th>
            <th>Any</th>
            <th>Tipus</th>
            <th>Estat</th>
            <th>Accions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($materials as $material): ?>
            <tr>
                <td><?= $material->getId() ?></td>
                <td><?= htmlspecialchars($material->getTitol()) ?></td>
                <td><?= htmlspecialchars($material->getAutor()) ?></td>
                <td><?= $material->getAnyPublicacio() ?></td>
                <td><?= $material->getTipus() ?></td>
                <td><?= $material->isDisponible() ? 'Disponible' : 'Prestat' ?></td>
                <td>
                    <a href="index.php?page=material&id=<?= $material->getId() ?>">
                        Veure
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
