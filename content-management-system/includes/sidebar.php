<div class="col-md-4">
                
                
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">                    
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form><!-- search form -->
                    <!-- /.input-group -->
                </div>
                
                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <?php 
                      if(isset($_GET['login_failed'])){
                          echo "<p class='text-danger'>Login failed!</p>";
                      }
                    
                    ?>
                    <form action="includes/login.php" class="form-group" method="POST">                    
                      <div class="form-group">
                        <input name="username" type="text" class="form-control" placeholder="username" required>
                      </div>
                      <div class="input-group">
                        <input name="password" type="password" class="form-control" placeholder="password" required>
                      <span class="input-group-btn">
                        <button name="login" class="form-control btn-primary" type="submit">Submit</button>
                      </span>
                    </div>
                    <div class="form-group">
                        <br>
                        <p>Not yet Registered?<a href="registration.php"> Register</a> now.</p>
                    </div>                    
                    </form><!-- search form -->
                    <!-- /.input-group -->
                </div>
                
                
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">                            
                
                <?php                    
                               //Get categories from category table
                               $query = "SELECT * FROM categories";
                               $result = mysqli_query($connection, $query);
                               //Convert result to array
                               while($row = mysqli_fetch_assoc($result)){
                                   $cat_title = $row['cat_title'];
                                   $cat_id = $row['cat_id'];
                    
                               //Display as list items
                               echo "<li>
                                 <a href='category.php?category=$cat_id'>{$cat_title}</a>
                               </li>";
                               }                 
                ?>                                
                            </ul>
                        </div>                        
                    </div><!-- /.row -->
                </div>               

                <!-- Side Widget Well -->
                <?php include "widgets.php" ?>

            </div>