<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Data\DataGenerator;
use App\Exceptions\MaterialNoDisponibleException;

session_start();

// Crea la biblioteca si encara no existeix.
if (!isset($_SESSION['biblioteca'])) {
    $_SESSION['biblioteca'] = DataGenerator::crear();
}

$biblioteca = $_SESSION['biblioteca'];

$page = $_GET['page'] ?? 'inici';

try {

    // Reinicia les dades.
    if ($page === 'reset') {
        session_destroy();

        header('Location: index.php');
        exit;
    }

    $vista = match ($page) {

        'inici' => 'views/inici.php',

        'materials' => 'views/materials.php',

        'material' => 'views/material.php',

        'usuaris' => 'views/usuaris.php',

        'usuari' => 'views/usuari.php',

        'prestecs' => 'views/prestecs.php',

        'prestec' => 'views/prestec.php',

        'retorn' => 'views/retorn.php',

        'reserves' => 'views/reserves.php',

        'reserva' => 'views/reserva.php',

        'estadistiques' => 'views/estadistiques.php',

        'auditoria' => 'views/auditoria.php',

        'demo_magic' => 'views/demo_magic.php',

        'demo_serialization' => 'views/demo_serialization.php',

        'demo_exceptions' => 'views/demo_exceptions.php',

        'demo_autoload' => 'views/demo_autoload.php',

        default => 'views/404.php'
    };

    require __DIR__ . '/' . $vista;

} catch (MaterialNoDisponibleException $e) {

    $error = (string) $e;

    require __DIR__ . '/views/error.php';

} catch (\Exception $e) {

    $error = $e->getMessage();

    require __DIR__ . '/views/error.php';
}

// Guarda els canvis de la biblioteca a la sessio.
$_SESSION['biblioteca'] = $biblioteca;
