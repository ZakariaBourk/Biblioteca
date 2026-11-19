<?php

namespace App\Models;

use App\Traits\Auditoria;

/**
 * Classe abstracta que representa un material de la biblioteca.
 */
abstract class Material
{
    use Auditoria;

    protected bool $disponible = true;

    public function __construct(
        protected int $id,
        protected string $titol,
        protected string $autor,
        protected int $anyPublicacio
    ) {
    }

    // Metodes abstractes que implementaran les classes filles.
    abstract public function calcularMulta(int $diesRetard): float;

    abstract public function getTipus(): string;

    // Marca el material com a prestat.
    public function prestar(): bool
    {
        if (!$this->disponible) {
            return false;
        }

        $this->disponible = false;

        $this->registrarAccio('prestat');

        return true;
    }

    // Marca el material com a disponible.
    public function retornar(): void
    {
        $this->disponible = true;

        $this->registrarAccio('retornat');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitol(): string
    {
        return $this->titol;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function getAnyPublicacio(): int
    {
        return $this->anyPublicacio;
    }

    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    // Mostra la informacio del material.
    public function __toString(): string
    {
        $estat = $this->disponible ? 'Disponible' : 'Prestat';

        return "[{$this->getTipus()}] #{$this->id} - {$this->titol} ({$this->autor}, {$this->anyPublicacio}) - {$estat}";
    }
}
