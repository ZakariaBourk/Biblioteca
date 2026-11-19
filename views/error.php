<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>
<body>

<h1>S'ha produït un error</h1>

<p>
    <?= htmlspecialchars($error ?? 'Error desconegut') ?>
</p>

<a href="index.php">Tornar a l'inici</a>

</body>
</html>
