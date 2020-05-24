<?php
$statement = Database::getInstance()
  ->getConnection()
  ->prepare('SELECT * FROM navigation WHERE id = ' . $_GET['item']);
$statement->execute();
$item      = $statement->fetch();
$statement = Database::getInstance()
  ->getConnection()
  ->prepare('SELECT * FROM navigation');
$statement->execute();
$items = $statement->fetchAll();

if (isset($_GET['displayName'])) {
  $displayName = $_GET['displayName'];
  $url         = $_GET['url'];
  $show        = $_GET['show'];
  if ($_GET['delete'] == getConfig('navItemDeleteConfirmationWord')) {
    $statement = Database::getInstance()
      ->getConnection()
      ->prepare('DELETE FROM navigation WHERE id = ' . $_GET['item']);
    $statement->execute();
  }
  else {
    $statement = Database::getInstance()
      ->getConnection()
      ->prepare('UPDATE navigation SET 
displayName = "' . $displayName . '",
url = "' . $url . '",
enabled = ' . $show .
        ' WHERE id = ' . $_GET['item']);
    $statement->execute();
  }
  header('Location: menuEdit.php');
}
?>
<form class="my-3" action="" method="get">
	<input type="hidden" name="item" value="<?= $_GET['item'] ?>">
	<div class="menuEditSection">
		<label>Jméno itemu</label>
		<div class="input-group">
			<input name="displayName" class="form-control" type="text"
			       value="<?= $item['displayName'] ?>">
		</div>
	</div>
	<div class="menuEditSection">
		<label>Odkaz</label>
		<div class="input-group">
			<input class="form-control" type="text" name="url"
			       value="<?= $item['url'] ?>">
		</div>
	</div>
	<div class="menuEditSection">
		<label>Zobrazit</label>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="show"
			       value="true" <?= ($item['enabled'] == TRUE ? 'checked'
              : '') ?>>
			<label class="form-check-label">Ano</label>
		</div>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="show"
			       value="false" <?= ($item['enabled'] == TRUE ? ''
              : 'checked') ?>>
			<label class="form-check-label">Ne</label>
		</div>
	</div>
	<div class="menuEditSection">
		<label>Smazat item</label>
		<div class="input-group">
			<input name="delete" class="form-control" type="text"
			       placeholder='<?= ($item['removable']
                     ? 'Napiš "sosam si to" pro vymazání po aktualizaci itemu'
                     : 'Tento item nelze smazat') ?>' <?= ($item['removable']
              ? '' : 'readonly') ?>>
		</div>
	</div>
	<div class="menuEditSection">
		<div class="input-group">
			<input class="btn btn-outline-success form-control"
			       value="Upravit item" type="submit">
		</div>
	</div>
</form>