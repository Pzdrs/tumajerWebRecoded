<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.inc.php' ?>
	<title><?= formatTitle('Úvod') ?></title>
</head>
<body>
<?php include 'includes/header.inc.php' ?>
<?php include 'includes/navigation.inc.php' ?>
<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-8 border">
          <?php
          $statement = Database::getInstance()
            ->getConnection()
            ->prepare('SELECT * FROM uvod');
          $statement->execute();
          $result = $statement->fetchAll();

          if (!isset($_POST['editId'])) {
            if (!isLoggedIn()) {
              foreach ($result as $item) {
                printUvod($item['text']);
              }
            }
            else {
              foreach ($result as $item) {
                printUvodAdmin($item['text'], $item['datum'], $item['id']);
              }
            }
          }
          else {
            $statement = Database::getInstance()
              ->getConnection()
              ->prepare('SELECT * FROM uvod WHERE id = ' . $_POST['editId']);
            $statement->execute();
            $resultIndividual = $statement->fetch();

            echo '<form action="editUvod.php" method="post">
			<textarea rows="10" class="form-control mb-3" name="text">'
              . $resultIndividual['text'] . '</textarea>
			<input type="hidden" name="id" value="' . $_POST['editId'] . '">
			<input class="btn btn-outline-success form-control" type="submit" value="Upravit záznam">
		</form>';
          }
          ?>
		</div>
		<div class="col-4 border">
			reklama logo nevim
		</div>
	</div>
</div>
<?php include 'includes/footer.inc.php' ?>
</body>
</html>