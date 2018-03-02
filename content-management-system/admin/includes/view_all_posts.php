                        <!-- Heading -->
                        <h1 class="page-header">All Posts</h1>               
                        <div>
                            <h4 class="pull-right"><a href="posts.php?source=add_posts">Add Posts</a></h4>
                        </div>          
                         
                    <?php
                      //Selecting posts in bulk
                      if(isset($_POST['checkboxArray'])){
                          
                          $selectedOptions = $_POST['checkboxArray']; //Selected post_id's
                          $errorLog = 0; //Check if errors in queries
                          $counter = 0; //Count number of successful queries
                          
                          if($_POST['bulkOptions'] !== ""){
                              
                            switch($_POST['bulkOptions']) {                           
                              
                                //Change selected posts' status to draft
                                case "draft":
                                    foreach ($selectedOptions as $option){
                                        $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = {$option}";
                                        $result = mysqli_query($connection, $query);
                                        //Show error if query failed
                                        if(!$result){
                                          echo('Query failed. ERROR: ' . mysqli_error($connection));
                                          $errorLog++;
                                        }
                                        $counter++;
                                    }
                                    
                                    //Show success if no errors
                                    if($errorLog == 0){
                                    echo "<h4 class='text-success'>{$counter} posts updated to draft!</h4>";
                                        $errorLog = 0;                                      
                                    }
                                    break;
                                
                                //Change selected posts' status to published
                                case "published":
                                    foreach ($selectedOptions as $option){
                                        $query = "UPDATE posts SET post_status = 'published' WHERE post_id = {$option}";
                                        $result = mysqli_query($connection, $query);
                                        //Show error if query failed
                                        if(!$result){
                                          echo('Query failed. ERROR: ' . mysqli_error($connection));
                                          $errorLog++;
                                        }
                                        $counter++;
                                    }
                                    
                                    //Show success if no errors
                                    if($errorLog == 0){
                                    echo "<h4 class='text-success'>{$counter} posts updated to published!</h4>";
                                        $errorLog = 0;                                      
                                    }
                                    break;
                                
                                //Delete selected posts
                                case "delete":
                                    foreach ($selectedOptions as $option){
                                        $query = "DELETE FROM posts WHERE post_id = {$option}";
                                        $result = mysqli_query($connection, $query);
                                        //Show error if query failed
                                        if(!$result){
                                          echo('Query failed. ERROR: ' . mysqli_error($connection));
                                          $errorLog++;
                                        }
                                        $counter++;
                                    }
                                    
                                    //Show success if no errors
                                    if($errorLog == 0){
                                    echo "<h4 class='text-success'>{$counter} posts deleted!</h4>";
                                        $errorLog = 0;                                      
                                    }
                                    break;                               
                                
                            } 
                            
                      }
                          

                      }

                    ?>
                        
                    <!-- Posts Table -->
                    <form action="" method="post">
                         <div id="bulkOptionsContainer" class="col-xs-4">
                           <select class="form-control" name="bulkOptions" id="">
                             <option class="" value="">Select Options</option>
                             <option value="published">Publish</option>
                             <option value="draft">Draft</option>
                             <option value="delete">Delete</option>    
                           </select>
                         </div>
                         <input type="submit" type="submit" name="submit" class="btn btn-success" value="Apply">
                          
                           <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox" onclick="selectAll()"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               <?php
                                 
                                //Update comment count
                                comment_count();
                                
                                 //Get all posts
                                 //Insert into categories table
                                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                                $result = mysqli_query($connection, $query);
                                
                                //Show error if query failed
                                if(!$result){
                                    die('Query failed. ERROR: ' . mysqli_error($connection));
                                }
                        
                                //Display data in table rows
                                while($row = mysqli_fetch_assoc($result)){
                                  $post_id = $row['post_id'];
                                    
                                  //Get category title using post_category_id                          
                                  $post_category_id = $row['post_category_id'];                                  
                                  $post_title = $row['post_title'];
                                  $post_author = $row['post_author'];
                                  $post_date = $row['post_date'];
                                  $post_image = $row['post_image'];
                                  $post_content = $row['post_content'];
                                  $post_tags = $row['post_tags'];
                                  $post_comment_count = $row['post_comment_count'];
                                  $post_status = $row['post_status'];
                                
                                  echo "<tr>";
                                  ?>
                                    <td><input class='checkbox' type='checkbox' name='checkboxArray[]'
                                    value='<?php echo $post_id ?>'></td>
                                    
                                  <?php
                                    echo "
                                    <td>{$post_id}</td>
                                    <td>{$post_author}</td>
                                    <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";
                                    
                                    //Get categories from category table in database
                                      $catQuery = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id}";
                                      $catResult = mysqli_query($connection, $catQuery);
                                    
                                      //Convert result to array
                                      while($row = mysqli_fetch_assoc($catResult)){
                                        $cat_title = $row['cat_title'];
                                      }
                                    
                                    //Display Category title
                                    echo "<td>{$cat_title}</td>";                                    
                                    
                                    echo"<td>{$post_status}</td>
                                    <td>
                                      <img src='../images/{$post_image}' width='100'>
                                    </td>
                                    <td>{$post_tags}</td>
                                    <td>{$post_comment_count}</td>
                                    <td>{$post_date}</td>
                                    <td><a class='text-primary' href='posts.php?source=edit_posts&edit_post_id={$post_id}'>Edit</a></td>
                                    <td><a class='text-danger' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete_post={$post_id}'>Delete</a></td>
                                        </tr>";                        
                                }
    
                               ?>
                                                               
                            </tbody>
                        </table> 
                      </form>
                        
                        <div class="from-group">
                          <a href="index.php" class="btn btn-warning">Back</a>
                        </div>
                        
                    <!-- Check all checkboxes -->
                    <script>
                      //Selects all checkboxes when header checkbox is clicked
                      function selectAll(){
                        var checkAll = document.getElementById('selectAllBoxes');
                        var allCheckBoxes, i = 0;                      
                        if (selectAllBoxes.checked){
                          allCheckBoxes = document.getElementsByClassName('checkbox');
                          for(i = 0; i < allCheckBoxes.length; i++){
                              allCheckBoxes[i].checked = true;
                          }                          
                        } else if (!selectAllBoxes.checked){
                          allCheckBoxes = document.getElementsByClassName('checkbox');
                          for(i = 0; i < allCheckBoxes.length; i++){
                              allCheckBoxes[i].checked = false;
                          }
                        }                        
                      }                         
                    </script>   