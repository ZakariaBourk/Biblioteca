<?php

namespace App\Traits;

/**
 * Registra las accions realitzades sobre un material.
 */
trait Auditoria
{
    private array $historial = [];

    // Afegeix una accio a l'historial.
    public function registrarAccio(string $accio, string $detalls = ''): void
    {
        $this->historial[] = [
            'data' => date('Y-m-d H:i:s'),
            'accio' => $accio,
            'detalls' => $detalls
        ];
    }

    // Retorna tot l'historial.
    public function obtenirHistorial(): array
    {
        return $this->historial;
    }

    // Retorna l'ultima accio.
    public function obtenirUltimaAccio(): ?array
    {
        if (empty($this->historial)) {
            return null;
        }

        return end($this->historial);
    }

    // Buida l'historial.
    public function netejarHistorial(): void
    {
        $this->historial = [];
    }
}
