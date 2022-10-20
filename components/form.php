<?php @include "connection.php"; ?>
<?php
    if(isset($_GET['submit_login'])) {
        $fname = $_REQUEST['username'];
        $passwd = $_REQUEST['pwd'];

        echo "The username is: " . $fname ." . The password is: " .$passwd ." ";

        /*$sql = "SELECT * FROM user WHERE username=? AND password=?";
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $fname, $passwd);
            
            // Set parameters
            $fname = $_REQUEST['username'];
            $passwd = $_REQUEST['pwd'];
            //$email = $_REQUEST['email'];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt))){
                echo "Logged in succesfully";
            } else{
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($con);
            }
        } else{
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($con);
        }*/
    } else if(isset($_POST['submit_signup'])) {
        $fname = $_POST['username'];
        $email = $_POST['email'];
        $passwd = $_POST['pwd'];

        echo "The username is: " . $fname ." The email is: ". $email .". The password is: " .$passwd;
        /*$sql = "INSERT INTO user (username, email, pwd) VALUES (?, ?, ?)";
        $check = "SELECT * FROM user WHERE username=? OR email=?";

        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $fname, $passwd);
            
            // Set parameters
            $fname = $_REQUEST['username'];
            $passwd = $_REQUEST['pwd'];
            $email = $_REQUEST['email'];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "Records retrived/inserted successfully.";
            } else{
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($con);
            }
        } else{
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($con);
        }*/
    }
 
    // Close statement
    //mysqli_stmt_close($stmt);
     
    // Close connection
    mysqli_close($con);
    ?>