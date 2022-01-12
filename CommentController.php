<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Templator.php';

class CommentController
{
    protected DB $db;

    public function __construct() {
        $this->db = new DB('mysql:dbname=exercices;host=localhost', 'homestead', 'secret');
    }

    public function haveComment() : bool {
        return isset($_POST['name']) && isset($_POST['comment']);
    }

    public function make(): bool {
        return $this->db->insertComment($_POST['comment'], $_POST['name']);
    }

    public function all() {
        $allComments = $this->db->getAllComments();
        Templator::showAll($allComments);
    }
}