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
  $tabs = '';
  switch($action){
    case 'login':
      $navSelect='dashboard';
      $callPage = 'views/login.php';
      break;
    case 'logout':
      break;
    case 'submitlogin':
      break;
    case 'dashboard':
      $callPage = "./views/dashboard.php";
      $navSelect='dashboard';
      break;
    case 'admin':
      $tabs = getTabs('admin', 'types');
      $callPage =  './views/admin.php';
      $articleContent = getTypesTable();
      $searchFields = getSearch("types", null, null);
      $navSelect='admin';
      break;
    case 'newuser':
      break;
    case 'saveuser':
      break;
    case 'managetypes':
      $tabs = getTabs('admin', 'types');
      $callPage = './views/admin.php';
      $articleContent = getTypesTable();
      $searchFields = getSearch("types", null, null);
      $navSelect='admin';
      break;
    case 'managefrequencies':
      $tabs = getTabs('admin', 'frequencies');
      $callPage = './views/admin.php';
      $articleContent = getFrequenciesTable();
      $searchFields = getSearch("frequencies", null, null);
      $navSelect='admin';
      break;
    case 'managecategories':
      $tabs = getTabs('admin', 'categories');
      $callPage = './views/admin.php';
      $articleContent = getCategoriesTable();
      $searchFields = getSearch("categories", null, null);
      $navSelect='admin';
      break;
    case 'manageusers':
      $tabs = getTabs('admin', 'users');
      $callPage = './views/admin.php';
      $articleContent = getUserTable();
      $searchFields = '';
      $navSelect='admin';
      break;
    case 'filterTypes':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $articleContent = getTypesTable($search, $status);
      $callPage = './views/admin.php';
      $tabs = getTabs('admin', 'types');
      $searchFields = getSearch("types", $search, $status);
      $navSelect='admin';
      break;
    case 'filterFrequencies':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $articleContent = getFrequenciesTable($search, $status);
      $tabs = getTabs('admin', 'frequencies');
      $callPage = './views/admin.php';
      $searchFields = getSearch("frequencies", $search, $status);
      $navSelect='admin';
      break;
    case 'filterCategories':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $articleContent = getCategoriesTable($search, $status);
      $callPage = './views/admin.php';
      $tabs = getTabs('admin', 'categories');
      $searchFields = getSearch("categories", $search, $status);
      $navSelect='admin';
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
      $tabs = getTabs('admin', 'types');
      $searchFields = getSearch("types", $search, $status);
      $navSelect='admin';
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
      $tabs = getTabs('admin', 'types');
      $searchFields = getSearch("types", $search, $status);
      $navSelect='admin';
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
      $tabs = getTabs('admin', 'categories');
      $searchFields = getSearch("categories", $search, $status);
      $navSelect='admin';
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
      $tabs = getTabs('admin', 'categories');
      $searchFields = getSearch("categories", $search, $status);
      $navSelect='admin';
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
      $tabs = getTabs('admin', 'frequencies');
      $searchFields = getSearch("frequencies", $search, $status);
      $navSelect='admin';
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
      $tabs = getTabs('admin', 'frequencies');
      $searchFields = getSearch("frequencies", $search, $status);
      $navSelect='admin';
      break;
    default:
      $callPage =  'views/login.php';
      break;
  }
  $navList = getNavlist($navSelect);
  include $callPage;
?>