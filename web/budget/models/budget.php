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

function getTypesByID($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accounttypes WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
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

function getFrequencyByID($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accountfrequencies WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
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

function getCategoryByID($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accountcategories WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getSubCategories($search='', $status=''){
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
  $sql = "SELECT * FROM accountsubcategories $where";
  $sql .= " ORDER BY name ASC";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getSubCategoryByName($theName){
  $db = dbConnect();
  $sql = "SELECT * FROM accountsubcategories WHERE name=:name";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":name", $theName, PDO::PARAM_STR);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getSubCategoryByID($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accountsubcategories WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function addSubCategory($newName){
  $db = dbConnect();
  $sql = "INSERT INTO accountsubcategories (name, active) VALUES (:name, TRUE);";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":name", $newName, PDO::PARAM_STR);
  $stmt->execute();
  $rows = $stmt->rowCount();
  $stmt->closeCursor();
  return $rows;

}

function getAccounts($userid, $onlyActive=FALSE){
  $db = dbConnect();
  $sql = "SELECT * FROM accounts WHERE userid=:id";
  if($onlyActive){$sql .= " AND active=true";}
  $sql .= " ORDER BY accounttypeid ASC, accountfrequencyid ASC, accountcategoryid ASC, subcategorycode ASC";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $userid, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function getAccount($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accounts WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function addAccount($name, $description, $userid, $accounttypeid, $accountfrequencyid, $accountcategoryid, $accountsubcategoryid, $subcategorycode){
  $db = dbConnect();
  $sql = "INSERT INTO accounts (name, description, userid,";
  $sql .= " active, accounttypeid, accountfrequencyid, accountcategoryid, ";
  $sql .= "accountsubcategoryid, subcategorycode) VALUES (:name, :description, ";
  $sql .= ":userid, TRUE, :accounttypeid, :accountfrequencyid, :accountcategoryid, ";
  $sql .= ":accountsubcategoryid, :subcategorycode);";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":name", $name, PDO::PARAM_STR);
  $stmt->bindValue(":description", $description, PDO::PARAM_STR);
  $stmt->bindValue(":userid", $userid, PDO::PARAM_INT);
  $stmt->bindValue(":accounttypeid", $accounttypeid, PDO::PARAM_INT);
  $stmt->bindValue(":accountfrequencyid", $accountfrequencyid, PDO::PARAM_INT);
  $stmt->bindValue(":accountcategoryid", $accountcategoryid, PDO::PARAM_INT);
  $stmt->bindValue(":accountsubcategoryid", $accountsubcategoryid, PDO::PARAM_INT);
  $stmt->bindValue(":subcategorycode", $subcategorycode, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->rowCount();
  $stmt->closeCursor();
  return $rows;
}

function removeAccount($id){
  $db = dbConnect();
  $sql = "UPDATE accounts SET active=false WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function restoreAccount($id){
  $db = dbConnect();
  $sql = "UPDATE accounts SET active=true WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
}

function saveAccount($id, $name, $description, $accounttypeid, $accountfrequencyid, $accountcategoryid, $accountsubcategoryid, $subcategorycode){
  $db = dbConnect();
  $sql = "UPDATE accounts SET ";
  $sql .= "name='$name'";
  $sql .= ", description='$description'";
  $sql .= ", accounttypeid='$accounttypeid'";
  $sql .= ", accountfrequencyid='$accountfrequencyid'";
  $sql .= ", accountcategoryid='$accountcategoryid'";
  $sql .= ", accountsubcategoryid='$accountsubcategoryid'";
  $sql .= ", subcategorycode='$subcategorycode'";
  $sql .= " WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->rowCount();
  $stmt->closeCursor();
  return $rows;
}

function getTheType($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accountTypes WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
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

function getFrequency($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accountFrequencies WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
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

function getCategory($id){
  $db = dbConnect();
  $sql = "SELECT * FROM accountCategories WHERE id=:id";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
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

function getTransactions($fromDate, $toDate){
  if(!isset($fromDate)){$fromDate=strtotime("-1 Months");}
  if(!isset($toDate)){$toDate=strtotime("+1 Day");}
  //var_dump($fromDate);
  //echo date("Y-m-d H:i:s", $fromDate);
  $db = dbConnect();
  $sql = "SELECT * FROM transactionlogs as tl";
  $sql .= " inner join accounts as a on tl.accountid = a.id";
  $sql .= " inner join users as u on u.id = a.userid";
  $sql .= " where tdate>:fdate AND tdate<:tdate AND a.userid=:uid";
  $sql .= " ORDER BY tdate ASC";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":fdate", date("m/d/Y H:i:s", $fromDate), PDO::PARAM_STR);
  $stmt->bindValue(":tdate", date("m/d/Y H:i:s", $toDate), PDO::PARAM_STR);
  $stmt->bindValue(":uid", $_SESSION['userData']['id'], PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $rows;
}

function addTransaction($accountID, $amount, $notes){
  //notes amount accountid tdate
  $theDate=strtotime("Today");
  $tDate = date("m/d/Y H:i:s", $theDate);
  $db = dbConnect();
  $sql = "INSERT INTO transactionlogs (accountid, amount, notes,";
  $sql .= " tdate) VALUES (:accountid, :amount, :notes, :tdate);";
  $stmt = $db->prepare($sql);
  $stmt->bindValue(":accountid", $accountID, PDO::PARAM_STR);
  $stmt->bindValue(":amount", $amount, PDO::PARAM_STR);
  $stmt->bindValue(":notes", $notes, PDO::PARAM_INT);
  $stmt->bindValue(":tdate", $tDate, PDO::PARAM_INT);
  $stmt->execute();
  $rows = $stmt->rowCount();
  $stmt->closeCursor();
  return $rows;
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