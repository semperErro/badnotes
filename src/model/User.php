<?php


namespace User;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package User
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="user")
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
     * @var array
     * @ORM\OneToMany(targetEntity="Note", mappedBy="user", cascade={"ALL"}, indexBy="id")
     */
    protected array $notes;

    /**
     * User constructor.
     * @param int $id
     * @param string $name
     * @param string $email
     * @param array $notes
     */
    public function __construct(int $id, string $name, string $email, array $notes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->notes = $notes;
    }

    /**
     * @return array
     */
    public function getNotes(): array
    {
        return $this->notes;
    }

    /**
     * @param array $notes
     */
    public function setNotes(array $notes): void
    {
        $this->notes = $notes;
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
}