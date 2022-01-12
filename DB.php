<?php
declare(strict_types = 1);

class DB extends PDO
{
    /**
     * @param string $comment
     * @param string $name
     * @return bool
     */
    public function insertComment(string $comment, string $name) : bool {
        $query = 'insert into comments(created_at, updated_at, message) value (:date, :date, :comment)';
        $sth = $this->prepare($query);
        return $sth->execute([
           'date' => date('Y-m-d H:i:s', time() + 3600),
           'comment' => $comment
        ]);
    }

    public function count() {
        $query = 'select count(*) from comments';
        $res = $this->query($query);

        return $res->fetchColumn();
    }

    public function paginated(int $perPage, int $page): bool|array {
        $offset = $perPage * ($page - 1);
        $query = "select * from comments limit $perPage offset $offset";
        $res = $this->query($query);

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Возвращает ассоциативный массив комментариев
     * @return array
     */
    public function getAll() : array {
        $query = 'select * from comments';
        $res = $this->query($query);

        return $res->fetchAll(PDO::FETCH_ASSOC);
    }
}