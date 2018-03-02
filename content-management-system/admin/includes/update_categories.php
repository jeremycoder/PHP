<!-- Update Categories Form -->
 <form action="" method="POST">
  <div class="form-group">
    <label for="cat_title">Update Category</label>
                                 
    <?php
                                   
    //Check if "Edit" link clicked
    if(isset($_GET['edit_cat_id'])){
        $update_cat_id = $_GET['edit_cat_id'];
        //Query database to get category title
        $query = "SELECT cat_title FROM categories WHERE cat_id = {$_GET['edit_cat_id']}";
        $result = mysqli_query($connection, $query);
                                    
       //Convert result to array
       while($row = mysqli_fetch_assoc($result)){
         $update_cat_title = $row['cat_title'];
       }                                     
    }
                                   
                                   
    ?>
    <!-- PHP: Display category title in input -->                                                       
    <input value="<?php if(isset($update_cat_title)) {echo $update_cat_title;} ?>" type="text" class="form-control" name="update_cat_title" required>       
  </div>
                               
  <?php
                                 
     //Update Query
     if(isset($_POST['update_cat_title'])){
       $query = "UPDATE categories SET cat_title = '{$_POST['update_cat_title']}' WHERE cat_id = $update_cat_id";
       $result = mysqli_query($connection, $query);                                
        //Show error if query failed
        if(!$result){
            echo('Query failed. ERROR: ' . mysqli_error($connection));
        }
     }                                 
                                  
  ?>                                                                                     
                                                                                         
  <div class="form-group">                             
    <input type="submit" class="btn btn-primary" name="submit_category_title" value="Update Category">                             
  </div>                               
 </form>