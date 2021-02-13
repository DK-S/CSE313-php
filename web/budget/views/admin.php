<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Budget - Admin</title>
    <link rel="stylesheet" href="/budget/css/styles.css" media="screen">
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/budget/common/header.php';?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <section class="header">
      <?php if(isset($header)){echo $header;}?>
    </section>
    <section>
      <?php echo $tabs; ?>
      <article class="admin">
        <?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} echo $searchFields; ?>
        <?php echo $articleContent; ?>
      </article>
      <article class="add">
        <?php if(isset($addSection)){echo $addSection;} ?>
      </article>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/budget/common/footer.php';?>
    </footer>
  </body>
</html>