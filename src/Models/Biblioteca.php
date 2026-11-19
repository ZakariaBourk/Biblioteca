<?php

namespace App\Models;

use App\Interfaces\Reservable;
use App\Exceptions\MaterialNoTrobatException;
use App\Exceptions\MaterialNoDisponibleException;
use App\Exceptions\MaterialNoPrestatException;
use App\Exceptions\UsuariNoTrobatException;

/**
 * Classe principal per gestionar la biblioteca.
 */
class Biblioteca
{
    private array $materials = [];

    private array $usuaris = [];

    private array $prestecs = [];

    public function __construct(private string $nom)
    {
    }

    // Afegeix un material.
    public function afegirMaterial(Material $material): void
    {
        $this->materials[$material->getId()] = $material;
    }

    public function eliminarMaterial(int $id): bool
    {
        if (!isset($this->materials[$id])) {
            return false;
        }

        unset($this->materials[$id]);

        return true;
    }

    public function cercarPerId(int $id): ?Material
    {
        return $this->materials[$id] ?? null;
    }

    public function cercarPerTitol(string $titol): array
    {
        $resultat = [];

        foreach ($this->materials as $material) {
            if (stripos($material->getTitol(), $titol) !== false) {
                $resultat[] = $material;
            }
        }

        return $resultat;
    }

    public function cercarPerAutor(string $autor): array
    {
        $resultat = [];

        foreach ($this->materials as $material) {
            if (stripos($material->getAutor(), $autor) !== false) {
                $resultat[] = $material;
            }
        }

        return $resultat;
    }

    public function llistarDisponibles(): array
    {
        return array_values(array_filter(
            $this->materials,
            fn($material) => $material->isDisponible()
        ));
    }

    public function llistarPrestats(): array
    {
        return array_values(array_filter(
            $this->materials,
            fn($material) => !$material->isDisponible()
        ));
    }

    public function llistarPerTipus(string $tipus): array
    {
        return array_values(array_filter(
            $this->materials,
            fn($material) => strtolower($material->getTipus()) === strtolower($tipus)
        ));
    }

    public function llistarPrestecsActius(): array
    {
        return array_values(array_filter(
            $this->prestecs,
            fn($prestec) => $prestec->estaActiu()
        ));
    }

    public function llistarReserves(): array
    {
        $resultat = [];

        foreach ($this->materials as $material) {
            if ($material instanceof Reservable && $material->estaReservat()) {
                $resultat[] = $material;
            }
        }

        return $resultat;
    }

    public function llistarPrestecsUsuari(int $usuariId): array
    {
        $resultat = [];

        foreach ($this->prestecs as $prestec) {
            if ($prestec->getUsuari()->getId() === $usuariId) {
                $resultat[] = $prestec;
            }
        }

        return $resultat;
    }

    public function afegirUsuari(Usuari $usuari): void
    {
        $this->usuaris[$usuari->getId()] = $usuari;
    }

    public function cercarUsuari(int|string $identificador): ?Usuari
    {
        if (is_int($identificador)) {
            return $this->usuaris[$identificador] ?? null;
        }

        foreach ($this->usuaris as $usuari) {
            if (strcasecmp($usuari->getNom(), $identificador) === 0) {
                return $usuari;
            }
        }

        return null;
    }

    // Crea un prestec.
    public function prestarMaterial(
        int $materialId,
        int $usuariId,
        ?\DateTime $dataPrestec = null
    ): Prestec {
        $material = $this->cercarPerId($materialId);

        if ($material === null) {
            throw new MaterialNoTrobatException(
                "No existeix cap material amb ID {$materialId}"
            );
        }

        $usuari = $this->cercarUsuari($usuariId);

        if ($usuari === null) {
            throw new UsuariNoTrobatException(
                "No existeix cap usuari amb ID {$usuariId}"
            );
        }

        // Comprova si el material esta reservat.
        if ($material instanceof Reservable && $material->estaReservat()) {
            if ($material->getUsuariReserva() !== $usuari->getNom()) {
                throw new MaterialNoDisponibleException(
                    $materialId,
                    'El material esta reservat per un altre usuari.'
                );
            }

            $material->cancelarReserva();
        }

        if (!$material->prestar()) {
            throw new MaterialNoDisponibleException(
                $materialId,
                'El material ja esta prestat.'
            );
        }

        $prestec = new Prestec($material, $usuari, 14, $dataPrestec);

        $this->prestecs[] = $prestec;

        $usuari->afegirPrestec($material);

        return $prestec;
    }

    // Retorna un material i calcula la multa.
    public function retornarMaterial(int $materialId): float
    {
        $material = $this->cercarPerId($materialId);

        if ($material === null) {
            throw new MaterialNoTrobatException(
                "No existeix cap material amb ID {$materialId}"
            );
        }

        foreach ($this->prestecs as $prestec) {
            if (
                $prestec->getMaterial()->getId() === $materialId
                && $prestec->estaActiu()
            ) {
                $prestec->retornar();

                $multa = $prestec->calcularMulta();

                $material->retornar();

                $prestec->getUsuari()->eliminarPrestec($materialId);

                $prestec->getUsuari()->afegirNotificacio(
                    'Material retornat: ' . $material->getTitol()
                );

                return $multa;
            }
        }

        throw new MaterialNoPrestatException(
            'Aquest material no te cap prestec actiu.'
        );
    }

    // Crea una reserva.
    public function reservarMaterial(int $materialId, int $usuariId): bool
    {
        $material = $this->cercarPerId($materialId);

        if ($material === null) {
            throw new MaterialNoTrobatException(
                "No existeix cap material amb ID {$materialId}"
            );
        }

        $usuari = $this->cercarUsuari($usuariId);

        if ($usuari === null) {
            throw new UsuariNoTrobatException(
                "No existeix cap usuari amb ID {$usuariId}"
            );
        }

        if (!$material instanceof Reservable) {
            throw new MaterialNoDisponibleException(
                $materialId,
                'Les revistes no es poden reservar'
            );
        }

        if (!$material->reservar($usuari->getNom())) {
            throw new MaterialNoDisponibleException(
                $materialId,
                'El material ja esta reservat o prestat.'
            );
        }

        return true;
    }

    // Metode magic per obtenir dades sense crear getters especifics.
    public function __call(string $metode, array $arguments): mixed
    {
        return match ($metode) {
            'getLlibres' => $this->llistarPerTipus('Llibre'),
            'getRevistes' => $this->llistarPerTipus('Revista'),
            'getDVDs' => $this->llistarPerTipus('DVD'),
            'getMaterials' => array_values($this->materials),
            'getUsuaris' => array_values($this->usuaris),
            'getNom' => $this->nom,
            default => throw new \BadMethodCallException(
                "El metode {$metode} no existeix."
            )
        };
    }

    // Retorna les estadistiques generals.
    public function obtenirEstadistiques(): array
    {
        $perTipus = [
            'Llibre' => count($this->llistarPerTipus('Llibre')),
            'Revista' => count($this->llistarPerTipus('Revista')),
            'DVD' => count($this->llistarPerTipus('DVD'))
        ];

        $multes = 0;

        foreach ($this->llistarPrestecsActius() as $prestec) {
            $multes += $prestec->calcularMulta();
        }

        return [
            'total' => count($this->materials),
            'disponibles' => count($this->llistarDisponibles()),
            'prestats' => count($this->llistarPrestats()),
            'reservats' => count($this->llistarReserves()),
            'perTipus' => $perTipus,
            'multesPendents' => $multes
        ];
    }
}
