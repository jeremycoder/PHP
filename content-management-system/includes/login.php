<?php 
    
   //Include database login info
   include "db.php";
   //Will use sessions for logging in
   session_start();

  //Check if login form submitted
  if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
      
    //Sanitize login information
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);
      
    //Encrypt password
    $query  = 'SELECT user_rand_salt FROM users';
    $result = mysqli_query($connection, $query);
    //Check for errors
    if(!$result){
        die("<h4>Query failed! Error: " . mysqli_error($connection) . "</h4>");
    }
    
    //Get randSalt (for encryption) from $query 
    $randSalt = mysqli_fetch_array($result)[0];
    
    //Encrypt password
    $password = crypt($password, $randSalt);
      
    //Attempt to login
    $query = "SELECT * FROM users WHERE user_username = '{$username}' ";
    $query .= "AND user_password = '{$password}'";
    $result = mysqli_query($connection, $query);
    //Check for errors
    if(!$result){
      die("ERROR! " . mysqli_error($connection));
    }
    
    //Login
    if($row = mysqli_fetch_array($result)){
        //Assign user data to session file
        $_SESSION['username'] = $row['user_username'];
        $_SESSION['firstname'] = $row['user_firstname'];
        $_SESSION['lastname'] = $row['user_lastname'];
        $_SESSION['email'] = $row['user_email'];
        $_SESSION['role'] = $row['user_role'];
        
        header("Location: ../admin/");        
    } else {
        header("Location: ../index.php");
    } 
    

  }
      
    
  




?>


