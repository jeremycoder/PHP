<!-- Heading -->
<h1 class="page-header">Edit User</h1>
  <!-- View All Posts Link -->
<div>
    <h4 class="pull-right"><a href="users.php">View All Users</a></h4>
</div>
  
<?php 

  //Post data from form to users table
  if(isset($_POST['edit_user'])){
    //Get data from form
    $user_username  =  $_POST['user_username'];
    $user_password  =  $_POST['user_password'];
    
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
    $user_password = crypt($user_password, $randSalt);
    
    $user_firstname  =  $_POST['user_firstname'];
    $user_lastname  =  $_POST['user_lastname'];
    $user_email  =  $_POST['user_email'];
    $user_role  =  $_POST['user_role'];    
    $user_date_created  =  $_POST['user_date_created'];
      
    //Update table
    $query = "UPDATE users SET user_username='{$user_username}', user_password='{$user_password}', 
                user_firstname='{$user_firstname}', user_lastname='{$user_lastname}',
                user_email='{$user_email}', user_role='{$user_role}', 
                user_date_created='{$user_date_created}'
                 WHERE user_id = {$_GET['user_id']}";
      
      //Send to database
      $result = mysqli_query($connection, $query);      
      //Show fail or success
      if (!$result) {
          echo("<h4 class='text-danger'>User edit failed! ERROR: [". mysqli_error($connection) . "]</h4>");
      } else {
          echo("<h4 class='text-success'>User edit successful!</h4>");
      }     
    
  }

  //Get data from users table
  if(isset($_GET['user_id'])){
      $user_id = $_GET['user_id'];      
      $query = "SELECT * FROM users WHERE user_id = {$user_id}";      
      $result = mysqli_query($connection, $query);
      //Convert result to array
      while($row = mysqli_fetch_assoc($result)){
        $user_username  =  $row['user_username'];
        $user_password  =  $row['user_password'];
        $user_firstname  =  $row['user_firstname'];
        $user_lastname  =  $row['user_lastname'];
        $user_email  =  $row['user_email'];
        $user_role  =  $row['user_role'];
        $user_date_created  =  $row['user_date_created'];
      } 
   }

 ?>

<!-- Display data in form -->
<form action="" method="post" enctype="multipart/form-data">
   
   <div class="from-group">
       <label for="username">Username</label>
       <input type="text" value="<?php echo $user_username ?>" class="form-control" name="user_username">
   </div>
   
   <div class="from-group">
       <label for="username">Password</label>
       <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
   </div>  
   
   <div class="from-group">
       <label for="first_name">First Name</label>
       <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
   </div>
   
   <div class="from-group">
       <label for="last_name">Last Name</label>
       <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
   </div>
   
   <div class="from-group">
       <label for="email">Email</label>
       <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
   </div>
      
   <div class="from-group">
       <label for="user_date_created">Date Created</label>
       <input value="<?php echo $user_date_created ?>" type="date" class="form-control" name="user_date_created">
   </div>
   
   <div class="form-group">
     <label for="title">Role</label> 
     <input value="<?php echo $user_role ?>" type="text" class="form-control" name="user_role">
    </div>
   
   <div class="from-group">
       <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
   </div> 
    
</form>
  

   



   
   


