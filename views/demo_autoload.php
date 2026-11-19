<?php

$classes = get_declared_classes();

$classesApp = array_filter(
    $classes,
    fn($classe) => str_starts_with($classe, 'App\\')
);

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Demo Autoload</title>
</head>
<body>

<h1>Demostració Autoload PSR-4</h1>

<p>Classes carregades de l'aplicació:</p>

<ul>
    <?php foreach ($classesApp as $classe): ?>
        <li><?= htmlspecialchars($classe) ?></li>
    <?php endforeach; ?>
</ul>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
