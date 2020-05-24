<?php
if (isset($_POST['title'])) {
  $acceptedFileTypes = ['application/pdf', 'image/jpeg'];
  $pathToAttachment  = NULL;

  if (in_array($_FILES['file']['type'], $acceptedFileTypes)) {
    if (move_uploaded_file($_FILES['file']['tmp_name'],
      'data/news/' . $_FILES['file']['name'])
    ) {
      $pathToAttachment = 'data/news/' . $_FILES['file']['name'];
    }
  }
  $statement = Database::getInstance()
    ->getConnection()
    ->prepare('INSERT INTO novinky VALUES(null, now(), "'
      . $_POST['title']
      . '", "' . $_POST['author'] . '", "' . $_POST['email'] . '", "'
      . $_POST['text'] . '", "' . $pathToAttachment . '")');
  $statement->execute();
  header('Location: news.php');
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<input class="form-control my-3" name="title" type="text"
	       placeholder="Nadpis" required>
	<input class="form-control my-3" name="author" type="text"
	       placeholder="Autor" required>
	<input class="form-control my-3" name="email" type="email"
	       placeholder="Email" required>
	<label for="exampleFormControlFile1">Upload souboru</label>
	<input name="file" type="file" class="form-control-file"
	       accept="image/jpeg, application/pdf">
	<textarea class="form-control my-3" name="text" rows="10"
	          placeholder="Text"
	          required></textarea><br>
	<input class="btn btn-outline-success my-3"
	       value="Vytvořit záznam"
	       type="submit">
</form>