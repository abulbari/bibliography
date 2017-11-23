

<!--Login page for allowing user to login-->
<?php

//start the sesion of a user
session_start();
//include the connection part
include './Connect.php';
//varaible used if the id password didnot matched
$notmatch = false;

//fetch data from form and data base to authenticate the user to login
try 
{
    
    if(isset($_POST['email']) && isset($_POST['passwd']))
    {
        //fetching email and password from the form
        $email = $_POST['email'];
        $pass = $_POST['passwd'];
        
        //comparing the email and password from the data base to authenticate
        $dbh = new PDO("mysql:dbname=test;host=localhost;", "root", "12345");
        $statement = $dbh->prepare("SELECT Email, Password FROM User where email=? and password=?");
        $statement->execute(array($email, $pass));
        $result = $statement->fetchAll();
        
        //if there exist the record in DB then allow them to go to main page
        if ($result) 
        {
            echo "<script>alert('You Have Logged In Successfully');</script>\n";
            $_SESSION['login_username'] = $email;
            header("Location:MainPage.php");
        }
        //if not then show a error message and ask them to login again
        else 
        {
            $notmatch = true;
            echo "<script>alert('Email Id and Password didnot matched. Please Try again');</script>\n";
        }
    }
} 
catch (PDOException $error) 
{
    print_r($error);
    die();
}
?>

<!--//Login Form to enable user to login-->
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>

        <!--including all the stylesheet-->
        <link rel="stylesheet" type="text/css" href="base.css" />
        <link rel="stylesheet" type="text/css" href="form.css" />
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body >

        <div id="container">
            <form name="login" action="validate_Login.php" method="post">
                <div>
                    <h1><img src="image/login_banner(1).jpg" alt="" width="500" height="250"><br/>BibMan</h1>
                </div>
                    <p>Cloud Powered Bibliography Management<p>
                        <?php
                        if($notmatch){?>
                            <p>Your Id and Password Did Not Matched. Please Try Again<p>
                        <?php }
                    ?>
                <div>
                    <input type="text" name="email" placeholder="Email Id">
                </div>
                <div>
                    <input type="password" name="passwd" placeholder="Password">
                </div>
                    
                <div>
                    <input type="submit" Value= "Log In" onclick="return check();">
                </div>
                <div id="register">
                    <a href="Register.html" > Not yet Registered</a>
                </div>
            </form>
        </div>
        <script language="javascript">
            function check()/*function to check userid & password*/
            {
                var error_msg = "";
                var f = document.forms["login"];
                var emailregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


                if (f.email.value.length === 0)
                {
                    error_msg += "Please Enter Email\n";
                }
                if (emailregex.test(f.email.value) === false)
                {
                    error_msg += "Incorrect email was entered\n";
                }
                if (f.passwd.value.length === 0)
                {
                    error_msg += "Please Enter Password\n";
                }
                if (error_msg.length !== 0)
                {
                    alert(error_msg);
                    return false;
                }
                else
                {
                    return true;
                }
            }
        </script>
    </body>
</html>    