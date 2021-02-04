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
  $tb = "<table>";
  $tb .= "<tr><td>First Name</td><td>Last Name</td><td>username</td></tr>";
  foreach ($rows as $user){
    $tb .= "<tr><td>$user[firstname]</td><td>$user[lastname]</td><td>$user[username]</td></tr>";
  }
  $tb .= "</table>";
  return $tb;
}

?>