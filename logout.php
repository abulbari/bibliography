


<!--/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->


<?php

//start the session
session_start();

//include the connection
include './Connect.php';

//making it allowable to log out and checking its not in the set
if (!isset($_SESSION['login_username'])) 
{

    $user = $_SESSION['login_username'];
    $query = "SELECT * FROM User where email = '$user'"; //You don't need a ; like you do in SQL
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) 
    {
        //Creates a loop to loop through results
        //$row['index'] the index here is a field name
        $Email = $row['Email'];
        $Password = $row['Password'];
        $FirstName = $row['FirstName'];
        $LastName = $row['LastName'];
        $Dob = $row['DOB'];
        $Sex = $row['Sex'];
    }
}

//user has logged out so destroy the session and redirecting it to login page
else 
{
    echo  $user.'has logged out';
    echo 'please Login first to Logout.';
    session_destroy();
    $_SESSION['login_username'] = "";
    if(session_destroy());
    {
        header("Location:validate_Login.php");
    }
}
?>