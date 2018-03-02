<?php

//Add categories in categories table
function add_categories_table(){
    
    //Make variable $connection available everywhere
    global $connection;
    
    //Get information from categories form
    if (isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
                                
        //Insert into categories table
        $query = "INSERT INTO categories(cat_title)";
        $query .= "VALUES('{$cat_title}')"; 
        $result = mysqli_query($connection, $query);
                                
        //Show error if query failed
        if(!$result){
            echo('Query failed. ERROR: ' . mysqli_error($connection));
        }
    }
}

//Display edit and delete in categories table
function display_edit_delete(){
    
  //Make variable $connection available everywhere
  global $connection;
  
  //Get categories from category table in database
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection, $query);
                                    
  //Convert result to array
  while($row = mysqli_fetch_assoc($result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
                    
    //Display categories in table data
    echo "<tr>
           <td>{$cat_id}</td>
           <td>{$cat_title}
             <small>
               <a href='categories.php?delete_cat_id={$cat_id}' class='pull-right text-danger'>Delete</a>
               <a style='padding-right: 20px' href='categories.php?edit_cat_id={$cat_id}' class='pull-right text-sucess'>Edit</a>
             </small>
          </td>
          </tr>";
  }

}

//Delete category
function delete_category() {
    
  //Make variable $connection available everywhere
  global $connection;
    
  //Delete category
  if (isset($_GET['delete_cat_id'])){
      $delete_cat_id = $_GET['delete_cat_id'];                                        
      $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
      $result = mysqli_query($connection, $query);
      //Refresh page
      header('Location: categories.php');
  }
                                    
}

//Delete post
function delete_post() {
    
  //Make variable $connection available everywhere
  global $connection;
    
  //See "view-all-posts.php" for delete link
  //Delete from database
  if(isset($_GET['delete_post'])){
    $delete_post_id = $_GET['delete_post'];                                        
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $result = mysqli_query($connection, $query);
    //Refresh page
    header('Location: posts.php');
  }                                    
}

//Comment Count
function comment_count() {
    
  //Make variable $connection available everywhere
  global $connection;
  
  $query = "SELECT * FROM posts";
  //Send to database
  $result = mysqli_query($connection, $query);
  //echo "<h1>Doing it!</h1>";
  $numOfRows = 0;
  while($row = mysqli_fetch_assoc($result)){
    $numOfRows++;
  }
    //Number of posts that have comments
    //echo "<h1>{$numOfRows}</h1>";

  $count = 0;

  $query = "SELECT * FROM posts";
  $result = mysqli_query($connection, $query);
  while($row = mysqli_fetch_assoc($result)){
    
    $thisPostId = $row['post_id'];
    $newQuery = "SELECT COUNT(*) FROM comments WHERE comment_post_id = {$thisPostId}";
    $newResult = mysqli_query($connection, $newQuery);
    while($newRow = mysqli_fetch_assoc($newResult)){
        $numOfComments = $newRow['COUNT(*)'];
        //echo $numOfComments . "<br>";
        $anotherQuery = "UPDATE posts SET post_comment_count = {$numOfComments} WHERE post_id = {$thisPostId}";
        $anotherResult = mysqli_query($connection, $anotherQuery);        
    }    
  }
}


?>