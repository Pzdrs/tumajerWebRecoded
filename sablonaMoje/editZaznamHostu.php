<?php
include 'includes/Database.php';

$statement = Database::getInstance()
  ->getConnection()
  ->prepare('UPDATE zaznamy_hostu SET datum = "' . $_POST['date']
    . '", prezdivka = "' . $_POST['author'] . '", email = "'
    . $_POST['email'] . '", text = "' . $_POST['text']
    . '" WHERE id = ' . $_POST['id']);
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);