<?php

$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$major = filter_input(INPUT_POST, "major", FILTER_SANITIZE_STRING);
$comments = filter_input(INPUT_POST, "comments", FILTER_SANITIZE_STRING);
$places = $_POST['places'];

$places_map = array(
    "na" => 'North America',
    "sa" => 'South America',
    "eu" => 'Europe',
    "as" => 'Asia',
    "au" => 'Australia',
    "af" => 'Africa',
    "an" => 'Antartica'
);

$places_list = "";

if(isset($places)){
  foreach($places as $place) {
      if(isset($places_map[$place])) {
          $places_list .= "<li>" . $places_map[$place] . "</li>";
      }
  }
}else{echo "You had to have visited at least one continent!";}

$majors = array(
    "cs" => 'Computer Science',
    "wdd" => 'Web Design & Development',
    "cit" => 'Computer Information Technology',
    "ce" => 'Computer Engineering'
);

if(!isset($majors[$major]) || !$email || !$name) {
    echo "Your input was invalid.  Please <a href='/?action=w03-group'>try again.</a>";
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Inputs</title>
    <style>
        h1 {
            margin-bottom: 0.5em;
        }
        table{
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            padding: 0.5em;
        }

        td:first-child {
            font-weight: bold;
            padding: 0.5em 1.5em;
        }
    </style>
</head>
<body>
    <h1><?php echo $name; ?></h1>
    <table>
        <tbody>
            <tr>
                <td>Email</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Major</td>
                <td><?php echo $majors[$major]; ?></td>
            </tr>
            <tr>
                <td>Comments</td>
                <td><?php echo $comments; ?></td>
            </tr>
            <tr>
                <td>Places Visited</td>
                <td><ul><?php echo $places_list; ?></ul></td>
            </tr>
        </tbody>
    </table>
</body>
</html>