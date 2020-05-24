<?php
if (!isset($_COOKIE['style'])) {
  setcookie('style', 'STYLE_DEFAULT');
}
if (!isset($_COOKIE['lang'])) {
  setcookie('lang', 'cs');
}
if (!isset($_COOKIE['agreedToCookies'])) {
  setcookie('agreedToCookies', 'false');
}