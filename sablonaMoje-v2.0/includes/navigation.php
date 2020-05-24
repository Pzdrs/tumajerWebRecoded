<nav class="navbar navbar-expand-sm <?php
switch ($_COOKIE['style']) {
  case 'STYLE_DARK':
    echo 'navbar-dark bg-dark';
    break;
  case 'STYLE_LIGHT':
    echo 'navbar-light bg-light';
    break;
  default:
    echo 'navbar-dark bg-primary';
    break;
}
?>">
	<a class="navbar-brand" href="."><?= getConfig('site_name') ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
	        data-target="#navbarSupportedContent"
	        aria-controls="navbarSupportedContent" aria-expanded="false"
	        aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
          <?php
          $statement = Database::getInstance()
            ->getConnection()
            ->prepare('SELECT * FROM navigation');
          $statement->execute();
          $navigation = $statement->fetchAll();

          foreach ($navigation as $item) {
            echo '<li class="nav-item' . active($item['url']) . '">'
              . '<a class="nav-link btn ' . ($item['enabled'] == FALSE
                ? 'disabled' : '') . '' . (basename($_SERVER['PHP_SELF'])
              == $item['url'] ? 'active' : '') . '" href="' . $item['url']
              . '">'
              . $item['displayName'] . '</a>'
              . '</li>';
          }
          ?>
          <?php
          if (isLoggedIn()) {
            echo '<li class="nav-item">
				<a class="nav-link btn ' . (basename($_SERVER['PHP_SELF'])
              == 'menuEdit.php' ? 'active' : '') . '" href="menuEdit.php">Upravit menu</a>
			</li>';
          }
          ?>
		</ul>
		<form action="search.php" method="get" class="mr-3 my-auto">
			<div class="input-group">
				<input type="text" class="form-control"
				       placeholder="Search for a phrase" name="search">
				<input type="submit" class="btn <?php
                switch ($_COOKIE['style']) {
                  case 'STYLE_DARK':
                    echo 'btn-outline-light';
                    break;
                  case 'STYLE_LIGHT':
                    echo 'btn-outline-dark';
                    break;
                  default:
                    echo 'btn-outline-light';
                    break;
                }
                ?> ml-1"
				       value="Search">
			</div>
		</form>
      <?php
      if (isLoggedIn()) {
        echo '<form action="logout.php" class="my-auto">
			<input class="btn btn-outline-danger" type="submit" value="Odhlásit se">
		</form>';
      }
      else {
        echo '<form action="login.php" class="my-auto">
			<input class="btn ';
        switch ($_COOKIE['style']) {
          case 'STYLE_DARK':
            echo 'btn-outline-light';
            break;
          case 'STYLE_LIGHT':
            echo 'btn-outline-dark';
            break;
          default:
            echo 'btn-outline-light';
            break;
        }
        echo '" type="submit" value="Přihlásit se">
		</form>';
      }

      ?>
	</div>
</nav>

