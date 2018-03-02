        <!-- Admin Header -->
        <?php include "includes/admin_header.php" ?>

        <!-- Admin Navigation -->
        <?php include "includes/admin_navigation.php" ?>
        
        <!-- Page Wrapper -->
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           <?php echo $_SESSION['firstname'] ?>, Welcome to Admin!
                        </h1>                        
                    </div>
                </div>
                <!-- /.row -->                                    
                
                <?php 
                //Get number of posts
                $query = "SELECT * FROM posts";
                $result = mysqli_query($connection, $query);
                $posts_count = mysqli_num_rows($result);
                //Get number of posts
                $query = "SELECT * FROM comments";
                $result = mysqli_query($connection, $query);
                $comments_count = mysqli_num_rows($result);
                //Get number of posts
                $query = "SELECT * FROM users";
                $result = mysqli_query($connection, $query);
                $users_count = mysqli_num_rows($result);
                //Get number of posts
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                $categories_count = mysqli_num_rows($result);                
                ?>
                                
                <div class="row">
                  
                  <?php
                  //Colors for ten tables
                  $colors = ['primary', 'green', 'yellow', 'red','info'];
                  //This script shows the tables and their respective number of rows
                  $show_tables_query = "SHOW TABLES";
                  $result = mysqli_query($connection, $show_tables_query);
                  $color_count = 5;
                  while($tables = mysqli_fetch_array($result)){
                      $table_name = $tables[0];
                      //Repeat colors in $colors array
                      $color_count = $color_count%5;
                      $color = $colors[$color_count];
                      $get_rows_query = "SELECT * FROM {$table_name}";
                      $get_rows_result = mysqli_query($connection, $get_rows_query);
                      $table_count = mysqli_num_rows($get_rows_result);
                      $color_count++;
                      
                      
                 ?>        
                  
                   <div class="col-lg-3 col-md-6">
                        <div class="panel panel-<?php echo $color ?>">
                            <div id="<?php echo $table_name ?>" class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                  <div class='huge table-count'><?php echo $table_count ?></div>
                                        <div class="table-name"><?php echo ucfirst($table_name) ?></div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo $table_name ?>.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                </div>
                <!-- /.row --> 
                
                <div class="row">                  
                <!--Load the AJAX API-->
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">

                  // Load the Visualization API and the corechart package.
                  google.charts.load('current', {'packages':['corechart']});

                  // Set a callback to run when the Google Visualization API is loaded.
                  google.charts.setOnLoadCallback(drawChart);

                  // Callback that creates and populates a data table,
                  // instantiates the pie chart, passes in the data and
                  // draws it.
                    
                
                      
                      //['Table_Name','Table_count','Color']
//                      var numOfTables, tableName, tableCount, color, colorTable, oneArray, num;
//                      var myArr = [['Section', 'Count', { role: 'style' }]];
//                      colorTable = ['#337ab7', '#5cb85c','#f0ad4e','#d9534f', '#5bc0de'];                      
//                      //Get number of tables by given class name
//                      numOfTables = document.querySelectorAll('.table-name').length;
//                      //Get table names
//                      for (var i = 0; i < numOfTables; i++){
//                        tableName = document.getElementsByClassName('table-name')[i].innerText;
//                        tableCount = document.getElementsByClassName('table-count')[i].innerText;
//                        //Repeat colors in $colors array
//                        num = i%5;
//                        oneArray = [tableName, tableCount, colorTable[num]];
//                        myArr.push(oneArray);                        
//                      }
                      
                                  
                  
                
                    
                  function drawChart() {
                    // Create the data table.
                    var data = google.visualization.arrayToDataTable([              
                      ['Section', 'Count', { role: 'style' }],
                    
//                    Script loops through tables and suuplies data for chart
                    <?php
                  //Colors for tables
                  $colors = ['#337ab7', '#5cb85c','#f0ad4e','#d9534f', '#d9edf7'];
                  //This script shows the tables and their respective number of rows
                  $show_tables_query = "SHOW TABLES";
                  $result = mysqli_query($connection, $show_tables_query);
                  $color_count = 0;
                  while($tables = mysqli_fetch_array($result)){
                      $table_name = $tables[0];
                      //Repeat colors in $colors array
                      $color_count = $color_count%5;
                      $color = $colors[$color_count];
                      $get_rows_query = "SELECT * FROM {$table_name}";
                      $get_rows_result = mysqli_query($connection, $get_rows_query);
                      $table_count = mysqli_num_rows($get_rows_result);
                      $color_count++;
                      $table_name = ucfirst($table_name);
                      echo "['{$table_name}', {$table_count}, '{$color}'],";
                  }
                    
                 ?>              
                      
                    ]);                     

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                    chart.draw(data);
                  }
                </script>
                   
                <!--Div that will hold the pie chart-->
                <div id="chart_div"></div>
                    
                    
                    
                </div>
                              
                
                
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- Admin Footer -->
    <?php include "includes/admin_footer.php" ?>
