<footer class="py-2 text-center fixed-bottom <?php
switch ($_COOKIE['style']) {
  case 'STYLE_DARK':
    echo 'bg-dark text-light';
    break;
  case 'STYLE_LIGHT':
    echo 'bg-light text-dark';
    break;
  default:
    echo 'bg-primary text-light';
    break;
}
?>">
	<span class="my-auto"><?= getConfig('site_name') ?> &COPY; <?= date('Y',
        time()) ?>
  <?php
  if (isset($_GET['style'])) {
    setcookie('style', $_GET['style']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
  ?>
	<form class="float-right mr-3" action="" method="get">
		<select class="form-control" name="style"
		        onchange="this.form.submit()">
			<option value="STYLE_DEFAULT" <?= isset($_COOKIE['style'])
            && $_COOKIE['style'] == 'STYLE_DEFAULT' ? 'selected' : '' ?>>
				Základní styl
			</option>
			<option value="STYLE_DARK" <?= isset($_COOKIE['style'])
            && $_COOKIE['style'] == 'STYLE_DARK' ? 'selected' : '' ?>>Tmavý
				styl
			</option>
			<option value="STYLE_LIGHT" <?= isset($_COOKIE['style'])
            && $_COOKIE['style'] == 'STYLE_LIGHT' ? 'selected' : '' ?>>
				Světlý styl
			</option>
		</select>
	</form></span>
</footer>