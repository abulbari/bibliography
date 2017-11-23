<!--

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */-->

<?php
session_start();
include './Connect.php';
if (isset($_SESSION['login_username'])) 
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
        $f = ucfirst($FirstName);
        $l = ucfirst($LastName);
    }
    
    //fetch the library you want to make active
    $libraryname = $_POST['ChangeActiveLibrary'];
    //fetch new name if you want to rename the library
    $new = $_POST['newname'];
    
    
    //if you selectec to change active library
    if ($_POST['action'] == 'Change Active Library') 
    {
        echo "<script>alert('The Active Library has changed. Now The Active Library is $libraryname');</script>";
    } 
    
    //if you selected to delete the library
    else
    if ($_POST['action'] == 'Delete Active Library') 
    {
        if (strcasecmp($libraryname, "Trash_$FirstName") == 0 || strcasecmp($libraryname, "unfiled_$FirstName") == 0 || strcasecmp($libraryname, "All") == 0) 
        {
            echo "<script>alert('You Are Not Allowed To Delete This Library Click OK to Empty Your $libraryname');</script>";
            mysqli_query($con, "DELETE FROM ReferenceLibrary WHERE LibName='$libraryname'");
        } 
        else 
        {
            mysqli_query($con, "DELETE FROM Library WHERE LibName='$libraryname'");
            mysqli_query($con, "UPDATE ReferenceLibrary SET LibName='Trash_$FirstName' WHERE LibName='$libraryname'");
            echo "<script>alert('The Active Library has Deleted');</script>";
            header("Location:MainPage.php");
            die();
        }
    } 
    
    //check if you want to rename the library
    else
    if ($_POST['action'] == 'Rename Active Library') {
        if (strcasecmp($libraryname, "Trash_$FirstName") == 0 || strcasecmp($libraryname, "unfiled_$FirstName") == 0 || strcasecmp($libraryname, "All") == 0) 
        {
             echo "<script>alert('You Are Not Allowed To Rename This Library');</script>";
        } 
        else 
        {
            
            mysqli_query($con, "UPDATE Library SET LibName='$new' WHERE LibName='$libraryname'");
            mysqli_query($con, "UPDATE ReferenceLibrary SET LibName='$new' WHERE LibName='$libraryname'");
            echo "<script>alert('The Active Library has Renamed');</script>";
            header("Location:MainPage.php");
            die();
        }
    }
} 

//if user is not online
else
{
   echo "<script>alert('You are Not Logged In. Please Login First');</script>\n";
    die();
}
?>



<!DOCTYPE html>
        <html>
            <head>
                <title>Bibliography page</title>
            </head>
            <body>
                <link rel="css/stylesheet" type="text/css" href="mainstylesheet.css"/>

                <div id = "header">
                    <div id = "account"><a href = "myAccount.php" > My Account</a> &nbsp;
                        |&nbsp;
                        <a href = "logout.php">Logout</a></div>
                    <h1>
                        Welcome <?= $f ?> <?= $l ?> To BibMan Library Management
                    </h1>
                </div>
                <br/>
                <div id="main">
                    <div id="leftForm">
                        <fieldset>
                            <legend><b>Change Library</b></legend>
                            <form name="changeLib" method="POST" action="changeLib.php">
                                <select name="ChangeActiveLibrary">
                                    <option selected="yes"><?= $libraryname ?></option>
                                    <?php
                                    $query1 = "SELECT LibName FROM Library where Email='$user'";
                                    $result = mysqli_query($con, $query1);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $row = $row['LibName'];
                                        if ($row == $libraryname) 
                                        {
                                            $row = "All";
                                        }
                                        if (strcasecmp($libraryname, 'All') == 0) 
                                        {
                                            header("Location:MainPage.php");
                                           
                                        }
                                        echo'<OPTION VALUE=' . "$row" . '>' . $row . '</OPTION>';
                                    }
                                    ?>

                                </select>
                                <br/><br/>
                                New Library Name:
                                <input type="text" name="newname">
                                <br/><br/>
                                
                                <input type="submit" name="action" value="Change Active Library"></input>
                                <input type="submit" name="action" value="Delete Active Library"></input>
                                <input type="submit" name="action" value="Rename Active Library"></input>
                            </form>
                        </fieldset>

                        <fieldset>
                            <legend><b>Create New Library</b></legend>
                            <form method="POST" action="createLib.php">
                                <input name="addLib" type="text" >
                                <br/>
                                <input type="submit" value="Create"></input>
                            </form>
                        </fieldset>

                        <fieldset>
                    <legend><b>Library Sharing</b></legend>
                    <form name="libshare" action="libshare.php" mathod="post">
                        Email Id:
                        <input name="email" type="text"></textarea>
                        Library Name:
                        <input name="lib" type="text">
                        <input type="submit" Value="Share Lib">
                    </form>
                </fieldset>

                <fieldset>
                    <legend><b>Share With</b></legend>
                    <form>
                        Its Disabled.
                        <input disabled="" name="" type="text">

                    </form>
                </fieldset>


                        <fieldset>
                            <legend><b>Search Libraries</b></legend>
                            <form method="POST" action="searchLib.php">
                                Author Name: <input type="text" name="Author"><br>
                                Title: <input type="text" name="Title"><br>
                                
                                Libraries to Search:
                                
                                <select name="SearchLibrary">
                                    <option selected="yes">All My references</option>
                                    <?php
                                    $query1 = "SELECT LibName FROM Library where Email='$user'";
                                    $result = mysqli_query($con, $query1);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $row = $row['LibName'];
                                        echo'<OPTION VALUE=' . "$row" . '>' . $row . '</OPTION>';
                                    }
                                    ?>  
                                </select>
                                <br/><br/>
                                <input type="submit" value="Search Libraries">
                            </form>
                        </fieldset>
                    </div>  
                    <div id="rightForm">
                        <div id="Table">
                            <div id="move">
