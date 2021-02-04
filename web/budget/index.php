<?php
  session_start();

  require_once './library/connections.php';
  require_once './library/functions.php';
  require_once './models/budget.php';

  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }

  $callPage = "./views/500.php";

  switch($action){
    case 'login':
      $action = "dashboard";
      $callPage = 'views/login.php';
      break;
    case 'logout':
      break;
    case 'submitlogin':
      break;
    case 'dashboard':
      $callPage = "./views/dashboard.php";
      break;
    case 'admin':
      $callPage =  './views/admin.php';
      break;
    case 'newuser':
      break;
    case 'saveuser':
      break;
    default:
      $callPage =  'views/login.php';
      break;
  }
  $navList = getNavlist($action);
  include $callPage;

?>