

<!--/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->

<?php
//start the session
session_start();

//include the connection file
include './Connect.php';

//checking if the user is still online or not
if (isset($_SESSION['login_username'])) 
{

    $user = $_SESSION['login_username'];

    //fetching the data of the user
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
        $f = ucfirst($FirstName);
        $l = ucfirst($LastName);
    }
}

//if not logged in then ask them to login
else
{
     echo "<script>alert('You are Not Logged In. Please Login First');</script>\n";
    die();
}
?>

<!--Html page to display my account page-->
<html>
    <head>
        <title>My Detail</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="stylesheet" type="text/css" href="base.css" />
        <link rel="stylesheet" type="text/css" href="form.css" />
    </head>
    <body>
        <div id="container">
            <div id="detail">
                <?php
                //condition to apply MR. for male and MS. for female
                if(strcasecmp($Sex, "female") == 0)
                    $mrms='Ms.';
                else
                if(strcasecmp($Sex, "male") == 0)
                    $mrms='Mr.';
                    ?>
                <h1>Welcome <?= $mrms ?> <?= $f ?> <?= $l ?></h1>
            </div>
            <div id="content">
                <div id="signup">
                    <h2>View or Edit your Detail</h2>  
                    <form name="mydetails" action="editedData.php" method="post">

                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            Email Id: 
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;
                            <input type="text" name="email" value="<?= $Email ?>" readonly>
                        </div>
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            Password:
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                            <input type="password" name="pwd" value="<?= $Password ?>">
                        </div>
                        <div >
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            First Name: 
                            &nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="fname" value="<?= $FirstName ?>"> 
                        </div>
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            Last Name:
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;
                            <input type="text" name="lname" value="<?= $LastName ?>">
                        </div>
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            Date of Birth: 
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="dob" value="<?= $Dob ?>">
                        </div>
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            Sex: 
                            &nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="sex" value="<?= $Sex ?>" >
                        </div>
                        <div>
                            <p>Note: Click in box to Change. You Can't Change Your Email.</p>
                        </div>
                        <div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="submit" Value="Save">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="MainPage.php" > Go Back</a>
                        </div>
                        <div>

                        </div>
                    </form>
                </div>
                <p id="disclaimer">
                    Disclaimer! 
                </p>
            </div>
    </body>    
</html>