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
      $articleContent = getTypesTable();
      $searchFields = getSearch("types", null, null);
      break;
    case 'newuser':
      break;
    case 'saveuser':
      break;
    case 'managetypes':
      $callPage = './views/admin.php';
      $articleContent = getTypesTable();
      $searchFields = getSearch("types", null, null);
      break;
    case 'managefrequencies':
      $callPage = './views/admin.php';
      $articleContent = getFrequenciesTable();
      $searchFields = getSearch("frequencies", null, null);
      break;
    case 'managecategories':
      $callPage = './views/admin.php';
      $articleContent = getCategoriesTable();
      $searchFields = getSearch("categories", null, null);
      break;
    case 'manageusers':
      $callPage = './views/admin.php';
      $articleContent = getUserTable();
      $searchFields = '';
      break;
    case 'filterTypes':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $articleContent = getTypesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("types", $search, $status);
      break;
    case 'filterFrequencies':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $articleContent = getFrequenciesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("frequencies", $search, $status);
      break;
    case 'filterCategories':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $articleContent = getCategoriesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("categories", $search, $status);
      break;
    case 'removetype':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //get the id to be removed
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      removeType($id);
      $articleContent = getTypesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("types", $search, $status);
      break;
    case 'restoretype':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //get the id to be removed
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      restoreType($id);
      $articleContent = getTypesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("types", $search, $status);
      break;
    case 'removecategory':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //get the id to be removed
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      removeCategory($id);
      $articleContent = getCategoriesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("categories", $search, $status);
      break;
    case 'restorecategory':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //get the id to be removed
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      restoreCategory($id);
      $articleContent = getCategoriesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("categories", $search, $status);
      break;
    case 'removefrequency':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //get the id to be removed
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      removeFrequency($id);
      $articleContent = getFrequenciesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("frequencies", $search, $status);
      break;
    case 'restorefrequency':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //get the id to be removed
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      restoreFrequency($id);
      $articleContent = getFrequenciesTable($search, $status);
      $callPage = './views/admin.php';
      $searchFields = getSearch("frequencies", $search, $status);
      break;
    default:
      $callPage =  'views/login.php';
      break;
  }
  $navList = getNavlist($action);
  include $callPage;

?>