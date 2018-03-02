<?php     
   
   //Will use sessions for logging in
   session_start();

  //Nullify session data
  $_SESSION['username'] = null;
  $_SESSION['firstname'] = null;
  $_SESSION['lastname'] = null;
  $_SESSION['email'] = null;
  $_SESSION['role'] = null;

  header("Location: ../index.php");

?>


