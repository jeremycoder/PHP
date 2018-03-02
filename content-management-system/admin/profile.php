        <!-- Header -->
        <?php include "includes/admin_header.php" ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>
        
          
        
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                       <h1 class="page-header">
                           <?php echo $_SESSION['firstname'] ?>, Your Profile Page.
                        </h1>
                        <h4>Edit or cancel to return.</h4>
                        
                        <?php 
    
                            //Post data from form to users table
                            if(isset($_POST['edit_user'])){
                              //Get data from form
                              $user_username  =  $_POST['user_username'];
                              $user_password  =  $_POST['user_password'];
                              
                              //Query to get rand_salt from users table
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
                              $query = "UPDATE users SET  
                                          user_password='{$user_password}', user_firstname='{$user_firstname}',
                                          user_lastname='{$user_lastname}', user_email='{$user_email}',
                                          user_role='{$user_role}', user_date_created='{$user_date_created}'
                                           WHERE user_username = '{$user_username}'";
      
                                //Send to database
                                $result = mysqli_query($connection, $query);      
                                //Show fail or success
                                if (!$result) {
                                    echo("<h4 class='text-danger'>Update profile failed! ERROR: [". mysqli_error($connection) . "]</h4>");
                                } else {
                                    echo("<h4 class='text-success'>User edit successful!</h4>");
                                    //Change first name if first name has been changed
                                    $_SESSION['firstname'] = $_POST['user_firstname'];
                                    header("Location: profile.php");
                                    
                                }   
                            }

                            //Get users information from table
                            $query = "SELECT * FROM users WHERE user_username = '{$_SESSION['username']}' ";
                            $result = mysqli_query($connection, $query);
                            
                            while($row = mysqli_fetch_array($result)){
                                $user_username  =  $row['user_username'];
                                $user_firstname  =  $row['user_firstname'];
                                $user_lastname  =  $row['user_lastname'];
                                $user_password  =  $row['user_password'];
                                $user_email  =  $row['user_email'];
                                $user_role  =  $row['user_role'];
                                $user_date_created  =  $row['user_date_created'];                                
                            }

                                
                        ?>  
                        
                        <!-- Display data in form -->
                        <form action="" method="post" enctype="multipart/form-data">
   
                           <div class="from-group">
                               <label for="username">Username</label>
                               <input type="text" value="<?php echo $user_username ?>" class="form-control" name="user_username" readonly>
                           </div>
                           
                           <div class="from-group">
                               <label for="last_name">Password</label>
                               <input id="password" type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
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
                               <input value="<?php echo $user_date_created ?>" type="date" class="form-control" name="user_date_created" readonly>
                           </div>
   
                           <div class="form-group">
                             <label for="title">Role</label> 
                             <input value="<?php echo $user_role ?>" type="text" class="form-control" name="user_role">
                            </div>
                            
                          <div class="from-group">
                             <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                             <a href="index.php" class="btn btn-warning">Cancel</a>
                           </div> 
    
                        </form>     
                                               
                    </div>
                </div>
                <!-- /.row -->                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Footer -->
    <?php include "includes/admin_footer.php" ?>