<?php
include 'includes/utilities.php';
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.php' ?>
	<title><?= formatTitle('Úvod') ?></title>
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
            ->prepare('SELECT * FROM uvod');
          $statement->execute();
          $result = $statement->fetchAll();


          if (isset($_GET['action'])) {
            if ($_GET['action'] == 'edit') {
              include 'includes/db-manipulation/editUvod.php';
            }
          }
          else {
            if (isLoggedIn()) {
              foreach ($result as $item) {
                printUvodAdmin($item['text'], $item['datum'], $item['id']);
              }
            }
            else {
              foreach ($result as $item) {
                printUvod($item['text']);
              }
            }
          }
          ?>
		</div>
		<div class="col-4 border">
			reklama logo nevim
		</div>
	</div>
</div>
<?php include 'includes/footer.php' ?>
</body>
</html>