<?php

//this function when using the optional parameter will mark the selected optional
function getNavlist($selected=''){
  $navList = '<ul>';
  
  $navList .= '<li';
  if($selected='Home'){$navList .= ' class="Selected"';}
  $navList .= '><a href="/web/" title="Home Link">Home</a></li>';
  
  $navList .= '<li';
  if($selected='Assignments'){$navList .= ' class="Selected"';}
  $navList .= '><a href="/web/?action=assignments" title="Assignments Link">Assignments</a></li>';
  
  $navList .= '<li';
  if($selected='About'){$navList .= ' class="Selected"';}
  $navList .= '><a href="/web/?action=about" title="About Link">About</a></li>';
  
  $navList .= '</ul>'
  return $navList;
}

?>