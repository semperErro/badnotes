<?php


namespace dao\sql;


use dao\INoteDao;
use model\Note;
use PDO;

class SqlNoteDao extends AbstractSqlDao implements INoteDao
{
    public function findByUserId(int $userId): ?array
    {
        $sql = "SELECT (`id`, `title`, `text`, `date`, `user_id`) FROM `$this->tableName` WHERE `user_id` = :user_id";
        /*"SELECT (id, title, text, date, `users`.`id`) FROM `$this->tableName`
            INNER JOIN `users` ON `users`.`id` = `$this->tableName`.`user_id`";*/
        $stmt = $this->pdo()->prepare($sql);
        $stmt->bindValue(':user_id', $userId);
        if (!$stmt->execute()) {
            echo 'Could not execute statement';
            return null;
        }

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        array_walk($res, function ($dbNote) use ($userId) {
            return new Note($dbNote['id'], $dbNote['title'], $dbNote['text'], $dbNote['date'], $userId);
        });
        return $res;
    }

    public function createNote(Note $note): bool
    {
        $sql = "INSERT INTO `$this->tableName` (`id`, `title`, `text`, `date`, `user_id`) VALUES (:id, :title, :text, :date, :user_id)";
        $stmt = $this->pdo()->prepare($sql);
        $stmt->bindValue(':id', $note->getId());
        $stmt->bindValue(':title', $note->getTitle());
        $stmt->bindValue(':text', $note->getText());
        $stmt->bindValue(':date', $note->getDate());
        $stmt->bindValue(':user_id', $note->getUserId());
        return $stmt->execute();
    }

    public function updateNote(Note $note): bool
    {
        $sql = "UPDATE `$this->tableName` SET `title` = :title, `text` = :text, `date` = :date WHERE `id` = :note_id";
        $stmt = $this->pdo()->prepare($sql);
        $stmt->bindValue(':title', $note->getTitle());
        $stmt->bindValue(':text', $note->getText());
        $stmt->bindValue(':date', $note->getDate());
        $stmt->bindValue(':note_id', $note->getId());
        return $stmt->execute();
    }

    public function deleteNote(int $id): bool
    {
        $sql = "DELETE FROM `$this->tableName` WHERE `id` = :id";
        $stmt = $this->pdo()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    function findById(int $id): ?Note
    {
        $res = $this->findOneByAttribute('id', $id);
        if ($res == null || $res == []) {
            return null;
        }
        $userId = $res['user_id'];


        return new Note($res['title'], $res['text'], $res['date']);
    }
}