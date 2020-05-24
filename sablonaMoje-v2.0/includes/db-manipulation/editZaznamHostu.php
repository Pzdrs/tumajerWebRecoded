<?php

if (isset($_POST['date'])) {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('UPDATE zaznamy_hostu SET datum = "' . $_POST['date']
      . '", prezdivka = "' . $_POST['author'] . '", email = "'
      . $_POST['email'] . '", text = "' . $_POST['text']
      . '" WHERE id = ' . $_POST['id']);
  $statement->execute();
  header('Location: visitors.php');
}
else {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('SELECT * FROM zaznamy_hostu WHERE id = '
      . $_GET['id']);
  $statement->execute();
  $resultEdit = $statement->fetch();
}
?>
<form action="" method="post">
	<input value="<?= $resultEdit['datum'] ?>"
	       class="form-control my-3"
	       name="date" type="text"
	       placeholder="Nadpis" required>
	<input value="<?= $resultEdit['prezdivka'] ?>" class="form-control my-3"
	       name="author" type="text"
	       placeholder="Přezdívka" required>
	<input value="<?= $resultEdit['email'] ?>" class="form-control my-3"
	       name="email" type="email"
	       placeholder="Email" required>
	<textarea class="form-control my-3" name="text" rows="10" placeholder="Text"
	          required><?= $resultEdit['text'] ?></textarea><br>
	<input type="hidden" name="id" value="<?= $_GET['id'] ?>">
	<input class="btn btn-outline-success my-3" value="Aktualizovat záznam"
	       type="submit">
</form>
