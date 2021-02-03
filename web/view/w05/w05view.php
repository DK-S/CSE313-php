<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week ?? Group Assignment</title>
    <link rel="stylesheet" href="/css/styles.css" media="screen">
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/header.php';?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <section>
      <?php echo $getUsers ?>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php';?>
    </footer>
  </body>
</html>