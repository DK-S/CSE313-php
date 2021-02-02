<?php

  session_start();

  //get the connection library
  require_once '/library/connections.php';
  //get the functions library
  require_once 'library/functions.php';
  

  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }
  $navList = getNavlist($action);

  switch ($action){
    case 'home':
      include 'view/about.php';
      break;
    case 'assignments':
      include 'view/assignments.php';
      break;
    case 'about':
      include 'view/about.php';
      break;
    case 'w03-group';
      include 'w03-group/index.php';
      break;
    case 'w03cart';
      header("Location: /w03cart/");
      break;
    case 'w05-reading';
      header("Location: /w05-reading/");
      break;
    default:
      include 'view/about.php';
  }
?>