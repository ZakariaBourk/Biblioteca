<?php

$materialId = (int) ($_GET['material_id'] ?? 0);
$usuariId = (int) ($_GET['usuari_id'] ?? 0);

$material = $biblioteca->cercarPerId($materialId);

if ($material === null) {
    throw new \App\Exceptions\MaterialNoTrobatException(
        "No existeix cap material amb ID {$materialId}"
    );
}

// Si s'ha seleccionat un usuari, es realitza el préstec.
if ($usuariId > 0) {
    $prestec = $biblioteca->prestarMaterial($materialId, $usuariId);
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Préstec de material</title>
</head>
<body>

<?php if (isset($prestec)): ?>

    <h1>Préstec realitzat correctament</h1>

    <p>
        Material:
        <?= htmlspecialchars($prestec->getMaterial()->getTitol()) ?>
    </p>

    <p>
        Usuari:
        <?= htmlspecialchars($prestec->getUsuari()->getNom()) ?>
    </p>

    <a href="index.php?page=usuari&id=<?= $prestec->getUsuari()->getId() ?>">
        Veure perfil de l'usuari
    </a>

<?php else: ?>

    <h1>Prestar material</h1>

    <p>
        Material:
        <?= htmlspecialchars($material->getTitol()) ?>
    </p>

    <?php if (!$material->isDisponible()): ?>

        <p>Aquest material ja està prestat.</p>

    <?php else: ?>

        <form action="index.php" method="GET">

            <input type="hidden" name="page" value="prestec">

            <input
                type="hidden"
                name="material_id"
                value="<?= $materialId ?>"
            >

            <label for="usuari_id">Selecciona un usuari:</label>

            <select name="usuari_id" id="usuari_id" required>

                <option value="">Selecciona un usuari</option>

                <?php foreach ($biblioteca->getUsuaris() as $usuari): ?>

                    <option value="<?= $usuari->getId() ?>">
                        <?= htmlspecialchars($usuari->getNom()) ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <button type="submit">Confirmar préstec</button>

        </form>

    <?php endif; ?>

<?php endif; ?>

<p>
    <a href="index.php?page=materials">Tornar als materials</a>
</p>

</body>
</html>
