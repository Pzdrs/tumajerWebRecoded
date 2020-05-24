<?php
$statement = Database::getInstance()
  ->getConnection()
  ->prepare('SELECT file FROM novinky WHERE id = ' . $_GET['id']);
$statement->execute();
$result = $statement->fetch();
if (file_exists(realpath($result['file']))) {
  unlink(realpath($result['file']));
}

$statement = Database::getInstance()
  ->getConnection()
  ->prepare('DELETE FROM novinky WHERE id = ' . $_GET['id']);
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);
