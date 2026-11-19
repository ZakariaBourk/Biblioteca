<?php

namespace App\Models;

/**
 * Classe que representa una revista.
 */
class Revista extends Material
{
    public function __construct(
        int $id,
        string $titol,
        string $autor,
        int $anyPublicacio,
        private int $numeroEdicio
    ) {
        parent::__construct($id, $titol, $autor, $anyPublicacio);

        $this->setNumeroEdicio($numeroEdicio);
    }

    public function calcularMulta(int $diesRetard): float
    {
        return max(0, $diesRetard) * 0.25;
    }

    public function getTipus(): string
    {
        return 'Revista';
    }

    public function getNumeroEdicio(): int
    {
        return $this->numeroEdicio;
    }

    public function setNumeroEdicio(int $numero): void
    {
        if ($numero <= 0) {
            throw new \InvalidArgumentException(
                "El numero d'edicio ha de ser superior a zero."
            );
        }

        $this->numeroEdicio = $numero;
    }
}
