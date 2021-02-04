<?php

/* Connection to DB */

function dbConnect(){
  try{
    $dbUrl = getenv('DATABASE_URL');

    if (empty($dbUrl)) {
      
      //sslmode=require
      $dbUrl = "postgres://bxulrzxxjmqhiu:d45face9d4c50727d680f0fd8dc107d0d5235fc9cb4a2b739857b558cde048c1@ec2-54-205-187-125.compute-1.amazonaws.com:5432/d180cral9n9k9o:sslmode=require";
  }

    $dbOpts = parse_url($dbUrl);

    $dbHost = $dbOpts["host"];
    $dbPort = $dbOpts["port"];
    $dbUser = $dbOpts["user"];
    $dbPass = $dbOpts["pass"];
    $dbName = ltrim($dbOpts["path"],'/');

    $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch (PDOException $ex) {
    echo 'Error!: ' . $ex->getMessage();
    die();
  }
  return $db;
}


?>