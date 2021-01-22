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
    <section class="getAddress">
      <h2>Ship To:</h2>
      <?php if(isset($message)){echo $message;}?>
      <form action="/w03cart/" method="POST">
        <input type="hidden" name="action" value="confirm">
        <label for="address1">Address:</label>
        <input type="text" name="address1" placeholder="Address" required <?php if (isset($address1)){echo "value='$address1'";}?>>
        <label for="address2"></label>
        <input type="text" name="address2">
        <label for="city">City:</label>
        <input type="text" name="city" placeholder="City" required <?php if(isset($city)){echo "value='$city'";}?>>
        <label for="state">State:</label>
        <input type="text" name="state" placeholder="State" required <?php if(isset($state)){echo "value='$state'";}?>>
        <label for="zip">Zip:</label>
        <input type="text" name="zip" placeholder="Zip" required <?php if(isset($zip)){echo "value='$zip'";}?> inputmode="numeric" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$">
        <input type="submit" value="Submit">
      </form>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php';?>
    </footer>
  </body>
</html>