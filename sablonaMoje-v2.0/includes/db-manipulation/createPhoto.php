<?php
if (isset($_FILES['file'])) {
  $acceptedTypes = ['image/jpeg', 'image/png'];

  if (in_array($_FILES['file']['type'], $acceptedTypes)
    && in_array($_FILES['fullResFile']['type'], $acceptedTypes)
  ) {
    if (move_uploaded_file($_FILES['file']['tmp_name'],
        'data/nahledy/' . $_FILES['file']['name'])
      && move_uploaded_file($_FILES['fullResFile']['tmp_name'],
        'data/foto/' . $_FILES['fullResFile']['name'])
    ) {
      $statement = Database::getInstance()
        ->getConnection()
        ->prepare('INSERT INTO photogallery VALUES(null, "'
          . $_POST['description']
          . '","data/nahledy/' . $_FILES['file']['name'] . '","data/foto/'
          . $_FILES['fullResFile']['name'] . '")');
      $statement->execute();
      header('Location: photogallery.php');
    }
  }
}
?>
<form action="" method="post" enctype="multipart/form-data"
      class="mt-3">
	<label for="file">Obrázek (náhled) - jpeg/png</label>
	<input name="file" type="file"
	       accept="image/jpeg, image/png" class="form-control"
	       required>
	<label for="file">Obrázek (plné rozlišení) - jpeg/png</label>
	<input name="fullResFile" type="file"
	       accept="image/jpeg, image/png" class="form-control"
	       required>
	<textarea class="form-control my-3" name="description"
	          rows="10"
	          placeholder="Popis obrázku"
	          required></textarea><br>
	<input class="btn btn-outline-success mb-3"
	       value="Vytvořit záznam"
	       type="submit">
</form>
