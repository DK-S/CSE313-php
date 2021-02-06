<?php

//this function when using the optional parameter will mark the selected optional
function getNavlist($selected=''){
  $navList = '<ul>';
  
  $navList .= '<li';
  if($selected=='dashboard' || $selected==''){$navList .= ' class="selected"';}
  $navList .= '><a href="./?action=dashboard" title="Dashboard Link">Dashboard</a></li>';
  
  //Add this button if the user is logged in and is an admin
  $navList .= '<li';
  if($selected=='admin'){$navList .= ' class="selected"';}
  $navList .= '><a href="./?action=admin" title="Admin page Link">Admin</a></li>';
  
  $navList .= '<li id="Main"><a href="/" title="Main page link">Main Page</a></li>';

  $navList .= '</ul>';
  return $navList;
}

function getUserTable(){
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
    if ($user["active"]){
      $tb .= "<a href='/budget/?action=removeuser&id=$user[id]' title='Link to remove category'>Remove</a>";
    } else {
      $tb .= "<a href='/budget/?action=restoreuser&id=$user[id]' title='Link to restore category'>Restore</a>";
    }
    $tb .= "   <a href='/budget/?action=resetpassword&id=$user[id]' title='Link to reset password'>Reset</a>";
    $tb .= "</div>";
  }
  $tb .= "</div>";
  return $tb;
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
    default:
      break;
  }
  
  $html .= "<input type='submit' value='Search'>";
  $html .= "</form></div>";
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
      break;
    default:
      break;
  }
  $html .= "</ul></nav>";
  return $html;
}

function getBudget(){
  
}

?>