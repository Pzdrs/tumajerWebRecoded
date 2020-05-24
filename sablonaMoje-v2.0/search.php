<?php
include 'includes/utilities.php';
if (!isset($_GET['search'])) {
  header('Location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.php' ?>
  <title><?= formatTitle('Vyhledávání') ?></title>
</head>
<body>
<?php include 'includes/header.php' ?>
<?php include 'includes/navigation.php' ?>
<div class="container-fluid">
  <div class="row mt-3">
    <div class="col-2">
    </div>
    <div class="col-8">
     <div class="alert alert-warning text-center">No results were found for "<?= $_GET['search'] ?>".</div>
    </div>
    <div class="col-2">
    </div>
  </div>
</div>
<?php include 'includes/footer.php' ?>
</body>
</html>