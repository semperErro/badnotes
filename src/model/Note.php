<?php


namespace Note;

use Doctrine\ORM\Mapping as ORM;
use User\User;

/**
 * Class Note
 * @package Note
 * @ORM\Entity(repositoryClass="NoteRepository")
 * @ORM\Table(name="notes")
 */
class Note
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
    protected string $title;

    /**
     * @ORM\Column(type="string")
     */
    protected string $text;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $date;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="notes")
     */
    protected User $user;

    /**
     * Note constructor.
     * @param int $id
     * @param string $title
     * @param string $text
     * @param int $date
     * @param User $user
     */
    public function __construct(int $id, string $title, string $text, int $date, User $user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate(int $date): void
    {
        $this->date = $date;
    }
}