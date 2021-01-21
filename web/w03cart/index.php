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
    "3" => array("price"=>75, "img"=>"helicopters_500.jpg")
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
    case 'view_browse':
      include $_SERVER['DOCUMENT_ROOT']."/view/w03cart.php";
      break;
    case 'view_cart':
      $shoppingcart = getShoppingCart($items, $cart);
      include $_SERVER['DOCUMENT_ROOT']."/view/w03thecart.php";
      break;
    default:
    include $_SERVER['DOCUMENT_ROOT']."/view/w03cart.php";
      break;
  }
  

?>