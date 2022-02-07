<?php
 
 $db = mysqli_connect("localhost", "root", "", "library_app");

  if($db) {
   "Database Connected Successfully" ;
 } 
 else {
       
     die("mysql Error. "  .  mysqli_error($db) );
      
 }

?>