<!--                                <input type="submit" value="Move Selected"></input>-->
                                 Your Respective Table is Shown Below :-
                            </div>
                            <?php
                            $query1 = "SELECT * FROM ReferenceLibrary where LibName='$libraryname' and Email='$user'";
                        echo " <table border='1' bordercolor='#c86260' bgcolor='#ffffcc' width='150%' cellspacing='2' cellpadding='5'>
                               <tr>
                            <th>All</th>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title of Article</th>
                            <th>Year</th>
                            <th>Library</th>
                            <th>Abstract</th>
                            <th>Shared To</th>
                            <th>Shared From</th>
                            <th>PDF</th>
                            <th>URL</th>
                                </tr>";
                            $result = mysqli_query($con, $query1);
                           $num_rows = mysqli_num_rows($result);
                    if($num_rows<1)
                    {
                                echo "<tr>No Result Found for this Library for this user.</tr>";
                    } 
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td><input type='checkbox' name='username'/></td>";
                                echo "<td>" . $row['Id'] . "</td>";
                                echo "<td>" . $row['Author'] . "</td>";
                                echo "<td>" . $row['Title'] . "</td>";
                                echo "<td>" . $row['Year'] . "</td>";
                                echo "<td>" . $row['LibName'] . "</td>";
                                echo "<td>" . $row['Abstract'] . "</td>";
                                echo "<td>" . $row['SharedTo'] . "</td>";
                                echo "<td>" . $row['SharedFrom'] . "</td>";
                                echo "<td>" . "yes" . "</td>";
                                echo "<td>" . "No" . "</td>";
                                echo "</tr>";
                            }
                            ?> 
                            </table>
                        </div>
                <div id="sort" >
                    <form name="sort" action="sort.php" method="post">
                    Sort By (Sorting Is Based On Title And For All References By Default):
                    <select name="SortBy">
                        <option selected="yes">Asc</option>
                        <option>Desc</option>
                    </select>
                    <input type="submit" value="Display"></input>
                    </form>
                </div>


                        <div id="detail">

                            <form name="addDetails" method="POST" action="addToLib.php">
                                <div id="button">
                                    <input type="submit" name="action" value="AddNew"></input>
                                    <input type="submit" name="action" value="Update"></input>
                                    <input type="reset" name="action" value="Clear"></input>
                                </div>
                                <div class="scrollcell">
                                    <table border="1" bordercolor="#c86260" bgcolor="#ffffcc" width="100%" cellspacing="3" cellpadding="2" scrollbars="yes">
                                        
                                        <tr>
                                            <td>Id (will be used for update only)</td> 
                                            <td><textarea name="id" rows="1" cols="100"></textarea></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Title</td> 
                                            <td><textarea name="title" rows="1" cols="100"></textarea></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Author</td> 
                                            <td><textarea name="author" rows="1" cols="100"></textarea></td>

                                        </tr>
                                        <tr>
                                            <td>Year</td> 
                                            <td><textarea name="year" rows="1" cols="100"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td height="100">Abstract</td> 
                                            <td><textarea name="abstract" rows="5" cols="100"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>Library</td> 
                                            <td><textarea name="library" rows="1" cols="100"></textarea></td>

                                        </tr>
                                        <tr>
                                            <td>Address</td> 
                                            <td><textarea disabled="" rows="1" cols="100"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
            </body>
        </html>