<?php
include 'includes/Database.php';
$statement = Database::getInstance()
  ->getConnection()
  ->prepare('UPDATE uvod SET text = "' . $_POST['text']
    . '" WHERE id = ' . $_POST['id']);
$statement->execute();
header('Location: index.php');

