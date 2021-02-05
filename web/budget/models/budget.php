<?php

function getUsers(){
  $db = dbConnect();
  $sql = 'SELECT * FROM users';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  //$stmt = $db->query('SELECT * FROM users');
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getTypes($search='', $status=''){
  $db = dbConnect();
  $where = '';
  if(!isset($search)){$search='';}
  if(!isset($status)){$status='';}
  if(strlen($search)>0){
    if(strlen($where)>0){
      $where .= " AND name like '%$search%' ";
    }else{
      $where = " WHERE name like '%$search%' ";
    }
  } 
  if ($status == 'all'){$status='';}
  if(strlen($status)>0){
    if(strlen($where)>0){
      $where .= " AND ";
    }else{
      $where = " WHERE ";
    }
    switch($status){
      case "active":
        $where .= "active=true ";
        break;
      case "inactive":
        $where .= "active=false ";
        break;
      default:
        $where .= "active=true ";
        break;
    }
  } 
  
  $sql = "SELECT * FROM accounttypes $where";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

?>