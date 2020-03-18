<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.inc.php' ?>
	<title><?= formatTitle('Novinky') ?></title>
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
            ->prepare('SELECT * FROM novinky');
          $statement->execute();
          $result = $statement->fetchAll();

          if (!isLoggedIn()) {
            if (!isset($_GET['individual'])) {
              foreach ($result as $item) {
                printNovinka($item['id'], $item['nadpis'], $item['datum'],
                  $item['autor'], $item['text']);
              }
            }
            else {
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('SELECT * FROM novinky WHERE id = '
                  . $_GET['individual']);
              $statement->execute();
              $resultIndividual = $statement->fetch();

              printFullNovinka($resultIndividual['nadpis'],
                $resultIndividual['datum'],
                $resultIndividual['autor'], $resultIndividual['text']);
            }
          }
          else {
            if (isset($_POST['createNews'])) {
              echo '<form action="createNews.php" method="post">
				<input class="form-control my-3" name="title" type="text"
				       placeholder="Nadpis" required>
				<input class="form-control my-3" name="author" type="text"
				       placeholder="Autor" required>
				<input class="form-control my-3" name="email" type="email"
				       placeholder="Email" required>
				<textarea class="form-control my-3" name="text" rows="10" placeholder="Text" required></textarea><br>
				<input class="btn btn-outline-success my-3" value="Vytvořit záznam"
				       type="submit">
			</form>';
            }

            if (isset($_POST['edit'])) {
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('SELECT * FROM novinky WHERE id = '
                  . $_POST['id']);
              $statement->execute();
              $resultEdit = $statement->fetch();

              echo '<form action="editNovinka.php" method="post">
				<input value="' . $resultEdit['nadpis'] . '" class="form-control my-3" name="title" type="text"
				       placeholder="Nadpis" required>
				<input value="' . $resultEdit['autor'] . '"  class="form-control my-3" name="author" type="text"
				       placeholder="Autor" required>
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
                ->prepare('DELETE FROM novinky WHERE id= ' . $_POST['id']);
              $statement->execute();
              header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

            if (!isset($_POST['edit']) && !isset($_POST['createNews'])
            ) {
              if (!isset($_GET['individual'])) {
                foreach ($result as $item) {
                  printNovinkaAdmin($item['id'], $item['nadpis'],
                    $item['datum'],
                    $item['autor'], $item['text']);
                }
              }
              else {
                $statement = Database::getInstance()
                  ->getConnection()
                  ->prepare('SELECT * FROM novinky WHERE id = '
                    . $_GET['individual']);
                $statement->execute();
                $resultIndividual = $statement->fetch();

                printFullNovinkaAdmin($resultIndividual['id'],
                  $resultIndividual['nadpis'],
                  $resultIndividual['datum'],
                  $resultIndividual['autor'], $resultIndividual['text']);
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
			<form name="addNews" action="" method="post">
				<input name="createNews" type="hidden">
				<a href=""
				   onclick="document.forms['addNews'].submit(); return false;">Vyvtořit
					záznam</a>
			</form>
		</div>
	</div>
</div>
<?php include 'includes/footer.inc.php' ?>
</body>
</html>