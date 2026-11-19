<?php

namespace App\Models;

/**
 * Classe que representa un prestec d'un material.
 */
class Prestec
{
    private \DateTime $dataPrestec;

    private ?\DateTime $dataRetorn = null;

    public function __construct(
        private Material $material,
        private Usuari $usuari,
        private int $diesLimitPrestec = 14,
        ?\DateTime $dataPrestec = null
    ) {
        $this->dataPrestec = $dataPrestec ?? new \DateTime();
    }

    // Registra la data de retorn.
    public function retornar(): void
    {
        if ($this->dataRetorn === null) {
            $this->dataRetorn = new \DateTime();
        }
    }

    public function estaActiu(): bool
    {
        return $this->dataRetorn === null;
    }

    // Calcula els dies que han passat del termini.
    public function calcularDiesRetard(): int
    {
        $dataFinal = $this->dataRetorn ?? new \DateTime();

        $dataLimit = clone $this->dataPrestec;

        $dataLimit->modify('+' . $this->diesLimitPrestec . ' days');

        if ($dataFinal <= $dataLimit) {
            return 0;
        }

        return (int) $dataLimit->diff($dataFinal)->days;
    }

    public function calcularMulta(): float
    {
        return $this->material->calcularMulta(
            $this->calcularDiesRetard()
        );
    }

    public function estaVencut(): bool
    {
        return $this->estaActiu() && $this->calcularDiesRetard() > 0;
    }

    // Dies que queden per retornar el material.
    public function getDiesPendents(): int
    {
        $dataLimit = clone $this->dataPrestec;

        $dataLimit->modify('+' . $this->diesLimitPrestec . ' days');

        $ara = new \DateTime();

        if ($ara > $dataLimit) {
            return -(int) $dataLimit->diff($ara)->days;
        }

        return (int) $ara->diff($dataLimit)->days;
    }

    public function getMaterial(): Material
    {
        return $this->material;
    }

    public function getUsuari(): Usuari
    {
        return $this->usuari;
    }

    public function getDataPrestec(): \DateTime
    {
        return $this->dataPrestec;
    }

    public function getDataRetorn(): ?\DateTime
    {
        return $this->dataRetorn;
    }

    public function getDiesLimitPrestec(): int
    {
        return $this->diesLimitPrestec;
    }
}
