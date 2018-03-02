    <!-- Database Connection -->
    <?php include "includes/db.php" ?>
    
    <!-- Header -->
    <?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
<!--
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
-->
                
                <?php
    
                if(isset($_GET['p_id'])){
                    $my_post_id = $_GET['p_id'];
                }

                //Query the posts table
                $query = "SELECT * FROM posts WHERE post_id = {$my_post_id}";
                $result = mysqli_query($connection, $query);
                //Convert result to array
                while($row = mysqli_fetch_assoc($result)){
                    //Assign to variables
                    $post_title    = $row['post_title'];
                    $post_author   = $row['post_author'];
                    $post_date     = $row['post_date'];
                    $post_image    = $row['post_image'];
                    $post_content  = $row['post_content'];
                    $post_title    = $row['post_title'];
                ?>
                
                <!-- A Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" width="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
                                
                <?php } ?>
                
                <!-- Blog Comments -->
                
                <?php
                  
                  //Check if comment was posted
                  if(isset($_POST['create_comment'])){
                    
                    //Retrieve data from form
                    $comment_author  = $_POST['comment_author'];
                    $comment_email   = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    //Retrieve post post_id
                    $my_post_id = $_GET['p_id'];                    
                      
                    //Insert into comments database
                    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                    $query .= "VALUES ($my_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved', NOW())";
                    $result = mysqli_query($connection, $query);
                    //Show fail or success
                    if (!$result) {
                        echo("<h4 class='text-danger'>Query failed! ERROR: [". mysqli_error($connection) . "]</h4>");
                    } else {                        
                        if (!$result){
                          echo("<h4 class='text-danger'>Add comment failed! ERROR: [". mysqli_error($connection) . "]</h4>");
                        } else {
                          echo("<h4 class='text-success'>Comment posted successfully! Wait for approval.</h4>");
                        }
                        
                    }
                      
                  }
                
                ?>                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="Author">Name</label>
                            <input type="text" class="form-control" name="comment_author" required>
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email" required>
                        </div>
                        <div class="form-group">
                            <label for="Comment">Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                <?php
                
                  $query =  "SELECT * FROM comments WHERE comment_post_id = {$my_post_id} ";
                  $query .= "AND comment_status = 'approved' ";
                  $query .= "ORDER BY comment_id DESC";
                  $result = mysqli_query($connection, $query);
                  //Show fail or success
                  if (!$result) {
                      die("<h4 class='text-danger'>ERROR: failed to load comments: [". mysqli_error($connection) . "]</h4>");
                  } else {
                      //Display comments
                      while ($row = mysqli_fetch_array($result)){
                        $comment_author  = $row['comment_author'];
                        $comment_date    = $row['comment_date'];
                        $comment_content = $row['comment_content'];                 
                ?>
                
                <!-- Comment -->
                <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class="media-object" src="images/comment-50-50.png" width="40" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>
                
                
                
                <?php
                          
                                
                          
                      }
                  }
                
                
                ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
  
  <!-- Footer -->     
  <?php include "includes/footer.php" ?>


       