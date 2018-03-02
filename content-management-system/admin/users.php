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
                            
                              case "add_users":
                                include "includes/add_user.php";
                                break;
                             
                              case "edit_user":
                                include "includes/edit_user.php";
                                break;
                                  
                              default:
                                include "includes/view_all_users.php";
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