<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.inc.php' ?>
	<title><?= formatTitle('Záznamy hostů') ?></title>
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
            ->prepare('SELECT * FROM zaznamy_hostu');
          $statement->execute();
          $result = $statement->fetchAll();

          if (!isLoggedIn()) {
            if (!isset($_GET['individual'])) {
              foreach ($result as $item) {
                printHostZaznam($item['datum'], $item['prezdivka'],
                  $item['email'], $item['text']);
              }
            }
            else {
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('SELECT * FROM zaznamy_hostu WHERE id = '
                  . $_GET['individual']);
              $statement->execute();
              $resultIndividual = $statement->fetch();

              printHostZaznam($resultIndividual['datum'],
                $resultIndividual['prezdivka'],
                $resultIndividual['email'], $resultIndividual['text']);
            }
          }
          else {
            if (isset($_POST['edit'])) {
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('SELECT * FROM zaznamy_hostu WHERE id = '
                  . $_POST['id']);
              $statement->execute();
              $resultEdit = $statement->fetch();

              echo '<form action="editZaznamHostu.php" method="post">
				<input value="' . $resultEdit['datum'] . '" class="form-control my-3" name="date" type="text"
				       placeholder="Nadpis" required>
				<input value="' . $resultEdit['prezdivka'] . '"  class="form-control my-3" name="author" type="text"
				       placeholder="Přezdívka" required>
				<input value="' . $resultEdit['email'] . '"  class="form-control my-3" name="email" type="email"
				       placeholder="Email" required>
				<textarea class="form-control my-3" name="text" rows="10" placeholder="Text" required>'
                . $resultEdit['text'] . '</textarea><br>
				<input type="hidden" name="id" value="' . $_POST['id'] . '">
				<input class="btn btn-outline-success my-3" value="Aktualizovat záznam"
				       type="submit">
			</form>';
            }
            if (isset($_POST['delete'])) {
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('DELETE FROM zaznamy_hostu WHERE id= ' . $_POST['id']);
              $statement->execute();
              header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

            if (!isset($_POST['edit'])) {
              if (!isset($_GET['individual'])) {
                foreach ($result as $item) {
                  printHostZaznamAdmin($item['id'], $item['datum'],
                    $item['prezdivka'],
                    $item['email'], $item['text']);
                }
              }
              else {
                $statement = Database::getInstance()
                  ->getConnection()
                  ->prepare('SELECT * FROM zaznamy_hostu WHERE id = '
                    . $_GET['individual']);
                $statement->execute();
                $resultIndividual = $statement->fetch();

                printHostZaznamAdmin($resultIndividual['id'],
                  $resultIndividual['datum'],
                  $resultIndividual['prezdivka'],
                  $resultIndividual['email'], $resultIndividual['text']);
              }
            }
          }
          ?>
		</div>
		<div class="col-4 border text-center">
			<h5 class="mt-3">Seznam všech záznamů</h5>
			<hr>
			<a href="visitors.php">Všechny záznamy</a><br>
          <?php
          foreach ($result as $item) {
            echo '<a href="?individual=' . $item['id'] . '">'
              . $item['prezdivka']
              . '</a><br>';
          }
          ?>
		</div>
	</div>
</div>
<?php include 'includes/footer.inc.php' ?>
</body>
</html>