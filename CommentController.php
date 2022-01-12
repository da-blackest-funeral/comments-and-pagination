<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Templator.php';

class CommentController
{
    public DB $db;
    public Templator $templator;

    public function __construct() {
        $this->db = new DB('mysql:dbname=exercices;host=localhost', 'homestead', 'secret');
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