                        <!-- Heading -->
                        <h1 class="page-header">All Comments</h1>
                                                
                          <!-- Comments Table -->
                           <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>                                    
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               <?php        
                                
                                 //Get all comments
                                 //Insert into comments table
                                $query = "SELECT * FROM comments";
                                $result = mysqli_query($connection, $query);
                                
                                //Show error if query failed
                                if(!$result){
                                    die('Query failed. ERROR: ' . mysqli_error($connection));
                                }
                        
                                //Display data in table rows
                                while($row = mysqli_fetch_assoc($result)){
                                  $comment_id = $row['comment_id'];
                                  $comment_post_id = $row['comment_post_id'];                                
                                  $comment_author = $row['comment_author'];
                                  $comment_date = $row['comment_date'];
                                  $comment_content = $row['comment_content'];
                                  $comment_status = $row['comment_status'];
                                  $comment_email = $row['comment_email'];
                                                                
                                  echo "
                                    <tr>
                                    <td>{$comment_id}</td>
                                    <td>{$comment_author}</td>
                                    <td>{$comment_content}</td>                         
                                    <td>{$comment_email}</td>                        
                                    <td>{$comment_status}</td>";
                                    
                                    //Get post_title from posts using comment_post_id
                                      $postQuery = "SELECT post_title FROM posts WHERE post_id = {$comment_post_id}";
                                      $postResult = mysqli_query($connection, $postQuery);
                                    
                                      //Convert result to array
                                      while($row = mysqli_fetch_assoc($postResult)){
                                        $post_title = $row['post_title'];
                                      }
                                    
                                    //Display Post title
                                    echo "<td><a target='_blank' href='../post.php?p_id={$comment_post_id}'>{$post_title}</a></td>";        
                                    
                                    echo "
                                      <td>{$comment_date}</td>
                                      <td><a class='text-primary' href='comments.php?approve_comment={$comment_id}'>Approve</a></td>
                                      <td><a class='text-warning' href='comments.php?unapprove_comment={$comment_id}'>Unapprove</a></td> 
                                      <td><a class='text-danger' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \"href='comments.php?delete_comment={$comment_id}'>Delete</a></td>
                                        </tr>";                        
                                }
    
                               ?>
                                                               
                            </tbody>
                        </table>
                        
                        <div class="from-group">
                          <a href="index.php" class="btn btn-warning">Back</a>
                        </div>
                        
                        <?php

                            //Unapprove comment
                            if(isset($_GET['unapprove_comment'])){
                              $unapprove_comment_id = $_GET['unapprove_comment'];                                        
                              $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$unapprove_comment_id}";
                              $result = mysqli_query($connection, $query);
                              //Refresh page
                              header('Location: comments.php');
                            }

                            //Approve comment
                            if(isset($_GET['approve_comment'])){
                             $approve_comment_id = $_GET['approve_comment'];                                        
                             $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$approve_comment_id}";
                             $result = mysqli_query($connection, $query);
                             //Refresh page
                             header('Location: comments.php');
                            }

                            //Delete comment
                            if(isset($_GET['delete_comment'])){
                              $delete_comment_id = $_GET['delete_comment'];                                        
                              $query = "DELETE FROM comments WHERE comment_id = {$delete_comment_id}";
                              $result = mysqli_query($connection, $query);                              
                              //Refresh page
                              header('Location: comments.php');
                            }        

                        ?>
                        
                             