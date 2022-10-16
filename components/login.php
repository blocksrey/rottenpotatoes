<?php @include "home.php"; ?>

<div class="user-box">
    <div class="user">
        <form class="user_register flex hide" id="signup">
            <p class="user_title">Sign Up</p>
            <input type="text" placeholder="Username"/>
            <input type="text" placeholder="Email"/>
            <input type="password" placeholder="Password"/>
            <button>Create</button>
            <p class="message">Already registered? <a href="#" onclick="toggleDisplay()">Sign In</a></p>
        </form>
        <form class="user_register flex" id="signin">
            <p class="user_title">Log in</p>
            <input type="text" placeholder="Username"/>
            <input type="password" placeholder="Password"/>
            <button>Sign in</button>
            <p class="message">Not registered? <a href="#" onclick="toggleDisplay()">Create an account</a></p>
        </form>
    </div>
</div>
