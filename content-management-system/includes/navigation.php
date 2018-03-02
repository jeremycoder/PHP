<?php
  //Will use sessions
   session_start();
?>
       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                  
                  <?php
                    
                    //Get categories from category table
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query);
                    //Convert result to array
                    while($row = mysqli_fetch_assoc($result)){
                        $cat_title = $row['cat_title'];
                    
                    //Display as list items
                    echo "<li>
                      <a href='#'>{$cat_title}</a>
                    </li>";
                    }                    
                  ?>
                    <!-- Add Admin Link -->
                    <li><a href="admin/">Admin</a></li>
                    
                    <?php 
                    //Does not show
                    if (isset($_SESSION['username'])){
                      if(isset($_GET['p_id'])){
                        $p_id = $_GET['p_id'];
                        echo "<li><a href='admin/posts.php?source=edit_posts&edit_post_id={$p_id}'>Edit Post</a></li>";  
                      }                                             
                    }
                    
                    ?>
                </ul>             
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>