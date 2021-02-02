<?php

function getUsers(){
  $db = dbConnect();
  $sql = 'SELECT * FROM users';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}