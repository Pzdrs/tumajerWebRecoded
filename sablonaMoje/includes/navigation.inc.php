<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
	<a class="navbar-brand" href="."><?= getConfig('site_name') ?></a>
	<button class="navbar-toggler" type="button" data-toggle="collapse"
	        data-target="#navbarSupportedContent"
	        aria-controls="navbarSupportedContent" aria-expanded="false"
	        aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item <?php active('index.php'); ?>">
				<a class="nav-link" href=".">Home</a>
			</li>
			<li class="nav-item <?php active('news.php'); ?>">
				<a class="nav-link" href="news.php">Novinky</a>
			</li>
			<li class="nav-item <?php active('visitors.php'); ?>">
				<a class="nav-link" href="visitors.php">Záznamy hostů</a>
			</li>
			<li class="nav-item <?php active('contacts.php'); ?>">
				<a class="nav-link" href="contacts.php">Kontakty</a>
			</li>
		</ul>
      <?php

      if (isLoggedIn()) {
        echo '<form action="logout.php">
			<input class="btn btn-outline-danger" type="submit" value="Odhlásit se">
		</form>';
      }
      else {
        echo '<a href="login.php"><button class="btn btn-outline-light">Přihlásit se</button></a>';
      }
      ?>
	</div>
</nav>

