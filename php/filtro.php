<?php 
function filtra($string)
 {
  $mysqli2= new mysqli("ftp.mojivote.altervista.org","mojivote",null,"my_mojivote");
  if (get_magic_quotes_gpc())
   $string = stripslashes($string);
  if (!is_numeric($string))
   $string = $mysqli2->real_escape_string($string);
  return $string;  
 }
 
 ?>