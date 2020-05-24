<?php
$statement = Database::getInstance()->getConnection()->prepare('SELECT path, fullResPath FROM photogallery WHERE id = ' . $_GET['id']);
$statement->execute();
$result = $statement->fetch();

if (file_exists(realpath($result['path']))) {
  unlink(realpath($result['path']));
}
if (file_exists(realpath($result['fullResPath']))) {
  unlink(realpath($result['fullResPath']));
}

$statement = Database::getInstance()->getConnection()->prepare('DELETE FROM photogallery WHERE id = ' . $_GET['id']);
$statement->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);