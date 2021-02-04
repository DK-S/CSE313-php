<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/styles.css" media="screen">
  </head>
  <body>
    <header>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/header.php';?>
    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <h1>Assignments</h1>
    <section>
      <ul>
        <li><a href="../?action=w03-group" title="Link To W03 Group Assignemt">Week 03 Group Assignment</a></li>
        <li><a href="../?action=w03cart" title="Link To W03 Shopping Cart Assignemt">Week 03 Shopping Cart Assignment</a></li>
        <li><a href="../?action=w05-reading" title="Link To W05 Reading Assignemt">Week 05 Reading Assignment</a></li>
        <li><a href="../?action=budget" title="Link To Budget Project">Budget Project</a></li>
      </ul>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/common/footer.php';?>
    </footer>
  </body>
</html>