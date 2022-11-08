<?php session_start();
    require_once "connection.php"; 
	header('Content-Type: text/html; charset=utf-8') ?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link rel="preconnect" href="https://fonts.googleapis.com"> 
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;600;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../scss/style.css">
	<link rel="icon" href="favicon.ico">

	<title>Rotten Potatoes</title>
</head>
<body>
	<div class="nav-bar">
		<div class="logo flex">
			<a href="home.php"><img src="../images/light-logo-1.png" class="logo_img"></a>
		</div>
		<form method="POST" action="results.php" class="search flex">
			<input type="text" name="search" placeholder="Search" id="Search" class="search_bar"/>
			<input type="submit" name="submit_search" hidden/>
		</form>
		<div class="menu flex">
			<a href="watchlist.php" class="menu_button flex menu_btn">Watchlist</a>
			<a href="ranking.php" class="menu_button flex menu_btn">Ranking</a>
			<a href="categories.php?id=1" class="menu_button flex menu_btn">Categories</a>
			<?php if(empty($_SESSION['user_id'])) { ?>
                <a href="login.php" class="menu_button flex menu_login">Sign in</a>
            <?php } else { ?>
                <a href="logout.php" class="menu_button flex menu_logout">Sign Out</a>
            <?php } ?>
		</div>
	</div>
	<script src="../js/script.js"></script>
</body>
</html>

