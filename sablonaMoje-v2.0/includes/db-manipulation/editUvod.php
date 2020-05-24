<?php
if (isset($_POST['text'])) {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('UPDATE uvod SET text = "' . $_POST['text']
      . '" WHERE id = ' . $_POST['id']);
  $statement->execute();
  header('Location: index.php');
}
else {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('SELECT * FROM uvod WHERE id = ' . $_GET['id']);
  $statement->execute();
  $resultIndividual = $statement->fetch();
}
?>
<form action="" method="post">
	<textarea rows="10" class="form-control mb-3"
	          name="text"><?= $resultIndividual['text'] ?></textarea>
	<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	<input class="btn btn-outline-success form-control" type="submit"
	       value="Upravit záznam">
</form>
