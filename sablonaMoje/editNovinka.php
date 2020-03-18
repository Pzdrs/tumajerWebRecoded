<?php
include 'includes/Database.php';

$statement = Database::getInstance()
  ->getConnection()
  ->prepare('UPDATE novinky SET nadpis = "' . $_POST['title']
    . '", autor = "' . $_POST['author'] . '", email = "'
    . $_POST['email'] . '", text = "' . $_POST['text']
    . '" WHERE id = ' . $_POST['id']);
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);