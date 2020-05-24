<?php
include 'includes/utilities.php';
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.php' ?>
	<title><?= formatTitle('Záznamy hostů') ?></title>
</head>
<body>
<?php include 'includes/header.php' ?>
<?php include 'includes/navigation.php' ?>
<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-8 border">
          <?php
          $statement = Database::getInstance()
            ->getConnection()
            ->prepare('SELECT * FROM zaznamy_hostu');
          $statement->execute();
          $result = $statement->fetchAll();

          if (isset($_GET['action'])) {
            if ($_GET['action'] == 'create') {
              include 'includes/db-manipulation/createZaznamHostu.php';
            }
			elseif ($_GET['action'] == 'delete') {
              if (isLoggedIn()) {
                $statement = Database::getInstance()
                  ->getConnection()
                  ->prepare('DELETE FROM zaznamy_hostu WHERE id= '
                    . $_GET['id']);
                $statement->execute();
                header('Location: ' . $_SERVER['HTTP_REFERER']);
              }
            }
			elseif ($_GET['action'] == 'edit') {
              if (isLoggedIn()) {
                include 'includes/db-manipulation/editZaznamHostu.php';
              }
            }
          }
          else {
            if (isLoggedIn()) {
              if (isset($_GET['individual'])) {
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
              else {
                foreach ($result as $item) {
                  printHostZaznamAdmin($item['id'], $item['datum'],
                    $item['prezdivka'],
                    $item['email'], $item['text']);
                }
              }
            }
            else {
              if (isset($_GET['individual'])) {
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
              else {
                foreach ($result as $item) {
                  printHostZaznam($item['datum'], $item['prezdivka'],
                    $item['email'], $item['text']);
                }
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
			<a href="?action=create">Vytvořit záznam</a>
		</div>
	</div>
</div>
<?php include 'includes/footer.php' ?>
</body>
</html>