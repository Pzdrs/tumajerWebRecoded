<?php
include 'includes/utilities.php';
?>
<!doctype html>
<html lang="en">
<head>
  <?php
  include 'includes/head.php';
  if (!isLoggedIn()) {
    header('Location: .');
  }
  ?>
	<title><?= formatTitle('Úprava menu') ?></title>
</head>
<body>
<?php include 'includes/header.php' ?>
<?php include 'includes/navigation.php' ?>
<div class="container-fluid">
	<div class="row mt-3">
      <?php
      $statement = Database::getInstance()
        ->getConnection()
        ->prepare('SELECT * FROM navigation');
      $statement->execute();
      $result = $statement->fetchAll();
      ?>
		<div class="col-8 border">
          <?php
          if (isset($_GET['action'])) {
            if ($_GET['action'] == "create") {
              include 'includes/db-manipulation/createMenuItem.php';
            }
          }
          else {
            echo '<form class="my-3" action="" method="get">'
              . '<label>Vyber menu item</label>'
              . '<div class="input-group">'
              . '<select name="item" class="form-control">';
            foreach ($result as $item) {
              echo '<option value="' . $item['id'] . '" '
                . (isset($_GET['item']) && $_GET['item'] == $item['id']
                  ? 'selected' : '')
                . '>'
                . $item['displayName']
                . '</option>';
            }
            echo '</select>'
              . '<div class="input-group-append">'
              . '<input type="submit" class="form-control btn btn-outline-success" value="Potvrdit">'
              . '</div>'
              . '</div>'
              . '</form>';
          }
          if (isset($_GET['item'])) {
            include 'includes /db-manipulation/editMenuItem.php';
          }
          ?>
			<hr>
		</div>
		<div class="col-4 border text-center">
			<h5 class="mt-3">Seznam všech menu itemů</h5>
			<hr>
          <?php
          foreach ($result as $item) {
            echo '<a href = "' . $item['url'] . '" > ' . $item['displayName']
              . ' </a ><br > ';
          }
          ?>
			<a href="?action=create">Vytvořit nový
				menu item</a>
		</div>
	</div>
</div>
<?php include 'includes/footer.php' ?>
</body>
</html>