

<!--//this file will be included in all the file for the connection part-->
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//This is used to establish connection with mysql.
$con = mysqli_connect("localhost", "root", "12345", "test");

// Check connection
if (mysqli_connect_errno()) 
{
    echo "Failed to connect to MySQL: \n" . mysqli_connect_error();
}
?>