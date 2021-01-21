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

function getShoppingCart($items, $cart){
  $shoppingcart = '<div>Item</div>';
  $shoppingcart .= '<div>Image</div>';
  $shoppingcart .= '<div>Qty</div>';
  $shoppingcart .= '<div>Price</div>';
  $shoppingcart .= '<div>Subtotal</div>';
  $shoppingcart .= '<div></div>';
  $total = 0;
  foreach($cart as $key=>$cartQty){
    $shoppingcart .= '<div>'.$key.'</div>';
    $shoppingcart .= '<div><img src="/images/'.$items[$key]["img"].'" alt="Item Image"></div>';
    $shoppingcart .= '<div>'.$cartQty.'</div>';
    $shoppingcart .= '<div>$'.$items[$key]["price"].'</div>';
    $subtotal = $cartQty * $items[$key]["price"];
    $total += $subtotal;
    $shoppingcart .= '<div>$'.$subtotal.'</div>';
    $shoppingcart .= '<div>';
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
  $shoppingcart .= '<div class="total">$'.$total.'</div>';
  $shoppingcart .= '<div></div>';
  
  return $shoppingcart;
}

?>