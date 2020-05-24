<?php
$statement = Database::getInstance()
  ->getConnection()
  ->prepare('SELECT * FROM novinky WHERE id = ' . $_GET['id']);
$statement->execute();
$result = $statement->fetch();
if (isset($_POST['title'])) {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('UPDATE novinky SET nadpis = "' . $_POST['title']
      . '", autor = "' . $_POST['author'] . '", email = "'
      . $_POST['email'] . '", text = "' . $_POST['text']
      . '" WHERE id = ' . $_GET['id']);
  $statement->execute();
  header('Location: news.php');
}
?>
<form action="" method="post">
	<input value="<?= $result['nadpis'] ?>" class="form-control my-3"
	       name="title" type="text"
	       placeholder="Nadpis" required>
	<input value="<?= $result['autor'] ?>" class="form-control my-3"
	       name="author" type="text"
	       placeholder="Autor" required>
	<input value="<?= $result['email'] ?>" class="form-control my-3"
	       name="email" type="email"
	       placeholder="Email" required>
	<textarea class="form-control my-3" name="text" rows="10" placeholder="Text"
	          required><?= $result['text'] ?></textarea><br>
	<input class="btn btn-outline-success my-3" value="Aktualizovat záznam"
	       type="submit">
</form>
