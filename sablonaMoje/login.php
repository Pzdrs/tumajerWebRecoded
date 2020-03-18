<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <?php include 'includes/head.inc.php' ?>
	<title><?= formatTitle('Login') ?></title>
</head>
<body>
<?php include 'includes/header.inc.php' ?>
<?php include 'includes/navigation.inc.php' ?>
<div class="container-fluid">
	<div class="row mt-5">
		<div class="col-3"></div>
		<div class="col-6">
          <?php
          if (!isLoggedIn()) {
            if (isset($_POST['password'])) {
              if (password_verify($_POST['password'],
                getConfig('administration_password'))
              ) {
                $_SESSION['loggedIn'] = TRUE;
                header('Location: ' . $_SERVER['HTTP_REFERER']);
              }
              else {
                echo '<div class="alert alert-danger">'
                  . 'Špatně zadané heslo'
                  . '</div>';
              }
            }
          }
          else {
            header('Location: index.php');
          }
          ?>
			<form action="" method="post">
				<input class="form-control mb-3" name="password" type="password"
				       placeholder="Heslo">
				<input class="btn btn-outline-success form-control"
				       type="submit" value="Příhlásit do administrace">
			</form>
		</div>
		<div class="col-3"></div>
	</div>
</div>
<?php include 'includes/footer.inc.php' ?>
</body>
</html>