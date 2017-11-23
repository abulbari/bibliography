

<?php
//start the session
session_start();

//include the connection
include './Connect.php';

//id the user is logged in
if (isset($_SESSION['login_username']))
{
    //fetching the information of the user logged in
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
        $f = ucfirst($FirstName);
        $l = ucfirst($LastName);
    }
    
    //fetches the information from the form and if there is a changed then update it
    $fname1 = $_POST['fname'];
    $lname1 = $_POST['lname'];
    $dob1 = $_POST['dob'];
    $email1 = $_POST['email'];
    $pwd1 = $_POST['pwd'];
    $sex1 = $_POST['sex'];


    //update all the changed value or information of the user
    $query1 = "UPDATE User SET FirstName='$fname1' WHERE Email='$email1'";
    mysqli_query($con, $query1);

    $query2 = "UPDATE User SET LastName='$lname1' WHERE Email='$email1'";
    mysqli_query($con, $query2);

    $query3 = "UPDATE User SET Password='$pwd1' WHERE Email='$email1'";
    mysqli_query($con, $query3);

    $query4 = "UPDATE User SET DOB='$dob1' WHERE Email='$email1'";
    mysqli_query($con, $query4);

    $query5 = "UPDATE User SET Sex='$sex1' WHERE Email='$email1'";
    mysqli_query($con, $query5);

    echo "<script>alert('Your Details has been Updated');</script>\n";
} 
//if the person is no logged in
else
{
    echo "<script>alert('You are Not Logged In. Please Login First');</script>\n";
    die();
}
?>


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