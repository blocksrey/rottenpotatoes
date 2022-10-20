<?php @include "header.php"; ?>

<div class="user-box">
    <div class="user">
        <form method='POST' action='form.php' class="user_register flex hide" id="signup">
            <p class="user_title">Sign Up</p>
            <input type="text" name="username" placeholder="Username" class="user_input"/>
            <input type="text" name="email" placeholder="Email" class="user_input"/>
            <input type="password" name="pwd" placeholder="Password" class="user_input"/>
            <input type="submit" name="submit_signup" class="user_submit" value="Create">
            <p class="message">Already registered? <a href="#" onclick="toggleDisplay()">Sign In</a></p>
        </form>
        <form method='GET' action='form.php' class="user_register flex" id="signin">
            <p class="user_title">Sign in</p>
            <input type="text" name="username" placeholder="Username" class="user_input"/>
            <input type="password" name="pwd" placeholder="Password" class="user_input"/>
            <input type="submit" name="submit_login" class="user_submit" value="Sign in">
            <p class="message">Not registered? <a href="#" onclick="toggleDisplay()">Create an account</a></p>
        </form>
    </div>
</div>
