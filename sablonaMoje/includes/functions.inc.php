<?php
function getConfig($section) {
  return parse_ini_file('assets/config.ini')[$section];
}

function formatTitle($title) {
  return $title . ' | ' . getConfig('site_name');
}

function active($page) {
  if (basename($_SERVER['SCRIPT_FILENAME']) == $page) {
    echo 'active';
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
    . '<form class="my-3" method="post" action=".">'
    . '<input name="editId" type="hidden" value="' . $id . '">'
    . '<input type="submit" class="btn btn-outline-success" value="Upravit uvod #'
    . $id . '">'
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

function printFullNovinka($title, $date, $author, $text) {
  echo '<div class="border my-3 p-3">'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . $text
    . '<br><div class="text-right">' . $date . ', ' . $author . '</div>'
    . '</div>';
}

function printNovinkaAdmin($id, $title, $date, $author, $text) {
  echo '<div class="border my-3 p-3">'
    . '<form class="mb-3" action="" method="post">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="delete" class="btn btn-outline-danger mr-2" type="submit" value="Odstranit novinku #'
    . $id
    . '">'
    . '<input name="edit" class="btn btn-outline-success" type="submit" value="Upravit novinku #'
    . $id
    . '">'
    . '</form>'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . substr($text, 0, 15) . '...' . '<a href="?individual=' . $id
    . '">číst dále</a>'
    . '<br><div class="text-right">' . $date . ', ' . $author . '</div>'
    . '</div>';
}

function printFullNovinkaAdmin($id, $title, $date, $author, $text) {
  echo '<div class="border my-3 p-3">'
    . '<form class="mb-3" action="editNovinka.php" method="post">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="delete" class="btn btn-outline-danger mr-2" type="submit" value="Odstranit novinku #'
    . $id
    . '">'
    . '<input name="edit" class="btn btn-outline-success" type="submit" value="Upravit novinku #'
    . $id
    . '">'
    . '</form>'
    . '<h5 class="text-center">'
    . $title
    . '</h5>'
    . $text
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
    . '<form class="mb-3" action="" method="post">'
    . '<input name="id" type="hidden" value="' . $id . '">'
    . '<input name="delete" class="btn btn-outline-danger mr-2" type="submit" value="Odstranit záznam #'
    . $id
    . '">'
    . '<input name="edit" class="btn btn-outline-success" type="submit" value="Upravit záznam #'
    . $id
    . '">'
    . '</form>'
    . '<div class="text-left">'
    . $author . ' | '
    . $email . ' | '
    . $date
    . '</div>'
    . $text
    . '</div>';
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
    . '<form class="mb-3" action="" method="post">'
    . '<input name="delete" class="btn btn-outline-danger mr-2" type="submit" value="Odstranit kontakt #'
    . $id
    . '" disabled>'
    . '<input name="edit" class="btn btn-outline-success" type="submit" value="Upravit kontakt #'
    . $id
    . '" disabled>'
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

