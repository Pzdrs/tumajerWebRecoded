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
            ->prepare('SELECT * FROM kontakty');
          $statement->execute();
          $result = $statement->fetchAll();

          if (!isLoggedIn()) {
            if (!isset($_GET['individual'])) {
              foreach ($result as $item) {
                printKontakt($item['jmeno'], $item['prijmeni'], $item['email'],
                  $item['telefon'], $item['adresaStat'], $item['adresaMesto'],
                  $item['adresaUlice'], $item['hodnost']);
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
            if (!isset($_GET['individual'])) {
              foreach ($result as $item) {
                printKontaktAdmin($item['id'],
                  $item['jmeno'], $item['prijmeni'],
                  $item['email'],
                  $item['telefon'], $item['adresaStat'],
                  $item['adresaMesto'],
                  $item['adresaUlice'],
                  $item['hodnost']);
              }
            }
            else {
              $statement = Database::getInstance()
                ->getConnection()
                ->prepare('SELECT * FROM kontakty WHERE id = '
                  . $_GET['individual']);
              $statement->execute();
              $resultIndividual = $statement->fetch();

              printKontaktAdmin($resultIndividual['id'],
                $resultIndividual['jmeno'], $resultIndividual['prijmeni'],
                $resultIndividual['email'],
                $resultIndividual['telefon'], $resultIndividual['adresaStat'],
                $resultIndividual['adresaMesto'],
                $resultIndividual['adresaUlice'], $resultIndividual['hodnost']);
            }
          }
          ?>
		</div>
		<div class="col-4 border text-center">
			<h5 class="mt-3">Seznam všech kontaktů</h5>
			<hr>
			<a href="contacts.php">Všechny kontakty</a><br>
          <?php
          foreach ($result as $item) {
            echo '<a href="?individual=' . $item['id'] . '">'
              . $item['jmeno'] . ' ' . $item['prijmeni']
              . '</a><br>';
          }
          ?>
		</div>
	</div>
</div>
<?php include 'includes/footer.inc.php' ?>
</body>
</html>