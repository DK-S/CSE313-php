<?php
  session_start();

  require_once $_SERVER['DOCUMENT_ROOT'].'/library/functions.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/library/connections.php';

  require_once $_SERVER['DOCUMENT_ROOT'].'/models/w05model.php';
  
  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }
  $navList = getNavlist($action);
  $getTheUsers = getUserTable();
  //$getTheUsers = "<div>Help</div>";

  switch ($action){

    default:
      include $_SERVER['DOCUMENT_ROOT']."/view/w05/w05view.php";
      break;
  }
  
  ?>