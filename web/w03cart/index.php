<?php
  session_start();

  require_once $_SERVER['DOCUMENT_ROOT'].'/library/functions.php';

  $item = filter_input(INPUT_POST, "item", FILTER_SANITIZE_NUMBER_INT);
  
  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
  }
  $navList = getNavlist($action);

  $items = array(
    "1" => array("price"=>45, "img"=>"logo_500.jpg"),
    "2" => array("price"=>95, "img"=>"train_500.jpg"),
    "3" => array("price"=>75, "img"=>"helicopters_500.jpg"),
    "4" => array("price"=>75, "img"=>"Calm_500.jpg"),
    "5" => array("price"=>75, "img"=>"Fear_500.jpg"),
    "6" => array("price"=>75, "img"=>"laptop_500.jpg"),
    "7" => array("price"=>75, "img"=>"plate_500.jpg"),
    "8" => array("price"=>75, "img"=>"tech_500.jpg"),
    "9" => array("price"=>75, "img"=>"street_500.jpg"),
    "10" => array("price"=>75, "img"=>"sunset_500.jpg")
  );


  $browser = getShoppingBrowser($items);
  
  $cart = $_SESSION["cart"];

  //$shoppingcart = getShoppingCart($items, $cart);
  
  //var_dump($_POST);
  //var_dump($_SESSION);

  switch ($action){
    case 'addtocart':
      //add to the cart
      $cart[$item] += 1;
      $_SESSION["cart"] = $cart;
      include $_SERVER['DOCUMENT_ROOT']."/view/w03cart.php";
      break;
    case 'removefromcart':
      $cart[$item] -= 1;
      if($cart[$item] == 0){unset($cart[$item]);}
      $_SESSION["cart"] = $cart;
      $shoppingcart = getShoppingCart($items, $cart);
      include $_SERVER['DOCUMENT_ROOT']."/view/w03thecart.php";
      break;
    case 'checkout':
      $shoppingcart = getShoppingCart($items, $cart);
      include $_SERVER['DOCUMENT_ROOT']."/view/w03thecart.php";
      break;
    case 'view_browse':
      include $_SERVER['DOCUMENT_ROOT']."/view/w03cart.php";
      break;
    case 'view_cart':
      $shoppingcart = getShoppingCart($items, $cart);
      include $_SERVER['DOCUMENT_ROOT']."/view/w03thecart.php";
      break;
    case 'getpayment':
      include $_SERVER['DOCUMENT_ROOT']."/view/w03payment.php";
      break;
    case 'confirm':
      $address1 = filter_input(INPUT_POST, "address1", FILTER_SANITIZE_STRING);
      $address2 = filter_input(INPUT_POST, "address2", FILTER_SANITIZE_STRING);
      $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
      $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_STRING);
      $zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_STRING);
      if(empty($address1) || empty($city) || empty($state) || empty($zip)){
        $message = "<p>Please fill in your complete address</p>";
        include $_SERVER['DOCUMENT_ROOT']."/view/w03payment.php";
      } else {
        unset($_SESSION["cart"]);
        include $_SERVER['DOCUMENT_ROOT']."/view/w03confirm.php";
      }
      
      break;
    default:
    include $_SERVER['DOCUMENT_ROOT']."/view/w03cart.php";
      break;
  }
  

?>