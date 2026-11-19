<?php

namespace App\Models;

use App\Exceptions\EmailInvalidException;

/**
 * Classe que representa un usuari de la biblioteca.
 */
class Usuari
{
    private array $materialsPrestats = [];

    private \DateTime $dataRegistre;

    private array $notificacions = [];

    public function __construct(
        private int $id,
        private string $nom,
        private string $email
    ) {
        if (!$this->validarEmail($email)) {
            throw new EmailInvalidException(
                "El correu electronic no es valid: {$email}"
            );
        }

        $this->dataRegistre = new \DateTime();
    }

    // Permet consultar propietats privades.
    public function __get(string $propietat): mixed
    {
        return match ($propietat) {
            'id' => $this->id,
            'nom' => $this->nom,
            'email' => $this->email,
            'dataRegistre' => $this->dataRegistre,
            default => null
        };
    }

    // Només permet modificar el correu electronic.
    public function __set(string $propietat, mixed $valor): void
    {
        if ($propietat !== 'email') {
            throw new \LogicException(
                "No es pot modificar la propietat {$propietat}."
            );
        }

        if (!is_string($valor) || !$this->validarEmail($valor)) {
            throw new EmailInvalidException(
                'El correu electronic no es valid.'
            );
        }

        $this->email = $valor;
    }

    // Exclou les notificacions de la serialitzacio.
    public function __sleep(): array
    {
        return [
            'id',
            'nom',
            'email',
            'materialsPrestats',
            'dataRegistre'
        ];
    }

    // Reinicialitza les notificacions quan es recupera l'objecte.
    public function __wakeup(): void
    {
        $this->notificacions = [];
    }

    public function __toString(): string
    {
        return "{$this->nom} <{$this->email}> - "
            . $this->getNumeroMaterialsPrestats() . " préstecs";
    }

    public function afegirPrestec(Material $material): void
    {
        $this->materialsPrestats[$material->getId()] = $material;

        $this->afegirNotificacio(
            'Prestec realitzat: ' . $material->getTitol()
        );
    }

    public function eliminarPrestec(int $materialId): void
    {
        unset($this->materialsPrestats[$materialId]);
    }

    public function getMaterialsPrestats(): array
    {
        return array_values($this->materialsPrestats);
    }

    public function getNumeroMaterialsPrestats(): int
    {
        return count($this->materialsPrestats);
    }

    public function afegirNotificacio(string $missatge): void
    {
        $this->notificacions[] = $missatge;
    }

    // Retorna les notificacions i despres les buida.
    public function obtenirNotificacions(): array
    {
        $resultat = $this->notificacions;

        $this->notificacions = [];

        return $resultat;
    }

    private function validarEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDataRegistre(): \DateTime
    {
        return $this->dataRegistre;
    }
}
