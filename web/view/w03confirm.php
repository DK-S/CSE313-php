<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 03 Shopping Cart Assignment</title>
    <link rel="stylesheet" href="/css/styles.css" media="screen">
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/header.php';?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <nav>
      <ul>
        <li id="browse"><a href="/w03cart/?action=view_browse" title="View Shopping Browser Link">Continue Shopping</a></li>
        <li id="cart"><a href="/w03cart/?action=view_cart" title="View Cart Link">View Cart(<?php echo getCartSize($_SESSION["cart"]);?>)</a></li>
      </ul>
    </nav>
    <section class="confirm">
      <?php echo "<p>Thank you for your purchase. Your order will be shipped to $address1 $address2 $city $state, $zip.</p>";?>
      <?php echo getShoppingCart($items, $cart, false); ?>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php';?>
    </footer>
  </body>
</html>