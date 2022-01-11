<?php
declare(strict_types = 1);

class DB extends PDO
{

    // TODO может это не обязательно
    /**
     * @param string $dsn
     * @param string $dbuser
     * @param string $dbpassword
     */
    public function __construct(string $dsn, string $dbuser, string $dbpassword) {
        parent::__construct($dsn, $dbuser, $dbpassword);
    }

    /**
     * @param string $comment
     * @param string $name
     */
    public function insertComment(string $comment, string $name) : void {
        $query = 'insert into comments(created_at, updated_at, message) value (:date, :date, :comment)';
        $sth = $this->prepare($query);
        $sth->execute([
           'date' => date('Y-m-d H:i:s', time() + 3600),
           'comment' => $comment
        ]);
    }

    /**
     * Возвращает ассоциативный массив комментариев
     * @return array
     */
    public function getAllComments() : array {
        $query = 'select * from comments';
        $sth = $this->prepare($query);
        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}