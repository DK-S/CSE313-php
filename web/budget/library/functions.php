<?php

//this function when using the optional parameter will mark the selected optional
function getNavlist($selected=''){
  $navList = '<ul>';
  
  if(isset($_SESSION['userData'])){
    if ($_SESSION['loggedin']){
      $userData = $_SESSION['userData'];
      $navList .= '<li';
      if($selected=='dashboard' || $selected==''){$navList .= ' class="selected"';}
      $navList .= '><a href="./?action=dashboard" title="Dashboard Link">Dashboard</a></li>';

      //Add this button if the user is logged in and is an admin
      if($userData['administrator']){
        $navList .= '<li';
        if($selected=='admin'){$navList .= ' class="selected"';}
        $navList .= '><a href="./?action=admin" title="Admin page Link">Admin</a></li>';
      }
    }
  }
  
  
  //if $selected is blank lets get logged in first
  //if ($selected == ''){$navList = '<ul>';}

  $navList .= '<li id="Main"><a href="/" title="Main page link">Main Page</a></li>';

  $navList .= '</ul>';
  return $navList;
}

function getUserTable($admin){
  $rows = getUsers();
  $tb = "<div class='table col_3'>";
  $tb .= "<div>First Name</div><div>Last Name</div><div>username</div><div>Active</div><div></div>";
  foreach ($rows as $user){
    $tb .= "<div>$user[firstname]</div><div>$user[lastname]</div><div>$user[username]</div><div>";
    if ($user["active"]){
      $tb .= "<img src='/budget/images/greencheck.jpg' alt='Green Checkmark'>";
    }
    $tb .= "</div><div>";
    //add add/remove button here
    var_dump($user['username'].' '.$admin['username']);
    if($user['username']==$admin['username']){

    }else{
      if ($user["active"]){
        $tb .= "<a href='/budget/?action=removeuser&id=$user[id]' title='Link to remove category'>Remove</a>";
      } else {
        $tb .= "<a href='/budget/?action=restoreuser&id=$user[id]' title='Link to restore category'>Restore</a>";
      }
      $tb .= "   <a href='/budget/?action=resetpassword&id=$user[id]' title='Link to reset password'>Reset</a>";
    }
    $tb .= "</div>";
  }
  $tb .= "</div>";
  return $tb;
}

function getHeader($user=null){
  $html = '';
  if(isset($user) && $user<>null ){
    $html = "<div>Welcome $user[firstname]</div><div><form action='/budget/' method='post'><input type='hidden' name='action' value='logout'><input type='submit' value='Logout'></form>";
  }else{
    $html = "<div>Welcome</div><div><form action='/budget/' method='post'><input type='hidden' name='action' value='login'><input type='submit' value='Login'></form>";
  }
  return $html;
}

function getSearch($table, $search='', $status=''){
  $html = "<div class='search'><form action='/budget/' method='post'>";
  $html .= "<label for='findName'>Find Name:</label>";
  
  $html .= "<input name='findName' type='text' ";
  if(isset($search)){$html .=  "value='$search'";}
  $html .= ">";
  $html .= "<label for='findStatus'>Filter Status:</label>";
  $html .= "<select name='findStatus'>";
  if(isset($status)){if($status=='all'){$select=" selected";}else{$select="";}}else{$select="";}
  $html .= "<option value='all' $select>All</option>";
  if(isset($status)){if($status=='active'){$select=" selected";}else{$select="";}}else{$select="";}
  $html .= "<option value='active' $select>Active</option>";
  if(isset($status)){if($status=='inactive'){$select=" selected";}else{$select="";}}else{$select="";}
  $html .= "<option value='inactive' $select>Inactive</option>";
  $html .= "</select>";
  switch($table){
    case "types":
      $html .= "<input type='hidden' name='action' value='filterTypes'>";
      break;
    case "frequencies":
      $html .= "<input type='hidden' name='action' value='filterFrequencies'>";
      break;
    case "categories":
      $html .= "<input type='hidden' name='action' value='filterCategories'>";
      break;
    case "subCategories":
      $html .= "<input type='hidden' name='action' value='filterSubCategories'>";
      break;
    default:
      break;
  }
  
  $html .= "<input type='submit' value='Search'>";
  $html .= "</form></div>";
  return $html;
}

