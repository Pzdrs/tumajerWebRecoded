<?php
function getConfig($section) {
  return parse_ini_file('assets/config.ini')[$section];
}

function formatTitle($title) {
  return $title . ' | ' . getConfig('site_name');
}

function active($page) {
  if (basename($_SERVER['SCRIPT_FILENAME']) == $page) {
    return 'active';
  }
}

function isLoggedIn() {
  return !empty($_SESSION['loggedIn']);
}

function printUvod($text) {
  echo '<div class="border text-center my-3 p-3">'
    . $text
    . '</div>';
}

function printUvodAdmin($text, $date, $id) {
  echo '<div class="border text-center my-3 p-3">'
    . '<h5>'
    . '#' . $id . ' | '
    . $date
    . '</h5>'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="edit">'
    . '<input class="btn btn-outline-success mr-2" type="submit" value="Upravit uvod #'
    . $id
    . '">'
    . '</form>'
    . $text
    . '</div>';
}

function printNovinka($id, $title, $date, $author, $text) {
  echo '<div class="border my-3 p-3">'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . substr($text, 0, 15) . '...' . '<a href="?individual=' . $id
    . '">číst dále</a>'
    . '<br><div class="text-right">' . $date . ', ' . $author . '</div>'
    . '</div>';
}

function printFullNovinka($title, $date, $author, $text, $file) {
  echo '<div class="border my-3 p-3">'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . $text
    . '<br><b>Files:</b><br>'
    . '<a href="' . $file . '" target="_BLANK">' . substr($file, 10) . '</a>'
    . '<br><div class="text-right">' . $date . ', ' . $author . '</div>'
    . '</div>';
}

function printNovinkaAdmin($id, $title, $date, $author, $text) {
  echo '<div class="border my-3 p-3">'
    . '<div class="row">'
    . '<div class="col-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="delete">'
    . '<input class="btn btn-outline-danger mr-2" type="submit" value="Odstranit novinku #'
    . $id
    . '">'
    . '</form>'
    . '</div>'
    . '<div class="col-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="edit">'
    . '<input class="btn btn-outline-success mr-2" type="submit" value="Upravit novinku #'
    . $id
    . '">'
    . '</form>'
    . '</div>'
    . '</div>'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . substr($text, 0, 15) . '...' . '<a href="?individual=' . $id
    . '">číst dále</a>'
    . '<br><div class="text-right">' . $date . ', ' . $author . '</div>'
    . '</div>';
}

function printFullNovinkaAdmin($id, $title, $date, $author, $text, $file) {
  echo '<div class="border my-3 p-3">'
    . '<div class="row">'
    . '<div class="col-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="delete">'
    . '<input class="btn btn-outline-danger mr-2" type="submit" value="Odstranit novinku #'
    . $id
    . '">'
    . '</form>'
    . '</div>'
    . '<div class="col-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="edit">'
    . '<input class="btn btn-outline-success mr-2" type="submit" value="Upravit novinku #'
    . $id
    . '">'
    . '</form>'
    . '</div>'
    . '</div>'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . $text
    . '<br><b>Files:</b><br>'
    . '<a href="' . $file . '" target="_BLANK">' . substr($file, 10) . '</a>'
    . '<br><div class="text-right">' . $date . ', ' . $author . '</div>'
    . '</div>';
}

function printHostZaznam($date, $author, $email, $text) {
  echo '<div class="border my-3 p-3">'
    . '<div class="text-left">'
    . $author . ' | '
    . $email . ' | '
    . $date
    . '</div>'
    . $text
    . '</div>';
}

function printHostZaznamAdmin($id, $date, $author, $email, $text) {
  echo '<div class="border my-3 p-3">'
    . '<div class="row">'
    . '<div class="col-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="delete">'
    . '<input class="btn btn-outline-danger mr-2" type="submit" value="Odstranit záznam #'
    . $id
    . '">'
    . '</form>'
    . '</div>'
    . '<div class="col-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="edit">'
    . '<input class="btn btn-outline-success mr-2" type="submit" value="Upravit záznam #'
    . $id
    . '">'
    . '</form>'
    . '</div>'
    . '</div>'
    . '<div class="text-left">'
    . $author . ' | '
    . $email . ' | '
    . $date
    . '</div>'
    . $text
    . '</div>';
}

function printFotka($item) {
  echo '<div class="col-12 col-sm-12 col-md-5 col-lg-4 my-3">
					<div class="card" style="width: 18rem;">
						<a href="' . $item['fullResPath'] . '" target="_BLANK">
							<img class="card-img-top" src="' . $item['path'] . '"
							     alt="Obrázek more">
						</a>
						<div class="card-body">
							<p class="card-text">' . $item['description'] . '</p>
						</div>
					</div>
				</div>';
}

function printFotkaAdmin($item) {
  echo '<div class="col-12 col-sm-12 col-md-5 col-lg-4 my-3">
					<div class="card" style="width: 18rem;">
						<a href="' . $item['fullResPath'] . '" target="_BLANK">
							<img class="card-img-top" src="' . $item['path'] . '"
							     alt="Obrázek more">
						</a>
						<div class="card-body">
							<p class="card-text">' . $item['description'] . '</p>
							<a href="?action=delete&&id=' . $item['id'] . '" class="btn btn-outline-danger">Odstranit</a>
						</div>
					</div>
				</div>';
}

function constructAddress($state, $town, $street) {
  return $town . '<br>' . $street . '<br>' . $state;
}

function printKontakt(
  $name,
  $surname,
  $email,
  $phone,
  $addressState,
  $addressTown,
  $addressStreet,
  $rank
) {
  echo '<div class="border my-3 p-3">'
    . '<h5 class="text-center">'
    . $name . ' ' . $surname . '<br>'
    . $rank
    . '</h5>'
    . '<span class="font-weight-bold">Email:<br></span>'
    . $email . '<br>'
    . '<span class="font-weight-bold">Telefon:<br></span>'
    . $phone . '<br>'
    . '<span class="font-weight-bold">Adresa:<br></span>'
    . constructAddress($addressState,
      $addressTown, $addressStreet)
    . '</div>';
}

function printKontaktAdmin(
  $id,
  $name,
  $surname,
  $email,
  $phone,
  $addressState,
  $addressTown,
  $addressStreet,
  $rank
) {
  echo '<div class="border my-3 p-3">'
    . '<form class="mb-3" action="" method="get">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="action" type="hidden" value="edit">'
    . '<input class="btn btn-outline-success mr-2" type="submit" value="Upravit záznam #'
    . $id
    . '">'
    . '</form>'
    . '<h5 class="text-center">'
    . $name . ' ' . $surname . '<br>'
    . $rank
    . '</h5>'
    . '<span class="font-weight-bold">Email:<br></span>'
    . $email . '<br>'
    . '<span class="font-weight-bold">Telefon:<br></span>'
    . $phone . '<br>'
    . '<span class="font-weight-bold">Adresa:<br></span>'
    . constructAddress($addressState,
      $addressTown, $addressStreet)
    . '</div>';
}

