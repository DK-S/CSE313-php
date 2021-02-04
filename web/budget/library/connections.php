<?php

/* Connection to DB */

function dbConnect(){
  try{
    $dbUrl = getenv('DATABASE_URL');

    if (empty($dbUrl)) {
      $dbHost = 'localhost';
      $dbPort = '5431';
      $dbName = 'postgres';
      $dbUser = 'papai';
      $dbPass = 'Vitoria';
      //$dsn = 'pgsql:host='.$server.';dbname='.$dbname;
      //$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
      //$db = new PDO($dsn, $username, $password, $options);

    }else{
      $dbOpts = parse_url($dbUrl);

      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPass = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');

    }
    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  }
  catch (PDOException $ex) {
    echo $ex;
    //header('Location: /budget/views/500.php');
    die();
  }
  return $db;
}


?>