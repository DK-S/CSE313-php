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

function getUserData($username){
  $db = dbConnect();
  $sql = 'SELECT id, firstname, lastname, active, administrator, username, password FROM users WHERE username=:username';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':username', $username, PDO::PARAM_STR);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getUserDataByID($userid){
  $db = dbConnect();
  $sql = 'SELECT * FROM users WHERE id=:id';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $userid, PDO::PARAM_STR);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
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

function emailExists($email){
  $db = dbConnect();
  $sql = 'SELECT username FROM users where username=:email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $email, pdo::PARAM_STR);
  $stmt->execute();
  $match = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();
  if (empty($match)){
    return 0;
  }else{
    return 1;
  }
}

function registerUser($firstName, $lastName, $email, $password){
  //if first user make admin
  $users = getUsers();
  if (count($users)>0){
    $sql = "INSERT INTO users (firstname, lastname, username, password, active)";
    $sql .= " VALUES (:firstname, :lastname, :username, :password, '1')";
  }else{
    $sql = "INSERT INTO users (firstname, lastname, username, password, active, administrator)";
    $sql .= " VALUES (:firstname, :lastname, :username, :password, '1', '1')";  
  }
  $db = dbConnect();
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':firstname', $firstName, PDO::PARAM_STR);
  $stmt->bindValue(':lastname', $lastName, PDO::PARAM_STR);
  $stmt->bindValue(':username', $email, PDO::PARAM_STR);
  $stmt->bindValue(':password', $password, PDO::PARAM_STR);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function checkEmail($email){
  $valEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

function checkPassword($password){
  //check the password for 8 or more characters
  // at least 1 Capital Letter
  // at least 1 number
  //and at least 1 special character
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
  return preg_match($pattern, $password);
}

?>