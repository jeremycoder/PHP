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
                        
                        <!-- Posts Table -->
                        <?php
                          
                          if(isset($_GET['source'])){
                              $source = $_GET['source'];
                          } else {
                              $source = '';
                          }

                          switch ($source) {
                            
                              case "add_posts":
                                include "includes/add_post.php";
                                break;
                             
                              case "edit_posts":
                                include "includes/edit_post.php";
                                break;
                                  
                              default:
                                include "includes/view_all_comments.php";
                                break;
                          } 
                        ?>
                        
                        <!-- Delete Posts -->
                         <?php
                          //Delete a post
                          delete_post();
                        
                         ?>
                                               
                    </div>
                </div>
                <!-- /.row -->                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Footer -->
    <?php include "includes/admin_footer.php" ?>