function getAddSection($page){
  switch($page){
    case 'subCategories':
      $html = "<form action='/budget/' method='post'>";
      $html .= "<label for='newName'>Don&apos;t see what you are looking for, add it here:</label>";
      $html .= "<input name='newName' type='text' ";
      if(isset($newName)){$html .= "value='$newName'";}
      $html .= ">";
      $html .= "<input type='hidden' name='action' value='addSubCategory'>";
      $html .= "<input type='submit' value='Add'></form>";
      break;
    case 'addAccounts':
      $html = "<form action='/budget/' method='POST'>";
      $html .= "<input type='hidden' name='action' value='gotoaddAccounts'>";
      $html .= "<input type='submit' value='Add Account'>";
      $html .= "</form>";
      break;
    case 'gotoaddAccounts':
      $html = "<form action='/budget/' method='POST'>";
      $html .= "<h2>Add new Account</h2>";
      $html .= "<label for='accountName'>Name:</label>";
      $html .= "<input name='accountName' type='text'>";
      $html .= "<label for='description'>Description:</label>";
      $html .= "<input name='description' type='text'>";
      $html .= "<label for='accounttypeid'>Type</label>";
      $html .= "<select name='accounttypeid' type='text'>";
      $types = getTypes('', 'active');
      foreach ($types as $type){
        $html .= "<option value='$type[id]'>$type[name]</option>";
      }
      $html .= "</select>";
      $html .= "<label for='accountfrequencyid'>Frequency</label>";
      $html .= "<select name='accountfrequencyid' type='text'>";
      $frequencies = getFrequencies('', 'active');
      foreach($frequencies as $frequency){
        $html .= "<option value='$frequency[id]'>$frequency[name]</option>";
      }
      $html .= "</select>";
      $html .= "<label for='accountcategoryid'>Category</label>";
      $html .= "<select name='accountcategoryid' type='text'>";
      $categories = getCategories('', 'active');
      foreach($categories as $category){
        $html .= "<option value='$category[id]'>$category[name]</option>";
      }
      $html .= "</select>";
      $html .= "<label for='accountsubcategoryid'>Sub Category</label>";
      $html .= "<select name='accountsubcategoryid' type='text'>";
      $subCategories = getSubCategories('', 'active');
      foreach($subCategories as $subCategory){
        $html .= "<option value='$subCategory[id]'>$subCategory[name]</option>";
      }
      $html .= "</select>";
      $html .= "<label for='subcategorycode'>Sub Category Code</label>";
      $html .= "<input name='subcategorycode' type='number'>";
      $html .= "<input type='hidden' name='action' value='addAccount'>";
      $html .= "<input type='submit' value='Add Account'>";
      $html .= "</form>";
      break;
    case 'addTransaction':
      $html = "<form action='/budget/' method='POST'>";
      $html .= "<h2>Add Transaction</h2>";
      $html .= "<label for='accountid'>Account:</label>";
      $html .= "<select name='accountid' type='text'>";
      $accounts = getAccounts($_SESSION['userData']['id']);
      foreach ($accounts as $account){
        $html .= "<option value='$account[id]'>".getAccountNumberByID($account['id']);
        $html .= " $account[name]</option>";
      }
      $html .= "</select>";
      $html .= "<label for='amount'>Amount</label>";
      $html .= "<input name='amount' type='number' step='0.01'>";
      $html .= "<label for='notes'>Notes</label>";
      $html .= "<input name='notes' type='text'>";
      
      $html .= "<input type='hidden' name='action' value='addTransaction'>";
      $html .= "<input type='submit' value='Add Transaction'>";
      $html .= "</form>";
      
    default:
      break;
  }

  
  return $html;
}

