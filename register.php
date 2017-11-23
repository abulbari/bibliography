<!--/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/-->

<?php

//include Connection
include './Connect.php';

//variable to check if id exist then choose another
$exist = false;
//insert the user data into table
try 
{
    if (isset($_POST['email']) && isset($_POST['passwd'])) 
    {
    //fetch data from the registeration form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $sex = $_POST['sex'];
        
        $dbh = new PDO("mysql:dbname=test;host=localhost;", "root", "12345");
        $statement = $dbh->prepare("SELECT Email, FROM User where email=?");
        $statement->execute(array($email));
        $result = $statement->fetchAll();
        //id id exist then ask the user to choose another id
        if ($result) 
        {
            $exist = true;
            echo "<script>alert('This Email ID Exists. Please Choose another Email Id');</script>";
            header("Location:Register.html");
        }
        //otherwise add the detail of the user into the table
        else 
        {
            $sql = "INSERT INTO User (Email,Password,FirstName,LastName,DOB,Sex) "
                    . "VALUES ('$email','$pwd','$fname','$lname','$dob','$sex')";

            //check if data gets inserted or not
            if (!mysqli_query($con, $sql)) 
            {
                die('Error: ' . mysqli_error($con));
            } 
            else 
            {
                echo "New user's record added in the User Table/n";
            }


            //insert trash and unfiled into library table for this user
            $sql = "INSERT INTO Library(Email,LibName) VALUES('$email','Trash_$fname')";
            if (!mysqli_query($con, $sql)) 
            {
                die('Error: ' . mysqli_error($con));
            }
            else 
            {
                echo "Trash Library added in Library Table";
            }

            $sql1 = "INSERT INTO Library(Email,LibName) VALUES('$email','Unfiled_$fname')";
            if (!mysqli_query($con, $sql1)) 
            {
                die('Error: ' . mysqli_error($con));
            } 
            else 
            {
                echo "Trash Library added in Library Table";
            }
            //if the user gets registered then redirect him to login page to login
            header("Location:validate_Login.php");
        }
    }
} 
catch (Exception $ex) 
{
    
}
?>


