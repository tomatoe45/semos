<?php 

function __autoload($class) {
  $class = strtolower($class);

  $path = "include/{$class}.php";

  if(file_exists($path)) {
    require_once($path);
  } else {
    die("Class {$class}.php not found");
  }
}

function redirect($location) {
  header("Location: {$location}");
}


?>