function getFrequenciesTable($search='', $status=''){
  $rows = getFrequencies($search, $status);
  $tb = "<div class='table col_2'>";
  $tb .= "<div>Type Name</div><div class='center'>Code</div><div class='center'>Active</div><div></div>";
  foreach ($rows as $type){
    $tb .= "<div>$type[name]</div><div class='center'>$type[code]</div><div class='center'>";
    if ($type["active"]){
      $tb .= "<img src='/budget/images/greencheck.jpg' alt='Green Checkmark'>";
    }
    //add checkbox here
    $tb .= "</div><div>";
    //add add/remove button here
    if ($type["active"]){
      $tb .= "<a href='/budget/?action=removefrequency&id=$type[id]' title='Link to remove frequency'>Remove</a>";
    } else {
      $tb .= "<a href='/budget/?action=restorefrequency&id=$type[id]' title='Link to restore frequency'>Restore</a>";
    }
    $tb .= "</div>";
  }
  $tb .= "</div>";
  return $tb;
}

function getCategoriesTable($search='', $status=''){
  $rows = getCategories($search, $status);
  $tb = "<div class='table col_2'>";
  $tb .= "<div>Type Name</div><div class='center'>Code</div><div class='center'>Active</div><div></div>";
  foreach ($rows as $type){
    $tb .= "<div>$type[name]</div><div class='center'>$type[code]</div><div class='center'>";
    if ($type["active"]){
      $tb .= "<img src='/budget/images/greencheck.jpg' alt='Green Checkmark'>";
    }
    //add checkbox here
    $tb .= "</div><div>";
    //add add/remove button here
    if ($type["active"]){
      $tb .= "<a href='/budget/?action=removecategory&id=$type[id]' title='Link to remove category'>Remove</a>";
    } else {
      $tb .= "<a href='/budget/?action=restorecategory&id=$type[id]' title='Link to restore category'>Restore</a>";
    }
    $tb .= "</div>";
  }
  $tb .= "</div>";
  return $tb;
}

function getTypesTable($search='', $status=''){
  $rows = getTypes($search, $status);
  $tb = "<div class='table col_2'>";
  $tb .= "<div>Type Name</div><div class='center'>Code</div><div class='center'>Active</div><div></div>";
  foreach ($rows as $type){
    $tb .= "<div>$type[name]</div><div class='center'>$type[code]</div><div class='center'>";
    if ($type["active"]){
      $tb .= "<img src='/budget/images/greencheck.jpg' alt='Green Checkmark'>";
    }
    //add checkbox here
    $tb .= "</div><div>";
    //add add/remove button here
    if ($type["active"]){
      $tb .= "<a href='/budget/?action=removetype&id=$type[id]' title='Link to remove type'>Remove</a>";
    } else {
      $tb .= "<a href='/budget/?action=restoretype&id=$type[id]' title='Link to restore type'>Restore</a>";
    }
    $tb .= "</div>";
  }
  $tb .= "</div>";
  return $tb;
}

function getEditUser($userid=0){
  if($userid > 0 ){
    $user = getUserDataByID($userid);
    $id = $user['id'];
    $firstname = $user['firstname'];
    $lastname = $user['lastname'];
    $username = $user['username'];
    $password = $user['password'];
  }else{
    $id = 1;
    $firstname = '';
    $lastname = '';
    $username = '';
    $password = '';
  }
  $html = "<div><form action='/budget/' method='post'>";
  $html .= "<input name='action' type='hidden' value='saveuser'>";
  $html .= "<input name='id' type='hidden' value='$id'>";
  $html .= "<label for='firstname'>First Name:</label>";
  $html .= "<input name='firstname' type='text' value='$firstname'>";
  $html .= "<label for='lastname'>Last Name:</label>";
  $html .= "<input name='lastname' type='text' value='$lastname'>";
  $html .= "<label for='username'>Userame:</label>";
  $html .= "<input name='username' type='text' value='$username'>";
  $html .= "<label for='password'>Password:</label>";
  $html .= "<input name='password' type='password' value='$password'>";
  $html .= "<input name='submit' type='submit' value='submit'>";

  $html .= "</div>";
  return $html;
}

