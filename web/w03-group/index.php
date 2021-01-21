W03<?php

$majors = array(
  "cs" => 'Computer Science',
  "wdd" => 'Web Design & Development',
  "cit" => 'Computer Information Technology',
  "ce" => 'Computer Engineering'
);

$major_options = "";

// var_dump(array_keys($majors));

foreach($majors as $key => $major) {
  $major_options .= "<label for='$key'><input type='radio' name='major' id='$key' value='$key'>$major</label>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Web Form</title>
  <style>
    .input-wrapper {
      display: block;
      padding-top: 1em;
    }

    label {
      display: block;
    }

    body {
      padding: 1em;
    }

    h1 {
      margin: 0;
    }

  </style>
</head>
<body>
  <h1>Profile Form</h1>
  <form action="w03-group/post.php" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <fieldset>
      <legend>Major</legend>
      <?php echo $major_options; ?>
    </fieldset>
    <fieldset>
      <legend>Continents Visited</legend>
      <label for="na">
        <input type="checkbox" name="places[]" id="na" value="na">
        North America
      </label>
      <label for="sa">
        <input type="checkbox" name="places[]" id="sa" value="sa">
        South America
      </label>
      <label for="eu">
        <input type="checkbox" name="places[]" id="eu" value="eu">
        Europe
      </label>
      <label for="as">
        <input type="checkbox" name="places[]" id="as" value="as">
        Asia
      </label>
      <label for="au">
        <input type="checkbox" name="places[]" id="au" value="au">
        Australia
      </label>
      <label for="af">
        <input type="checkbox" name="places[]" id="af" value="af">
        Africa
      </label>
      <label for="an">
        <input type="checkbox" name="places[]" id="an" value="an">
        Antartica
      </label>
    </fieldset>
    <label for="comments">Comments</label>
    <textarea name="comments" id="comments" cols="30" rows="10"></textarea>
    </br><input type="submit" value="Submit">
  </form>
</body>
</html>