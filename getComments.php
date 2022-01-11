<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Templator.php';

$db = new DB('mysql:dbname=new_exercices;host=localhost', 'root', '');

if (isset($_POST['name']) && isset($_POST['comment'])) {
    $db->insertComment($_POST['comment'], $_POST['name']);
}

$allComments = $db->getAllComments();

Templator::showAll($allComments);