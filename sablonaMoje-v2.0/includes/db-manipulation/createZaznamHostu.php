<?php
if (isset($_POST['prezdivka'])) {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('INSERT INTO zaznamy_hostu VALUES(null, now(), "'
      . $_POST['prezdivka'] . '", "' . $_POST['email'] . '", "' . $_POST['text']
      . '")');
  $statement->execute();
  header('Location: visitors.php');
}
?>
<form action="" method="post">
	<input class="form-control my-3" name="prezdivka" type="text"
	       placeholder="Prezdivka" required>
	<input class="form-control my-3" name="datum" type="date"
	       placeholder="Datum" required>
	<input class="form-control my-3" name="email" type="email"
	       placeholder="Email" required>
	<textarea class="form-control my-3" name="text" rows="10"
	          placeholder="Text"
	          required></textarea><br>
	<input class="btn btn-outline-success my-3"
	       value="Vytvořit záznam"
	       type="submit">
</form>
