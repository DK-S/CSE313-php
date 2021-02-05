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
    <section>
      <nav class="tabs">
        <ul>
          <li><a href="/budget/?action=managetypes" title="Link to manage account types">Types</a></li>
          <li><a href="/budget/?action=managefrequencies" title="Link to manage account types">Frequencies</a></li>
          <li><a href="/budget/?action=managecategories" title="Link to manage account types">Categories</a></li>
          <li><a href="/budget/?action=manageusers" title="Link to manage account types">Users</a></li>
        </ul>
      </nav>
      <article class="admin">
        <?php echo $searchFields; ?>
        <?php echo $articleContent; ?>
      </article>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/budget/common/footer.php';?>
    </footer>
  </body>
</html>