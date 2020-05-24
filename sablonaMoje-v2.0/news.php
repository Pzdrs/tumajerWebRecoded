<?php
include 'includes/utilities.php';
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.php' ?>
	<title><?= formatTitle('Novinky') ?></title>
</head>
<body>
<?php include 'includes/header.php' ?>
<?php include 'includes/navigation.php' ?>
<div class="container-fluid">
	<div class="row mt-3">
		<div class="col-8 border">
          <?php
          if (isset($_GET['action'])) {
            if ($_GET['action'] == "create") {
              include 'includes/db-manipulation/createNews.php';
            }
			elseif ($_GET['action'] == "delete") {
              if (isLoggedIn()) {
                include 'includes/db-manipulation/deleteNews.php';
              }
            }
			elseif ($_GET['action'] == "edit") {
              if (isLoggedIn()) {
                include 'includes/db-manipulation/editNews.php';
              }
            }
          }

          $statement = Database::getInstance()
            ->getConnection()
            ->prepare('SELECT * FROM novinky');
          $statement->execute();
          $result = $statement->fetchAll();
          if (!isset($_GET['action'])) {
            if (isLoggedIn()) {
              if (isset($_GET['individual'])) {
                $statement = Database::getInstance()
                  ->getConnection()
                  ->prepare('SELECT * FROM novinky WHERE id = '
                    . $_GET['individual']);
                $statement->execute();
                $resultIndividual = $statement->fetch();

                printFullNovinkaAdmin($resultIndividual['id'],
                  $resultIndividual['nadpis'],
                  $resultIndividual['datum'],
                  $resultIndividual['autor'], $resultIndividual['text'], $resultIndividual['file']);
              }
              else {
                foreach ($result as $item) {
                  printNovinkaAdmin($item['id'], $item['nadpis'],
                    $item['datum'],
                    $item['autor'], $item['text']);
                }
              }
            }
            else {
              if (isset($_GET['individual'])) {
                $statement = Database::getInstance()
                  ->getConnection()
                  ->prepare('SELECT * FROM novinky WHERE id = '
                    . $_GET['individual']);
                $statement->execute();
                $resultIndividual = $statement->fetch();

                printFullNovinka($resultIndividual['nadpis'],
                  $resultIndividual['datum'],
                  $resultIndividual['autor'], $resultIndividual['text'], $resultIndividual['file']);
              }
              else {
                foreach ($result as $item) {
                  printNovinka($item['id'], $item['nadpis'], $item['datum'],
                    $item['autor'], $item['text']);
                }
              }
            }
          }
          ?>
		</div>
		<div class="col-4 border text-center">
			<h5 class="mt-3">Seznam všech novinek</h5>
			<hr>
			<a href="news.php">Všechny novinky</a><br>
          <?php
          foreach ($result as $item) {
            echo '<a href="?individual=' . $item['id'] . '">' . $item['nadpis']
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