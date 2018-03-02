        <!-- Header -->
        <?php include "includes/admin_header.php" ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>
        
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Categories
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-6">
                                                 
                          <?php
                            //Add categories in categories table
                            add_categories_table();                            
                          ?>                   
                                            
                            <div>
                              <form action="" method="POST">
                               <div class="form-group">
                                 <label for="cat_title">Add Category</label>
                                 <!-- Make sure categories form is not empty -->                             
                                 <input type="text" class="form-control" name="cat_title" required>                             
                               </div>                              
                               <div class="form-group">                             
                                 <input type="submit" class="btn btn-primary" name="submit" value="Add Category">                             
                               </div>                               
                              </form>                              
                            </div>                     
                                                                                                                                                                  
                            <div>
                            
                            <!-- Update Categories Form --> 
                            <?php
                            
                              //Include Update Categories Form when "Edit" link clicked 
                            
                              if(isset($_GET['edit_cat_id'])){
                                  
                                include "includes/update_categories.php";
                                  
                              }
                            
                            ?>                             
                              
                             </div>                                                       
                        </div>
                        <!-- /.col-xs-6 -->
                        <div class="col-xs-6">              
                            
                            <!-- Display HTML table of categories -->                            
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 
                                  <?php
                                    //Display edit and delete in categories table
                                    display_edit_delete();
                                    
                                    ?>
                                    
                                    <?php
                                    
                                    //Delete category
                                    delete_category();
                                    
                                  ?>                                       
                                                               
                                </tbody>                                
                            </table>
                        </div>
                        
                        <div class="from-group">
                          <a href="index.php" class="btn btn-warning">Back</a>
                        </div>
                                               
                    </div>
                </div>
                <!-- /.row -->                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Footer -->
    <?php include "includes/admin_footer.php" ?>