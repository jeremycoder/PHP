                        <!-- Heading -->
                        <h1 class="page-header">All Users</h1>
                        <!-- Add Users Link --> 
                        <div>
                            <h4 class="pull-right"><a href="users.php?source=add_users">Add Users</a></h4>
                        </div>
                          <!-- Users Table -->
                           <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date Created</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               <?php        
                                
                                 //Get all comments
                                 //Insert into comments table
                                $query = "SELECT * FROM users";
                                $result = mysqli_query($connection, $query);
                                
                                //Show error if query failed
                                if(!$result){
                                    die('Query failed. ERROR: ' . mysqli_error($connection));
                                }
                        
                                //Display data in table rows
                                while($row = mysqli_fetch_assoc($result)){
                                  $user_id = $row['user_id'];
                                  $user_username = $row['user_username'];                                
                                  $user_firstname = $row['user_firstname'];
                                  $user_lastname = $row['user_lastname'];
                                  $user_email = $row['user_email'];
                                  $user_role = $row['user_role'];
                                  $user_date_created = $row['user_date_created'];
                                  
                                                                
                                  echo "
                                    <tr>
                                    <td>{$user_id}</td>
                                    <td>{$user_username}</td>
                                    <td>{$user_firstname}</td>
                                    <td>{$user_lastname}</td>
                                    <td>{$user_email}</td>                        
                                    <td>{$user_role}</td>
                                    <td>{$user_date_created}</td>";                         
                                   echo "
                                      <td><a class='text-primary' href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td> 
                                      <td><a class='text-danger' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='users.php?delete_user={$user_id}'>Delete</a></td>
                                        </tr>";                        
                                }
    
                               ?>
                                                               
                            </tbody>
                        </table>
                        
                        <div class="from-group">
                          <a href="index.php" class="btn btn-warning">Back</a>
                        </div>
                        
                        <?php                            

                            //Delete comment
                            if(isset($_GET['delete_user'])){
                              $delete_user_id = $_GET['delete_user'];                                        
                              $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
                              $result = mysqli_query($connection, $query);                              
                              //Refresh page
                              header('Location: users.php');
                            }                          

                        ?>
                        
                             