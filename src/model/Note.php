<?php


namespace model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Note
 * @package Note
 * @ORM\Entity(repositoryClass="repository\doctrine\NoteRepository")
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
     * @var int
     * @ORM\Column(type="integer")
     */
    protected int $userId;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * Note constructor.
     * @param string $title
     * @param string $text
     * @param int $date
     * @param int $userId
     * @param int $id
     */
    public function __construct(string $title, string $text, int $date, int $userId, int $id = -1)
    {
        if ($id >= 0) {
            $this->id = $id;
        }
        $this->title = $title;
        $this->text = $text;
        $this->date = $date;
        $this->userId = $userId;
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