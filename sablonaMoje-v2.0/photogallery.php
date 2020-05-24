<?php
include 'includes/utilities.php';
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.php' ?>
	<title><?= formatTitle('Fotogalerie') ?></title>
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
              include 'includes/db-manipulation/createPhoto.php';
            }
			elseif ($_GET['action'] == "delete") {
              if (isLoggedIn()) {
                include 'includes/db-manipulation/deletePhoto.php';
              }
            }
          }
          ?>
			<div class="row text-center">
              <?php
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('SELECT * FROM photogallery');
              $statement->execute();
              $result = $statement->fetchAll();

              if (!isset($_GET['action'])) {
                if (isLoggedIn()) {
                  foreach ($result as $item) {
                    printFotkaAdmin($item);
                  }
                }
                else {
                  foreach ($result as $item) {
                    printFotka($item);
                  }
                }
              }
              ?>

			</div>
		</div>
		<div class="col-4 border text-center">
			<h5 class="mt-3">Seznam všech obrázků</h5>
			<hr>
			<a href="photogallery.php">Všechny obrázky</a><br>
			<a href="?action=create">Vytvořit záznam</a>
		</div>
	</div>
</div>
<?php include 'includes/footer.php' ?>
</body>
</html>