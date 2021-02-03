<?php

//this function when using the optional parameter will mark the selected optional
function getNavlist($selected=''){
  $navList = '<ul>';
  
  $navList .= '<li';
  if($selected==''){$navList .= ' class="selected"';}
  $navList .= '><a href="/" title="Home Link">Home</a></li>';
  
  $navList .= '<li';
  if($selected=='assignments'){$navList .= ' class="selected"';}
  $navList .= '><a href="/?action=assignments" title="Assignments Link">Assignments</a></li>';
  
  $navList .= '<li';
  if($selected=='about'){$navList .= ' class="selected"';}
  $navList .= '><a href="/?action=about" title="About Link">About</a></li>';
  
  $navList .= '</ul>';
  return $navList;
}


function getCartSize($cart){
  $totalQty = 0;
  if(isset($cart)){
    foreach($cart as $item => $qty){
      $totalQty += $qty;
    }
  }
  return $totalQty;
}

function getShoppingBrowser($items){
  $browser = '<section class="shopping" >';
  foreach($items as $key => $itm){
    $browser .= '<figure>';
    $browser .= '<img src="/images/'.$itm["img"].'" alt="Item for sale">';
    $browser .= '<figcaption>';
    $browser .= '<form action="/w03cart/" method="POST">';
    $browser .= '<label class="price">$'.$itm["price"].'</label>';
    $browser .= '<input type="hidden" name="action" value="addtocart">';
    $browser .= '<input type="hidden" name="item" value="'.$key.'">';
    $browser .= '<input type="submit" value="Add to Cart">';
    $browser .= '</form>';
    $browser .= '</figcaption>';
    $browser .= '</figure>';
  }
  $browser .= '</section>';
  return $browser;
}

function getShoppingCart($items, $cart, $control = null){
  if ($control === null){$control = true;}
  $shoppingcart = '<section class="shoppingcart';
  if ($control){ $shoppingcart .= " control";}
  $shoppingcart .= '">';
  $shoppingcart .= '<div>Item</div>';
  $shoppingcart .= '<div>Image</div>';
  $shoppingcart .= '<div>Qty</div>';
  $shoppingcart .= '<div>Price</div>';
  $shoppingcart .= '<div>Subtotal</div>';
  $shoppingcart .= '<div';
  if (!$control){$shoppingcart .= ' class="hide"';}
  $shoppingcart .= '></div>';
  $total = 0;
  foreach($cart as $key=>$cartQty){
    $shoppingcart .= '<div>'.$key.'</div>';
    $shoppingcart .= '<div class="small"><img src="/images/'.$items[$key]["img"].'" alt="Item Image"></div>';
    $shoppingcart .= '<div class="small">'.$cartQty.'</div>';
    $shoppingcart .= '<div class="small">$'.$items[$key]["price"].'</div>';
    $subtotal = $cartQty * $items[$key]["price"];
    $total += $subtotal;
    $shoppingcart .= '<div class="small">$'.$subtotal.'</div>';
    $shoppingcart .= '<div class="small';
    if (!$control){$shoppingcart .= ' hide';}
    $shoppingcart .= '">';
    $shoppingcart .= '<form action="/w03cart/" method="POST">';
    $shoppingcart .= '<input type="hidden" name="action" value="removefromcart">';
    $shoppingcart .= '<input type="hidden" name="item" value="'.$key.'">';
    $shoppingcart .= '<input type="submit" value="Remove">';
    $shoppingcart .= '</form>';
    $shoppingcart .= '</div>';
  }
  $shoppingcart .= '<div></div>';
  $shoppingcart .= '<div></div>';
  $shoppingcart .= '<div></div>';
  $shoppingcart .= '<div></div>';
  $shoppingcart .= '<div class="total small">'.$total.'</div>';
  $shoppingcart .= '<div class="small';
    if (!$control || getCartSize($cart)==0){$shoppingcart .= ' hide';}
  $shoppingcart .= '">';
  $shoppingcart .= '<form action="/w03cart/" method="POST">';
  $shoppingcart .= '<input type="hidden" name="action" value="getpayment">';
  $shoppingcart .= '<input type="submit" value="Check Out"></form>';
  $shoppingcart .= '</div>';
  $shoppingcart .= '</section>';
  
  return $shoppingcart;
}

function getUserTable(){
  $rows = getUsers();
  $tb = "<table>";
  $tb .= "<tr><td>First Name]</td><td>Last Name]</td><td>username</td></tr>";
  foreach ($rows as $user){
    $tb .= "<tr><td>$user[firstname]</td><td>$user[lastname]</td><td>$user[username]</td></tr>";

  }
  $tb .= "</table>";
  //var_dump($rows); 

  return $tb;
}

?>