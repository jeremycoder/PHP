<!-- Heading -->
<h1 class="page-header">Edit Post</h1>
  <!-- View All Posts Link -->
   <div>
    <h4 class="pull-right"><a href="posts.php">View All Posts</a></h4>
</div>

<?php

  if(isset($_POST['update_post'])){
      $post_title  =  $_POST['post_title'];
      $post_category_id =  $_POST['post_category_id'];
      $post_author = $_POST['post_author'];
      $post_status = $_POST['post_status'];              
      
      
      
      //If image is uploaded use it
      if(isset($_FILES['update_image']['name'])){
          
        $post_image = $_FILES['update_image']['name'];
        $post_image_temp = $_FILES['update_image']['tmp_name'];
          
        //Move uploaded images
        move_uploaded_file($post_image_temp, "../images/$post_image");
          
      //Otherwise get image from database
      } else {
        //Get image from database
        $imageQuery = "SELECT post_image FROM posts WHERE post_id = {$_GET['edit_post_id']}";
        $result = mysqli_query($connection, $imageQuery);
      
        //Convert query to array        
        while($row = mysqli_fetch_assoc($result)) {
        $post_image = $row['post_image'];
        } 
          
      }  
      
      
      $post_tags = $_POST['post_tags'];
      $post_content = $_POST['post_content'];     
      
      //$post_date = $_POST['post_date'];
      $post_comment_count = 4;
      
      
      
      //Keep original image if no image uploaded
//      if($post_image = ""){
//          $post_image = $_POST['post_image'];
//      }
      
      //Insert query into post table in db
      $query = "UPDATE posts SET post_category_id='{$_POST['post_category_id']}', 
                post_title='{$post_title}', post_author='{$post_author}',
                post_date='{$_POST['post_date']}', post_image='{$post_image}', 
                post_content='{$post_content}', post_tags='{$post_tags}',
                post_status='{$post_status}' WHERE post_id = {$_GET['edit_post_id']}";
      
      //Send to database
      $result = mysqli_query($connection, $query);
      
      //Show fail or success
      if (!$result) {
          echo("<h4 class='text-danger'>Query failed! ERROR: [". mysqli_error($connection) . "]</h4>");
      } else {
          $post_id = $_GET['edit_post_id'];
          echo("<h4 class='text-success'>Post successful! <a href='../post.php?p_id={$post_id}' target='_blank'>See it!</a></h4>");          
      }
  }

?>
 <?php

  //Edit post
  if(isset($_GET['edit_post_id'])){
      $post_id = $_GET['edit_post_id'];
      
      //Get post information from table
      $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
      //Send to database
      $result = mysqli_query($connection, $query);
      //Convert result to array
      while($row = mysqli_fetch_assoc($result)){
        $post_title  =  $row['post_title'];
        $post_category_id =  $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_status = $row['post_status'];      
        $post_image = $row['post_image'];      
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];
        $post_comment_count = $row['post_comment_count'];
      }     
      
  }

 ?>

  <div class="">
    <form action="" method="post" enctype="multipart/form-data">
   
   <div class="from-group">
       <label for="post_title">Post Title</label>
       <input value='<?php echo $post_title ?>' type="text" class="form-control" name="post_title">
   </div>
   
   
    <div class="form-group">
     <label for="title">Post Categories</label> 
     <select class="form-control" name="post_category_id">     
   
   <?php
    
     //Get categories from category table in database
     $catQuery = "SELECT * FROM categories";
     $result = mysqli_query($connection, $catQuery);
                                    
     //Convert result to array
     while($row = mysqli_fetch_assoc($result)){
       $cat_id = $row['cat_id'];
       $cat_title = $row['cat_title'];
    
       //Select current option
       if ($post_category_id == $cat_id){
         echo "<option value='{$cat_id}' selected>{$cat_id}  {$cat_title}</option>";    
       } else {
         echo "<option value='{$cat_id}'>{$cat_id}  {$cat_title}</option>";
       }       
         
     }
              
    ?>    
      </select>
    </div>       
   
   <div class="from-group">
       <label for="post_author">Post Author</label>
       <input id="title" value='<?php echo $post_author ?>' type="text" class="form-control" name="post_author">
   </div>
   
   <div class="form-group">
     <label for="post_status">Post Status</label> 
     <select class="form-control" name="post_status">
      <?php 
        
        if ($post_status === 'published'){
          echo "<option value='published' selected>published</option>
                <option value='draft'>draft</option>";            
        } else {
          echo "<option value='draft' selected>draft</option>
                <option value='published'>published</option>";
        }
          
              
         
      ?>      
            
     </select>
    </div>

   
   <div class="from-group">
       <label for="title">Post Image</label>
       <img src="../images/<?php echo $post_image ?>" width="100">
       <input value='<?php echo $post_image ?>' type="text" class="form-control" name="post_image">
   </div>
   
   <div class="from-group">
       <label for="title">Update Image</label>
       <input type="file" name="update_image">
   </div>
   
   <div class="from-group">
       <label for="title">Post Tags</label>
       <input value='<?php echo $post_tags ?>' type="text" class="form-control" name="post_tags">
   </div>
   
   <?php
    
      //Get date from database
      $dateQuery = "SELECT post_date FROM posts WHERE post_id = {$_GET['edit_post_id']}";
      $result = mysqli_query($connection, $dateQuery);
              
      while($row = mysqli_fetch_assoc($result)) {
      $post_date = $row['post_date'];
      }
    ?>
              
     <div class="from-group">
      <label for="title">Post Date</label>
      <input value='<?php echo $post_date ?>' type="text" class="form-control" name="post_date">
     </div>  
   
   <div class="from-group">
       <label for="title">Post Content</label>
       <textarea class="form-control" name="post_content" cols="30" rows="10"><?php echo $post_content ?></textarea>
   </div>
   
   <div class="from-group">
       <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
   </div> 
    
</form>      
  </div>
  
  