function getTabs($page, $selected){
  $html = "<nav class='tabs'><ul>";
  switch($page){
    case 'admin':
      $html .= "<li";
      if($selected=="types"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=managetypes' title='Link to manage account types'>Types</a></li>";
      $html .= "<li";
      if($selected=="frequencies"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=managefrequencies' title='Link to manage account types'>Frequencies</a></li>";
      $html .= "<li";
      if($selected=="categories"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=managecategories' title='Link to manage account types'>Categories</a></li>";
      $html .= "<li";
      if($selected=="users"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=manageusers' title='Link to manage account types'>Users</a></li>";

      break;
    case 'budget':
      $html .= "<li";
      if($selected=="budget"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=gotoBudget' title='Link to the budget'>Budget</a></li>";

      $html .= "<li";
      if($selected=="accounts"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=gotoAccounts' title='Link to the accounts'>Accounts</a></li>";
      
      $html .= "<li";
      if($selected=="categories"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=gotoCategories' title='Link to the categories'>Categories</a></li>";
      
      $html .= "<li";
      if($selected=="transactions"){$html .= " class='selected'";}
      $html .= "><a href='/budget/?action=gotoTransaction' title='Link to the transactions'>Transactions</a></li>";
      
      break;
    default:
      break;
  }
  $html .= "</ul></nav>";
  return $html;
}

function getSubCategoryTable($search='', $status=''){
  $rows = getSubCategories($search, $status);
  $tb = "<div class='table col_1'>";
  $tb .= "<div>Name</div><div class='center'>Active</div><div></div>";
  foreach ($rows as $type){
    $tb .= "<div>$type[name]</div><div class='center'>";
    if ($type["active"]){
      $tb .= "<img src='/budget/images/greencheck.jpg' alt='Green Checkmark'>";
    }
    //add checkbox here
    $tb .= "</div><div>";
    $tb .= "</div>";
  }
  $tb .= "</div>";
  return $tb;
}

function getAccountsTable(){
  $user = $_SESSION['userData'];
  $accounts = getAccounts($user['id']);
  $html = "<div class='table col_3'>";
  $html .= "<div>Account</div><div>Name</div><div>Description</div><div class='center'>Active</div><div></div>";
  foreach ($accounts as $account){
    $anum = getAccountNumber(getTheType($account['accounttypeid']), getFrequency($account['accountfrequencyid']), getCategory($account['accountcategoryid']), $account['subcategorycode']);
    $html .= "<div>$anum</div><div>$account[name]</div><div>$account[description]</div><div class='center'>";
    if ($account['active']){
      $html .= "<img src='/budget/images/greencheck.jpg' alt='Green Checkmark'>";
    }
    $html .= "</div><div class='controls'>";
    if ($account['active']){
      $html .= "<form action='/budget/' method='post'>";
      $html .= "<input type='hidden' name='id' value='$account[id]'>";
      $html .= "<input type='hidden' name='action' value='editAccount'>";
      $html .= "<input type='submit' value='Edit'>";
      $html .= "</form>";
    }
    $html .= "<form action='/budget/' method='post'>";
    $html .= "<input type='hidden' name='id' value='$account[id]'>";
    $html .= "<input type='hidden' name='action' value='removeAccount'>";
    $html .= "<input type='submit' value='";
    if ($account['active']){$html .= "Remove";}else{$html .= "Restore";}
    $html .= "'>";
    $html .= "</form>";
    if ($account['active']){
      $html .= "<form action='/budget/' method='post'>";
      $html .= "<input type='hidden' name='id' value='$account[id]'>";
      $html .= "<input type='hidden' name='action' value='gotoAddBudget'>";
      $html .= "<input type='submit' value='Edit'>";
      $html .= "</form>";
    }
    $html .= "</div>";
  }
  $html .= "</div>";
  return $html;
}

function getAccountNumber($type, $frequency, $category, $subCategory){
  return $type['code'].$frequency['code'].'0'.$category['code'].'-'.sprintf('%02d', $subCategory);
}

function getAccountNumberByID($id){
  $account = getAccount($id);
  $type = getTypesByID($account['accounttypeid']);
  $frequency = getFrequencyByID($account['accountfrequencyid']);
  $category = getCategoryByID($account['accountcategoryid']);
  $subCategory = $account['subcategorycode'];
  return $type['code'].$frequency['code'].'0'.$category['code'].'-'.sprintf('%02d', $subCategory);
}

function getEditAccountsContent($accountID){
  $account = getAccount($accountID);
  var_dump($accountID);
  $html = "<h2>".getAccountNumber(getTheType($account['accounttypeid']), getFrequency($account['accountfrequencyid']), getCategory($account['accountcategoryid']), $account['subcategorycode'])."</h2>";
  $html .= "<form action='/budget/' method='POST'>";
  $html .= "<label for='accountName'>Name:</label>";
  $html .= "<input name='accountName' type='text' value='$account[name]'>";
  $html .= "<label for='description'>Description:</label>";
  $html .= "<input name='description' type='text' value='$account[description]'>";
  $html .= "<label for='accounttypeid'>Type</label>";
  $html .= "<select name='accounttypeid' type='text'>";
  $types = getTypes('', 'active');
  foreach ($types as $type){
    $html .= "<option value='$type[id]'";
    if($type['id'] == $account['accounttypeid']){$html .= " selected";}
    $html .= ">$type[name]</option>";
  }
  $html .= "</select>";
  $html .= "<label for='accountfrequencyid'>Frequency</label>";
  $html .= "<select name='accountfrequencyid' type='text'>";
  $frequencies = getFrequencies('', 'active');
  foreach($frequencies as $frequency){
    $html .= "<option value='$frequency[id]'";
    if($frequency['id'] == $account['accountfrequencyid']){$html .= " selected";}
    $html .= ">$frequency[name]</option>";
  }
  $html .= "</select>";
  $html .= "<label for='accountcategoryid'>Category</label>";
  $html .= "<select name='accountcategoryid' type='text'>";
  $categories = getCategories('', 'active');
  foreach($categories as $category){
    $html .= "<option value='$category[id]'";
    if($category['id'] == $account['accountcategoryid']){$html .= " selected";}
    $html .= ">$category[name]</option>";
  }
  $html .= "</select>";
  $html .= "<label for='accountsubcategoryid'>Sub Category</label>";
  $html .= "<select name='accountsubcategoryid' type='text'>";
  $subCategories = getSubCategories('', 'active');
  foreach($subCategories as $subCategory){
    $html .= "<option value='$subCategory[id]'";
    if($subCategory['id'] == $account['accountsubcategoryid']){$html .= " selected";}
    $html .= ">$subCategory[name]</option>";
  }
  $html .= "</select>";
  $html .= "<label for='subcategorycode'>Sub Category Code</label>";
  $html .= "<input name='subcategorycode' type='number' value='$account[subcategorycode]'>";
  $html .= "<input type='hidden' name='action' value='saveAccount'>";
  $html .= "<input type='hidden' name='id' value='$account[id]'>";
  $html .= "<input type='submit' value='Save Account'>";
  $html .= "</form>";
  return $html;
}

function getTransactionsTable($fromDate=null, $toDate=null){
  if($fromDate==null){$fromDate=strtotime("-1 Months");}
  if($toDate==null){$toDate=strtotime("+1 Day");}
  $transactions = getTransactions($fromDate, $toDate);
  $html = "<div class='table col_4'>";
  $html .= "<div>Date</div><div>Account</div><div>Amount</div><div>Notes</div><div></div>";
  foreach ($transactions as $transaction){
    $tDate = strtotime($transaction['tdate']);
    $account = getAccount($transaction['accountid']);
    $accountName = getAccountNumberByID($account['id']).' '.$account['name'];
    $notes = $transaction['notes'];
    $amount = $transaction['amount'];
    $html .= "<div>".date("m/d/Y", $tDate)."</div><div>$accountName</div><div>$amount</div><div>";
    $html .= "$notes</div><div class='controls'>";
    $html .= "</div>";
  }
  $html .= "</div>";
  return $html;
}
?>