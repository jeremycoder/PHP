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
            
            <?php
                    //Capture search query
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];
                    } else {
                        $search = "";
                    }            
                
                    //Querying post_content table instead of post_tags.
                    $query = "SELECT * FROM posts WHERE post_content LIKE '%$search%' ";    
                    $result = mysqli_query($connection, $query);
    
                    //Stop if query fails
                    if(!$result) {
                        die("Query failed! " . mysqli_error($connection));
                    }
    
                    $count = mysqli_num_rows($result);                 
            ?>
                    <!-- Display search header -->
                    <h1 class="page-header">
            <?php 
                    if ($search != ""){
                        echo "You searched for '".$search."'";
                        
                        if ($count == 1){
                          echo "<br><small>1 result</small>";
                        } else {
                          echo "<br><small>".$count." results</small>";
                        }
                        
                    }
            ?>                    
                    </h1>
                    
            <?php
                    //Display search results
                    if ($count != 0){
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
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                                
                <?php }
                        
                  } // else   
    
                ?>                
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>
  
  <!-- Footer -->     
  <?php include "includes/footer.php" ?>


       