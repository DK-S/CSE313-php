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
      <form action="/budget/" method="POST">
        <input type="hidden" name="action" value="submitlogin">
        <h1>Sign In</h1>
        <label for="clientEmail">Email:</label>
        <input name="clientEmail" id="clientEmail" type="email" placeholder="someone@domain.com" required <?php if (isset($clientEmail)){echo "value='$clientEmail'";}?>>
        <label for="clientPassword">Password:</label>
        <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        <input name="signinButton" id="signinButton" value="Sign In" type="Submit">
        <a href="./?action=newuser" title="Register an account with us">Not a member yet?</a>
      </form>
    </section>
    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'].'/budget/common/footer.php';?>
    </footer>
  </body>
</html>