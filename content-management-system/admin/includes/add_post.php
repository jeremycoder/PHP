  <!-- Heading -->
  <h1 class="page-header">
      Add Posts
  <small>Author</small>
  </h1>
  <!-- View All Posts Link -->
   <div>
    <h4 class="pull-right"><a href="posts.php">View All Posts</a></h4>
</div>

<?php


?>

<?php

  if(isset($_POST['create_post'])){
      $post_title  =  $_POST['post_title'];
      $post_category_id =  $_POST['post_category_id'];
      $post_author = $_POST['post_author'];
      $post_status = $_POST['post_status'];
      
      $post_image = $_FILES['image']['name'];
      $post_image_temp = $_FILES['image']['tmp_name'];
      
      $post_tags = $_POST['post_tags'];
      $post_content = $_POST['post_content'];
      $post_date = date('d-m-y');
      $post_comment_count = 0;
      
      //Move uploaded images
      move_uploaded_file($post_image_temp, "../images/$post_image");
      
      //Insert query into post table in db
      $query = "INSERT INTO posts(post_category_id, post_title, post_author,
                post_date, post_image, post_content, 
                post_tags, post_comment_count, post_status) ";
      $query.= "VALUES ({$post_category_id},'{$post_title}','{$post_author}',
                now(),'{$post_image}','{$post_content}',
                '{$post_tags}',{$post_comment_count},'{$post_status}')";
      
      //Send to database
      $result = mysqli_query($connection, $query);
      
      //Show fail or success
      if (!$result) {
          echo("<h4 class='text-danger'>Query failed! ERROR: [". mysqli_error($connection) . "]</h4>");
      } else {
          //Get id of latest query (must be auto increment id)
          $last_id = mysqli_insert_id($connection);
          echo("<h4 class='text-success'>Post successful! <a href='../post.php?p_id={$last_id}'>See it!</a> 
            <a href='posts.php?source=edit_posts&edit_post_id={$last_id}'>Edit it!</a></h4>");
      }
  }

?>

  <form action="" method="post" enctype="multipart/form-data">
   
   <div class="from-group">
       <label for="title">Post Title</label>
       <input type="text" class="form-control" name="post_title">
   </div>
      
   <div class="form-group">
     <label for="title">Post Category</label> 
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
       <label for="title">Post Author</label>
       <input type="text" class="form-control" name="post_author">
   </div>
   
   <div class="form-group">
     <label for="title">Post Status</label> 
     <select class="form-control" name="post_status">
       <option selected>draft</option>
       <option>published</option>      
     </select>
    </div>
   
   <div class="from-group">
       <label for="title">Post Image</label>
       <input type="file" name="image">
   </div>
   
   <div class="from-group">
       <label for="title">Post Tags</label>
       <input type="text" class="form-control" name="post_tags">
   </div>
   
   <div class="from-group">
       <label for="title">Post Content</label>
       <textarea class="form-control" name="post_content" cols="30" rows="10"></textarea>
   </div>
   
   <div class="from-group">
       <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
   </div> 
    
</form>