<?php @include "header.php"; ?>
<?php @include "form.php"; ?>

<div class="user-box">
    <div class="user">
        <form method='POST' action='' class="user_register flex" id="signup">
            <p class="user_title">Sign Up</p>
            <input type="text" name="username" placeholder="Username" class="user_input"/>
            <input type="text" name="email" placeholder="Email" class="user_input"/>
            <input type="password" name="pwd" placeholder="Password" class="user_input"/>
            <input type="submit" name="submit_signup" class="user_submit" value="Create">
            <div class="error"><?php echo $fname_error .$email_error .$passwd_error; ?></div>
            <p class="message">Already registered? <a href="login.php">Sign In</a></p>
        </form>
    </div>
</div>