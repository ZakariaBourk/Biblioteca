<?php

namespace App\Data;

use App\Models\Biblioteca;
use App\Models\Llibre;
use App\Models\Revista;
use App\Models\DVD;
use App\Models\Usuari;

/**
 * Genera les dades inicials de la biblioteca.
 */
class DataGenerator
{
    public static function crear(): Biblioteca
    {
        $biblioteca = new Biblioteca('Biblioteca Digital');

        // Llibres.
        $biblioteca->afegirMaterial(
            new Llibre(1, 'El nom de la rosa', 'Umberto Eco', 1980, 512)
        );

        $biblioteca->afegirMaterial(
            new Llibre(2, '1984', 'George Orwell', 1949, 328)
        );

        $biblioteca->afegirMaterial(
            new Llibre(3, 'El petit princep', 'Antoine de Saint-Exupery', 1943, 96)
        );

        $biblioteca->afegirMaterial(
            new Llibre(4, 'La plaça del Diamant', 'Mercè Rodoreda', 1962, 256)
        );

        // Revistes.
        $biblioteca->afegirMaterial(
            new Revista(5, 'National Geographic', 'Diversos autors', 2024, 120)
        );

        $biblioteca->afegirMaterial(
            new Revista(6, 'Muy Interesante', 'Diversos autors', 2023, 85)
        );

        $biblioteca->afegirMaterial(
            new Revista(7, 'Historia National Geographic', 'Diversos autors', 2022, 45)
        );

        // DVDs.
        $biblioteca->afegirMaterial(
            new DVD(8, 'Interstellar', 'Christopher Nolan', 2014, 169)
        );

        $biblioteca->afegirMaterial(
            new DVD(9, 'Inception', 'Christopher Nolan', 2010, 148)
        );

        $biblioteca->afegirMaterial(
            new DVD(10, 'The Matrix', 'Lana i Lilly Wachowski', 1999, 136)
        );

        // Usuaris.
        $biblioteca->afegirUsuari(
            new Usuari(1, 'Anna Puig', 'anna@mail.com')
        );

        $biblioteca->afegirUsuari(
            new Usuari(2, 'Marc Garcia', 'marc@mail.com')
        );

        $biblioteca->afegirUsuari(
            new Usuari(3, 'Laura Martinez', 'laura@mail.com')
        );

        $biblioteca->afegirUsuari(
            new Usuari(4, 'Pau Soler', 'pau@mail.com')
        );

        // Prestecs actius.
        $dataAntiga = new \DateTime('-25 days');

        $biblioteca->prestarMaterial(1, 1, $dataAntiga);

        $biblioteca->prestarMaterial(2, 2);

        // Una reserva activa.
        $biblioteca->reservarMaterial(8, 3);

        return $biblioteca;
    }
}
