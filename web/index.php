<?php

  session_start();

  //get the functions library
  require_once 'library/functions.php';

  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }
  $navList = getNavlist($action);


  switch ($action){
    case 'home':
      include 'view/assignments.php';
      break;
    case 'assignments':
      include 'view/assignments.php';
      break;
    case 'about':
      include 'view/about.php';
      break;
    default:
      include 'view/assignments.php';
  }
?>