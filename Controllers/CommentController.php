<?php
require_once __DIR__ . '/../Database/CommentsModel.php';
require_once __DIR__ . '/../Services/Templator.php';

class CommentController
{
    public CommentsModel $db;
    public Templator $templator;

    public function __construct() {
        $this->db = new CommentsModel('mysql:dbname=exercices;host=localhost', 'homestead', 'secret');
        $this->templator = new Templator($this->db);
    }

    public function haveComment() : bool {
        return isset($_POST['name']) && isset($_POST['comment']);
    }

    public function make(): bool {
        return $this->db->insertComment($_POST['comment'], $_POST['name']);
    }

    public function all() {
        $this->templator->showAll();
    }
}