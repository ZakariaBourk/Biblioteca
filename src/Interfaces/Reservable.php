<?php

namespace App\Interfaces;

/**
 * Interficie per als materials reservables.
 */
interface Reservable
{
    public function reservar(string $nomUsuari): bool;

    public function cancelarReserva(): bool;

    public function estaReservat(): bool;

    public function getUsuariReserva(): ?string;
}
