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
  $sql .= " ORDER BY code ASC";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getFrequencies($search='', $status=''){
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
  
  $sql = "SELECT * FROM accountfrequencies $where";
  $sql .= " ORDER BY code ASC";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getCategories($search='', $status=''){
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
  
  $sql = "SELECT * FROM accountcategories $where";
  $sql .= " ORDER BY code ASC";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function removeType($id){
  $db = dbConnect();
  $sql = "UPDATE accountTypes SET active=false WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function restoreType($id){
  $db = dbConnect();
  $sql = "UPDATE accountTypes SET active=true WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function removeFrequency($id){
  $db = dbConnect();
  $sql = "UPDATE accountFrequencies SET active=false WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function restoreFrequency($id){
  $db = dbConnect();
  $sql = "UPDATE accountFrequencies SET active=true WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function removeCategory($id){
  $db = dbConnect();
  $sql = "UPDATE accountCategories SET active=false WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function restoreCategory($id){
  $db = dbConnect();
  $sql = "UPDATE accountCategories SET active=true WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function getBudgets(){

}

function getTransactions(){

}

function getAccounts(){

}

function getSubCategoryName($id){
  $db = dbConnect();
  $sql = 'SELECT * FROM accountsubcategories WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}


?>