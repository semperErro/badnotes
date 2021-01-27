<?php


namespace model;

use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * Class User
 * @package User
 * @ORM\Entity(repositoryClass="repository\doctrine\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $name;

    /**
     * @ORM\Column(type="string")
     */
    protected string $email;

    /**
     * @ORM\Column(type="string")
     */
    protected string $password;

    /**
     * User constructor.
     * @param string $name
     * @param string $email
     * @param string $password
     * @param int $id
     */
    public function __construct(string $name, string $email, string $password, int $id = -1)
    {
        if ($id >= 0) {
            $this->id = $id;
        }
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    #[Pure] public function equals(User $that): bool
    {
        return
            $this->getId() == $that->getId() &&
            $this->getName() == $that->getName() &&
            $this->getEmail() == $that->getEmail() &&
            $this->getPassword() == $that->getPassword();
    }
}