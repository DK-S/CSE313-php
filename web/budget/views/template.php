<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Budget</title>
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
      <form action='/budget/' method='POST'>
        <h2>Add new Account</h2>
        <label for='accountName'>Name:</label>
        <input name='accountName' type='text'>
        <label for='description'>Description:</label>
        <input name='description' type='text'>
        <label for='accounttypeid'>Type</label>
        <select name='accounttypeid' type='text'>
          <option value='typeid'>TypeName</option>
        </select>
        <label for='accountfrequencyid'>Frequency</label>
        <select name='accountfrequencyid' type='text'>
          <option value='frequencyid'>FrequencyName</option>
        </select>
        <label for='accountcategoryid'>Category</label>
        <select name='accountcategoryid' type='text'>
          <option value='categoryid'>CategoryName</option>
        </select>
        <label for='acountsubcategoryid'>Sub Category</label>
        <select name='acountsubcategoryid' type='text'>
          <option value='subcategoryid'>subcategoryName</option>
        </select>
        <label for='subcategorycode'>Sub Category Code</label>
        <input name='subcategorycode' type='number'>
        <input type='hidden' name='action' value='addAccount'>
        <input type='submit' value='Add Account'>
      </form>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/budget/common/footer.php';?>
    </footer>
  </body>
</html>