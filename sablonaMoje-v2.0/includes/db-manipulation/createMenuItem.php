<?php
if (isset($_POST['displayName'])) {
  $statement = Database::getInstance()->getConnection()
    ->prepare('INSERT INTO navigation VALUES(
null, "' . $_POST['displayName'] . '","' . $_POST['url'] . '",'
      . $_POST['enabled'] . ',' . $_POST['removable'] . ')');
  $statement->execute();
  header('Location: menuEdit.php');
}
?>
<form class="my-3" action="" method="post">
	<div class="input-group mt-3">
		<input name="displayName" type="text" class="form-control"
		       placeholder="Jméno menu itemu" required>
	</div>
	<div class="input-group mt-3">
		<input name="url" type="text" class="form-control"
		       placeholder="Adresa odkazu" required>
	</div>
	<label class="mt-3">Zobrazit</label>
	<div class="form-check">
		<input class="form-check-input" name="enabled" type="radio"
		       value="true" checked>
		<label class="form-check-label">Ano</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" name="enabled" type="radio"
		       value="false">
		<label class="form-check-label">Ne</label>
	</div>
	<label class="mt-3">Smazatelné</label>
	<div class="form-check">
		<input class="form-check-input" name="removable"
		       type="radio"
		       value="true" checked>
		<label class="form-check-label">Ano</label>
	</div>
	<div class="form-check">
		<input class="form-check-input" name="removable"
		       type="radio"
		       value="false">
		<label class="form-check-label">Ne</label>
	</div>
	<div class="input-group">
		<input type="submit"
		       class="btn btn-outline-success form-control mt-3"
		       value="Vytvořit nový menu item">
	</div>
</form>