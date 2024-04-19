<?php

namespace App\Entity;

use App\Repository\UsuariosRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;


#[ORM\Entity(repositoryClass: UsuariosRepository::class)]
class Usuarios
{
    // crea la columna y genera el id de forma automatica
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // crea la columna de tipo string y tamaño 50
    #[ORM\Column(type: 'string', length: 50)]
    private string $usuario;

    // crea la columna de tipo string y tamaño 50
    // crea un validador de contraseña con un nivel de fortaleza y un mensaje
    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\PasswordStrength([
        'minScore' => PasswordStrength::STRENGTH_WEAK,
        'message' => 'La contraseña es demasiado debil.'
    ])]
    private string $password;

    // getters y setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
