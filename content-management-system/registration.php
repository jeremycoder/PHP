<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php

  //Detect 'submit' from from
  if(isset($_POST['submit'])){
    //Get data from form
    $username  = $_POST['username'];
    //All usernames must be lowercase
    $username  = strtolower($username);
    $password  = $_POST['password'];
    $firstname = $_POST['firstname'];
    $email     = $_POST['email'];
    
    
    //Sanitize data
    $username  = mysqli_real_escape_string($connection, $username);
    $password  = mysqli_real_escape_string($connection, $password);
    $firstname = mysqli_real_escape_string($connection, $firstname);
    $email     = mysqli_real_escape_string($connection, $email);
    
      
    //Query to encrypt password
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
      
    //Insert into users table
    $query  = "INSERT INTO users(user_username, user_password, user_firstname, user_email) ";
    $query .= "VALUES('{$username}','{$password}','{$firstname}','{$email}') ";    
    $result = mysqli_query($connection, $query);
    //Check for errors
    if(!$result){
        echo"<h4 class='text-danger text-center'>Query failed! Error: " . mysqli_error($connection) . "</h4>";
    } else {
        echo "<h4 class='text-success text-center'>User registration successful! <a href='./'>Login</a></h4>";
    }    
  }

?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">First Name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email: somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
        
<?php include "includes/footer.php";?>
