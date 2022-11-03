<?php @include 'shared.php' ?>

<div class=user-box>
	<div class=user>
		<form method=POST class='user_register flex' id=signin>
			<p class=user_title>Sign in</p>
			<input type=text id=Username class=user_input>
			<input type=password id=Password class=user_input>
			<input type=submit id=submit_login class=user_submit value='Sign in'>
			<div class=error id=Error><?php echo $login_error ?></div>
			<p class=message>Not registered? <a href=register.php>Create an account</a></p>
		</form>
	</div>
</div>