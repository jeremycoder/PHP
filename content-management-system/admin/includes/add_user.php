  <!-- Heading -->
  <h1 class="page-header">Add User</h1>
  <!-- View All Posts Link -->
   <div>
    <h4 class="pull-right"><a href="users.php">View All Users</a></h4>
   </div>

<?php


?>

<?php

  if(isset($_POST['add_user'])){
      $user_username  =  $_POST['user_username'];
      $user_password  =  $_POST['user_password'];
      $user_firstname  =  $_POST['user_firstname'];
      $user_lastname  =  $_POST['user_lastname'];
      $user_email  =  $_POST['user_email'];
      
      $user_image = $_FILES['user_image']['name'];
      $user_image_temp = $_FILES['user_image']['tmp_name'];
      
      $user_date_created  =  $_POST['user_date_created'];
      $user_role  =  $_POST['user_role'];
            
      //Move uploaded images
      move_uploaded_file($user_image_temp, "../images/$user_image");
      
      //Insert query into post table in db
      $query = "INSERT INTO users(user_username, user_password, user_firstname,
                user_lastname, user_email, user_date_created, 
                user_role, user_rand_salt) ";
      $query.= "VALUES ('{$user_username}','{$user_password}','{$user_firstname}',
                '{$user_lastname}','{$user_email}','{$user_date_created}',
                '{$user_role}','')";
      
      //Send to database
      $result = mysqli_query($connection, $query);
      
      //Show fail or success
      if (!$result) {
          echo("<h4 class='text-danger'>Failed to add user! ERROR: [". mysqli_error($connection) . "]</h4>");
      } else {
          echo("<h4 class='text-success'>User added successfully!</h4>");
      }
  }

?>

  <form action="" method="post" enctype="multipart/form-data">
   
   <div class="from-group">
       <label for="username">Username</label>
       <input type="text" class="form-control" name="user_username" required>
   </div>
      
   <div class="form-group">
     <label for="password">Password</label> 
     <input type="password" class="form-control" name="user_password" required>
   </div>
   
   <div class="from-group">
       <label for="first_name">First Name</label>
       <input type="text" class="form-control" name="user_firstname" required>
   </div>
   
   <div class="from-group">
       <label for="last_name">Last Name</label>
       <input type="text" class="form-control" name="user_lastname">
   </div>
   
   <div class="from-group">
       <label for="email">Email</label>
       <input type="email" class="form-control" name="user_email" required>
   </div>
     
   <div class="from-group">
       <label for="user_date_created">Date Created</label>
       <input id="datePicker" type="date" class="form-control" name="user_date_created">
   </div>
   
   <script>
     //Automatically add today's date
     Date.prototype.toDateInputValue = (function() {
      var local = new Date(this);
      local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
      return local.toJSON().slice(0,10);
     });
     document.getElementById('datePicker').value = new Date().toDateInputValue();   
   </script>
   
   <div class="form-group">
     <label for="title">Role</label> 
     <select class="form-control" name="user_role">
       <option>admin</option>
       <option selected>subscriber</option>      
     </select>
    </div>
   
   <div class="from-group">
       <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
   </div> 
    
</form>