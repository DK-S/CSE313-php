<?php

  session_start();

  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }

  switch ($action){
    case 'home':
      include 'view/home.php';
      break;
    case 'assignments':
      include 'view/assignments.php';
      break;
    default:
      include 'view/home.php';
  }
?>