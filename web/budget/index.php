<?php
  session_start();
//var_dump($_SESSION);
  $_SESSION['message']='';
  
  //echo !isset($_SESSION['bmonth']);
  if(!isset($_SESSION['loggedin'])){$_SESSION['loggedin'] = false;}
  if(isset($_SESSION['bmonth'])){$bmonth=$_SESSION['bmonth'];}else{$bmonth=0;}
  if(isset($_SESSION['expand'])){$expand=$_SESSION['expand'];}else{$expand='0000';}
  //var_dump($_SESSION['bmonth']);
  require_once './library/connections.php';
  require_once './library/functions.php';
  require_once './models/budget.php';
  
  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }
  //var_dump($action);
  //defaults for page content
  $callPage = "./views/500.php";
  $navSelect='';
  $searchFields = '';
  $articleContent = '';
  if(isset($_SESSION['userData'])){$header = getHeader($_SESSION['userData']);}else{$header = getHeader();}
  $tabs = '';
  if(!$action){$action='gotoBudget';}
  //check to see if user is logged in. If not then redirect the action to login

  if($action=='newuser' || $action=='saveuser' ||  $action=='submitlogin'){
  }else{
    if(isset($_SESSION['loggedin'])){
      if(!$_SESSION['loggedin']){
        $action = 'login';
      }
    }else{
      $action = 'login';
    }
  }
  
  switch($action){
    case 'login':
      $navSelect='dashboard';
      $callPage = 'views/login.php';
      break;
    case 'logout':
      //echo "help";
      session_destroy();
      header('Location: /budget/');
            
      break;
    case 'submitlogin':
      $navSelect='dashboard';
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $checkEmail = checkEmail($username);
      $checkPassword = checkPassword($password);
      if (empty($checkEmail) || empty($checkPassword)){
        $_SESSION['message']= "<p>Please provide a valid username and password.</p>";
        $navSelect='dashboard';
        $callPage = 'views/login.php';
        break;
      }
      $userData = getUserData($username);
      $hashCheck = password_verify($password, $userData['password']);

      if (!$hashCheck){
        $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
        $callPage = 'views/login.php';
        break;
      }
      if (!$userData['active']){
        $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
        $callPage = 'views/login.php';
        break;
      }
      $_SESSION['loggedin'] = TRUE;
      array_pop($userData);
      $_SESSION['userData'] = $userData;
      $_SESSION['message'] = '';
      setcookie('firstname', $userData['firstname'], strtotime('+1 year'), '/');
      if($userData['administrator']){
        $callPage = "./views/admin.php";
        $navSelect='admin';
        $searchFields = getSearch("types", null, null);
        $articleContent = getTypesTable();
        $tabs = getTabs('admin', 'types');
      }else{
        $callPage = "./views/admin.php";
        $navSelect='dashboard';
        $searchFields = '';
        $articleContent = getBudgetTable();
        $addSection = getAddSection('addTransaction');
        $header = getHeader($userData);
        $tabs = getTabs('budget', 'budget');
      }

      break;
    case 'dashboard':
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $tabs = getTabs('budget', 'budget');
      $searchFields = "";
      $articleContent = getBudgetTable($expand);
      $addSection = getAddSection('addTransaction');
      break;
    case 'admin':
      $tabs = getTabs('admin', 'types');
      $callPage =  './views/admin.php';
      $articleContent = getTypesTable();
      $searchFields = getSearch("types", null, null);
      $navSelect='admin';
      break;
    case 'newuser':
      $navSelect='admin';
      $searchFields ='';
        $callPage = './views/admin.php';
        $articleContent = getEditUser();
      break;
    case 'saveuser':
      $navSelect='dashboard';
      $callPage = './views/admin.php';
      $firstName = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
      $lastName = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
      $userName = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $checkEmail = checkEmail($userName);
      $checkPassword = checkPassword($password);
      $existingEmail = emailExists($userName);
      if ($existingEmail){
        $_SESSION['message'] = '<p class="notice">That email currently exists. Do you want to login instead?</p>';
        $callPage = 'views/login.php';
        break;
      }
      if(empty($firstName) || empty($lastName) || empty($checkEmail)){
        $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
        $callPage = './views/admin.php';
        $articleContent = getEditUser();
        break;
      }

      if($checkPassword==0){
        $_SESSION['message'] = '<p>Password does not meet the complexity requirements. You must have 8 characters with at least 1 of each: a capital letter, lowercaser letter, and special character.</p>';
        $callPage = './views/admin.php';
        $articleContent = getEditUser();
        break;
      }
      
      $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
      $regoutcome = registerUser($firstName, $lastName, $userName, $hashedPwd);
      if ($regoutcome===1){
        $_SESSION['message'] = "Thanks for registering $firstName. Please use your email and password to login.";
        setcookie('firstname', $firstName, strtotime('+1 year'), '/');
        $callPage = './views/login.php';
        $articleContent = getTypesTable();
        $searchFields = getSearch("types", null, null);
      }
      

      break;
    case 'removeuser':
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      removeUser($id);
      $tabs = getTabs('admin', 'users');
      $callPage = './views/admin.php';
      $articleContent = getUserTable($_SESSION['userData']);
      $searchFields = '';
      $navSelect='admin';
      break;
    case 'restoreuser':
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      restoreUser($id);
      $tabs = getTabs('admin', 'users');
      $callPage = './views/admin.php';
      $articleContent = getUserTable($_SESSION['userData']);
      $searchFields = '';
      $navSelect='admin';
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
      $articleContent = getUserTable($_SESSION['userData']);
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
    case 'gotoBudget':
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = "";
      $articleContent = getBudgetTable($expand);
      $addSection = getAddSection('addTransaction');
      
      break;
    case 'expandbudget':
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = "";
      
      $expand = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
      $_SESSION['expand']=$expand;
      //var_dump($expand);
      $articleContent = getBudgetTable($expand);
      $addSection = getAddSection('addTransaction');
    
      break;
    case 'collapsebudget':
      $_SESSION['expand'] = '0000';
      $expand = '0000';
      //var_dump($_SESSION);
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = "";
      $articleContent = getBudgetTable($expand);
      
      $addSection = getAddSection('addTransaction');
      
      break;
    case 'gotoAccounts':
      $tabs = getTabs('budget', 'accounts');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $articleContent = getAccountsTable($_SESSION['userData']['id']);
      $addSection = getAddSection('addAccounts');
      //var_dump($articleContent);
      break;
    case 'gotoaddAccounts':
      $tabs = getTabs('budget', 'accounts');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $articleContent = '';
      $addSection = getAddSection('gotoaddAccounts');  
      break;
    case 'addAccount':
      $tabs = getTabs('budget', 'accounts');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $accountName = filter_input(INPUT_POST, 'accountName', FILTER_SANITIZE_STRING);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
      $accounttypeid = filter_input(INPUT_POST, 'accounttypeid', FILTER_SANITIZE_NUMBER_INT);
      $accountfrequencyid = filter_input(INPUT_POST, 'accountfrequencyid', FILTER_SANITIZE_NUMBER_INT);
      $accountcategoryid = filter_input(INPUT_POST, 'accountcategoryid', FILTER_SANITIZE_NUMBER_INT);
      $accountsubcategoryid = filter_input(INPUT_POST, 'accountsubcategoryid', FILTER_SANITIZE_NUMBER_INT);
      $subcategorycode = filter_input(INPUT_POST, 'subcategorycode', FILTER_SANITIZE_NUMBER_INT);

      $rows = addAccount($accountName, $description, $_SESSION['userData']['id'], $accounttypeid, $accountfrequencyid, $accountcategoryid, $accountsubcategoryid, $subcategorycode);
      if($rows > 0){
        $_SESSION['message']="Failed to add the data. Please verify and try again";
        $articleContent = getAccountsTable($_SESSION['userData']['id']);
        $addSection = getAddSection('addAccounts');  
      }else{
        $articleContent = '';
        $addSection = getAddSection('gotoaddAccounts');
      }
      break;   
    case 'editAccount':
      $tabs = getTabs('budget', 'accounts');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $accountid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      $articleContent = getEditAccountsContent($accountid);
      break;
    case 'removeAccount':
      $tabs = getTabs('budget', 'accounts');
      $accountid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      $account = getAccount($accountid);
      if($account['active']){removeAccount($accountid);}else{restoreAccount($accountid);}
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $articleContent = getAccountsTable($_SESSION['userData']['id']);
      $addSection = getAddSection('addAccounts');
      break;
    case 'saveAccount':
      $tabs = getTabs('budget', 'accounts');
      $accountid = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      $accountName = filter_input(INPUT_POST, 'accountName', FILTER_SANITIZE_STRING);
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
      $accounttypeid = filter_input(INPUT_POST, 'accounttypeid', FILTER_SANITIZE_NUMBER_INT);
      $accountfrequencyid = filter_input(INPUT_POST, 'accountfrequencyid', FILTER_SANITIZE_NUMBER_INT);
      $accountcategoryid = filter_input(INPUT_POST, 'accountcategoryid', FILTER_SANITIZE_NUMBER_INT);
      $accountsubcategoryid = filter_input(INPUT_POST, 'accountsubcategoryid', FILTER_SANITIZE_NUMBER_INT);
      $subcategorycode = filter_input(INPUT_POST, 'subcategorycode', FILTER_SANITIZE_NUMBER_INT);
      saveAccount($accountid, $accountName, $description, $accounttypeid, $accountfrequencyid, $accountcategoryid, $accountsubcategoryid, $subcategorycode);
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $articleContent = getAccountsTable($_SESSION['userData']['id']);
      $addSection = getAddSection('addAccounts');
      break;
    case 'gotoCategories':
      $tabs = getTabs('budget', 'categories');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = getSearch("subCategories", null, null);
      $articleContent = getSubCategoryTable();
      $addSection = getAddSection('subCategories');
      break;
    case 'filterSubCategories':
      //get the search varaibles and filter the request
      $search = filter_input(INPUT_POST, 'findName', FILTER_SANITIZE_STRING);
      $status = filter_input(INPUT_POST, 'findStatus', FILTER_SANITIZE_STRING);
      //var_dump($status); die();
      $addSection = getAddSection('subCategories');
      $articleContent = getSubCategoryTable($search, $status);
      $callPage = './views/admin.php';
      $tabs = getTabs('budget', 'categories');
      $searchFields = getSearch("subCategories", $search, $status);
      $navSelect='dashboard';
      break;
    case 'addSubCategory':
      $newName = filter_input(INPUT_POST, 'newName', FILTER_SANITIZE_STRING);
      $newItem = getSubCategoryByName($newName);
      if(empty($newItem)){
        $rows = addSubCategory($newName);
      }else{
        $_SESSION['message'] = "That Sub Category already exists feel free to use it on your accounts";
      }
      $tabs = getTabs('budget', 'categories');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = getSearch("subCategories", null, null);
      $articleContent = getSubCategoryTable($search, $status);
      $addSection = getAddSection('subCategories');

      break;
    case 'gotoTransaction':
      $tabs = getTabs('budget', 'transactions');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = "";//getSearch("transactions", null, null);
      $articleContent = getTransactionsTable();
      $addSection = getAddSection('addTransaction');
      break;
    case 'addTransaction':
      $_SESSION['message']='';
      $tabs = getTabs('budget', 'transactions');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $accountid = filter_input(INPUT_POST, 'accountid', FILTER_SANITIZE_NUMBER_INT);
      $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
      $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
      if(!isset($amount)){$amount=0;}
      if(!isset($accountid)){$accountid=0;}
      if($accountid>0 && $amount>0){       
        $rows = addTransaction($accountid, $amount, $notes);
        
      }else{$_SESSION['message']='You need to specify an account and an amount.';}
      
      $searchFields = getSearch("transactions", null, null);
      $articleContent = getTransactionsTable();
      $addSection = getAddSection('addTransaction');
      
      break;
    case 'gotoAddBudget':
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = "";
      $accountID = filter_input(INPUT_POST, 'accountid', FILTER_SANITIZE_NUMBER_INT);
      $theDate = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_NUMBER_INT);
      $articleContent = getBudgetForm($accountID, $theDate);
      $addSection = "";
      break;
    case 'addBudget':
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $byear = filter_input(INPUT_POST, 'byear', FILTER_SANITIZE_NUMBER_INT);
      $bmonth = filter_input(INPUT_POST, 'bmonth', FILTER_SANITIZE_NUMBER_INT);
      $amount = filter_input(INPUT_POST, 'amount', FILTER_SANITIZE_NUMBER_FLOAT);
      $accountID = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
      $theDate = mktime(0,0,0,$bmonth,1,$byear);
      $rows = addBudget($accountID, $theDate, $amount);
      $searchFields = "";
      //$expand = $_SESSION['expand'];
      $articleContent = getBudgetTable($expand);
      $addSection = getAddSection('addTransaction');
      break;
    case 'decMonth':
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $_SESSION['bmonth']--;
      $searchFields = "";
      // = $_SESSION['expand'];
      $articleContent = getBudgetTable($expand);
      $addSection = getAddSection('addTransaction');
      
      break;
    case 'incMonth':
      $tabs = getTabs('budget', 'budget');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $_SESSION['bmonth']++;
      $searchFields = "";
      //$expand = $_SESSION['expand'];
      $articleContent = getBudgetTable($expand);
      $addSection = getAddSection('addTransaction');
      
      break;
    case 'removesub':
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      removeSubCategory($id);
      $tabs = getTabs('budget', 'categories');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = getSearch("subCategories", null, null);
      $articleContent = getSubCategoryTable();
      $addSection = getAddSection('subCategories');
      break;
    case 'restoresub':
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      restoreSubCategory($id);
      $tabs = getTabs('budget', 'categories');
      $callPage = "./views/admin.php";
      $navSelect='dashboard';
      $searchFields = getSearch("subCategories", null, null);
      $articleContent = getSubCategoryTable();
      $addSection = getAddSection('subCategories');
      break;
    default:
      $navSelect = '';
      $callPage =  'views/login.php';
      $callPage = "./views/admin.php";
      break;
  }
  //var_dump($_SESSION);
  $navList = getNavlist($navSelect);
  include $callPage;
?>