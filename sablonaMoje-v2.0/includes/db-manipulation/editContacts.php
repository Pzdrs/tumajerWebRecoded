<?php
if (!isset($_POST['id'])) {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('SELECT * FROM kontakty WHERE id = ' . $_GET['id']);
  $statement->execute();
  $resultIndividual = $statement->fetch();
}
else {
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('UPDATE kontakty SET jmeno = "' . $_POST['name']
      . '", prijmeni = "' . $_POST['surname'] . '", email = "'
      . $_POST['email'] . '", telefon = "' . $_POST['phone']
      . '", adresaStat = "' . $_POST['state'] . '", adresaMesto = "'
      . $_POST['city'] . '", adresaUlice = "' . $_POST['street']
      . '", hodnost = "' . $_POST['title'] . '" WHERE id = ' . $_GET['id']);
  $statement->execute();
  header('Location: contacts.php');
}
?>
<form action="" method="post">
	<input value="<?= $_GET['id'] ?>" type="hidden" name="id">
	<input value="<?= $resultIndividual['jmeno'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Jméno"
	       name="name">
	<input value="<?= $resultIndividual['prijmeni'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Příjmení"
	       name="surname">
	<input value="<?= $resultIndividual['email'] ?>" type="email"
	       class="form-control my-3"
	       placeholder="Email"
	       name="email">
	<input value="<?= $resultIndividual['telefon'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Telefon"
	       name="phone">
	<input value="<?= $resultIndividual['adresaStat'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Stát"
	       name="state">
	<input value="<?= $resultIndividual['adresaMesto'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Město"
	       name="city">
	<input value="<?= $resultIndividual['adresaUlice'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Ulice"
	       name="street">
	<input value="<?= $resultIndividual['hodnost'] ?>" type="text"
	       class="form-control my-3"
	       placeholder="Hodnost"
	       name="title">
	<input type="submit" class="btn btn-outline-success my-3"
	       value="Upravit záznam">
</form>
