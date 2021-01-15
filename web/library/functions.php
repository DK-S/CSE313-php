<?php

//this function when using the optional parameter will mark the selected optional
function getNavlist($selected=''){
  $navList = '<ul>';
  
  $navList .= '<li';
  if($selected==''){$navList .= ' class="selected"';}
  $navList .= '><a href="./" title="Home Link">Home</a></li>';
  
  $navList .= '<li';
  if($selected=='assignments'){$navList .= ' class="selected"';}
  $navList .= '><a href="./?action=assignments" title="Assignments Link">Assignments</a></li>';
  
  $navList .= '<li';
  if($selected=='about'){$navList .= ' class="selected"';}
  $navList .= '><a href="./?action=about" title="About Link">About</a></li>';
  
  $navList .= '</ul>';
  return $navList;
}

?>