<?php session_start();
    require_once "connection.php"; 

    if(isset($_POST['submit_login'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['username']);	
        $passwd = mysqli_real_escape_string($conn, hash('sha512', $_POST['pwd']));	

        $sql = "SELECT username,password FROM users WHERE username=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $fname, $passwd);
        $stmt->execute();
        $stmt->bind_result($username, $password);
        $result = $stmt->fetch();
        $stmt->close();

        if(!$result) { 
            $login_error = "Please enter the correct username or password";
        } else {
            $_SESSION['username'] = $username;
            $_SESSION['password']= $password;
            header("location: home.php");
        }
    } else if(isset($_POST['submit_signup'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['username']);	
        $email = mysqli_real_escape_string($conn, $_POST['email']);	
        $passwd = mysqli_real_escape_string($conn, hash('sha512', $_POST['pwd']));	

        $result1 = "SELECT COUNT(*) FROM users WHERE email=?";
        $stmt1 = $conn->prepare($result1);
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($count1);
        $stmt1->fetch();
        $stmt1->close();
        
        $result2 = "SELECT COUNT(*) FROM users WHERE username=?";
        $stmt2 = $conn->prepare($result2);
        $stmt2->bind_param('s', $fname);
        $stmt2->execute();
        $stmt2->bind_result($count2);
        $stmt2->fetch();
        $stmt2->close();

        if(preg_match("/[\'^£$%&*()}{!@#~?><>,|=+¬-]/", $fname)) {
            $fname_error = "Name must contain only alphabets, dot, underdash, and space.";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please enter a valid email.";
        } else if(strlen($_POST['pwd']) < 6) {
            $passwd_error = "Password must be minimum of 6 characters.";
        } else {      
            if($count1 > 0) {
                echo "'Email already associated with another account. Please try with different one.";
            } else if ($count2 > 0) {
                echo "'Username already associated with another account. Please try with different one.";
            } else { 
                $sql = "INSERT INTO users(username, email, password) VALUES(?,?,?)";
                $stmti = $conn->prepare($sql);
                $stmti->bind_param('sss', $fname, $email, $passwd);
                $stmti->execute();
                $stmti->close();
                header("location: welcome.php");
            }
        }
    }

    mysqli_close($conn);
?>