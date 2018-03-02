<?php

//Create connection variables
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

//Convert variables to constants
foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

//Connection: server, user, password, database
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//Alert if connection fails
if(!$connection){
    echo "Connection failed!";
}
  

?>