<?php
include 'includes/Database.php';

$statement = Database::getInstance()
  ->getConnection()
  ->prepare('INSERT INTO novinky VALUES(null, now(), "'.$_POST['title'].'", "'.$_POST['author'].'", "'.$_POST['email'].'", "'.$_POST['text'].'")');
$statement->execute();
header('Location: news.php');
