<?php

namespace App\Models;

use App\Interfaces\Reservable;

/**
 * Classe que representa un llibre.
 */
class Llibre extends Material implements Reservable
{
    private ?string $usuariReserva = null;

    public function __construct(
        int $id,
        string $titol,
        string $autor,
        int $anyPublicacio,
        private int $numeroPagines
    ) {
        parent::__construct($id, $titol, $autor, $anyPublicacio);

        $this->setNumeroPagines($numeroPagines);
    }

    public function calcularMulta(int $diesRetard): float
    {
        return max(0, $diesRetard) * 0.50;
    }

    public function getTipus(): string
    {
        return 'Llibre';
    }

    public function getNumeroPagines(): int
    {
        return $this->numeroPagines;
    }

    public function setNumeroPagines(int $pagines): void
    {
        if ($pagines <= 0) {
            throw new \InvalidArgumentException(
                'El nombre de pagines ha de ser superior a zero.'
            );
        }

        $this->numeroPagines = $pagines;
    }

    public function reservar(string $nomUsuari): bool
    {
        if ($this->usuariReserva !== null || !$this->disponible) {
            return false;
        }

        $this->usuariReserva = $nomUsuari;

        $this->registrarAccio('reservat', $nomUsuari);

        return true;
    }

    public function cancelarReserva(): bool
    {
        if ($this->usuariReserva === null) {
            return false;
        }

        $nom = $this->usuariReserva;

        $this->usuariReserva = null;

        $this->registrarAccio('reserva_cancel·lada', $nom);

        return true;
    }

    public function estaReservat(): bool
    {
        return $this->usuariReserva !== null;
    }

    public function getUsuariReserva(): ?string
    {
        return $this->usuariReserva;
    }
}
