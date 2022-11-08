<?php 
    @include "header.php";
    $movieID = $_GET['id'];

    if(isset($_POST['review_submit'])) {
        $myReview = $_POST['myreview'];
        $myRating = $_POST['myrating'];

        $sql = "INSERT INTO movie_review VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iis', $movieID, $_SESSION['user_id'], $myReview);
        $stmt->execute();
        $stmt->close();

        $sql = "SELECT rating FROM movie_rating WHERE user_id=? AND movie_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['user_id'], $movieID);
        $stmt->execute();
        $reviewResult = $stmt->get_result();
        $stmt->close();

        if($reviewResult->num_rows == 0) {
            $sql = "INSERT INTO movie_rating VALUES(?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $movieID, $_SESSION['user_id'], $myRating);
            $stmt->execute();
            $stmt->close();
        } else {
            $sql = "UPDATE movie_rating SET rating=? WHERE user_id=? AND movie_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iii', $myRating, $_SESSION['user_id'], $movieID);
            $stmt->execute();
            $stmt->close();
        }
    } 

    if(isset($_POST['review_edit_submit'])) {
        $myReview = $_POST['myreview'];
        $myRating = $_POST['myrating'];

        $sql = "UPDATE movie_rating SET rating=? WHERE user_id=? AND movie_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $myRating, $_SESSION['user_id'], $movieID);
        $stmt->execute();
        $stmt->close();

        $sql = "UPDATE movie_review SET review=? WHERE user_id=? AND movie_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $myReview, $_SESSION['user_id'], $movieID);
        $stmt->execute();
        $stmt->close();
    }
?>

<div class="container flex">
    <?php
        $sql = "SELECT m.title, m.poster, m.description, AVG(rating) FROM movie_rating as mr JOIN movie as m ON m.movie_id = mr.movie_id WHERE mr.movie_id = $movieID;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
    ?>
    <div class="label" id="moviephp-title">" <?=$row["title"];?>"</div>
    <div class="moviephp-options flex">
        <div class="rating">Average Rating: 
            <?php 
                for ($x = 1; $x <= $row["AVG(rating)"]; $x++) echo "★";
                if($row["AVG(rating)"] < 5) {
                    for ($y = 1; $y <= 5-floor($row["AVG(rating)"]); $y++) echo "☆";
                } 
            ?>
        </div>
        <div class="add-movie flex">
            <input type="submit" name="addwatchlist" class="add-movie" value="+ My Watchlist"/>
        </div>
    </div>
    <div class="movie flex">
        <div class="movie_poster flex">
            <img src="<?=$row['poster'];?>"/>
        </div>
        <div class="movie_info flex">
            <div class="movie_info_desc"><?=$row["description"]?></div>
            <?php } } ?>
            <div class="movie_info_actors">
                <span class="cast">Cast:</span> 
                <?php
                    $sql = "SELECT actor_name, role FROM actors as a JOIN movie_actors as ma ON a.actor_id = ma.actor_id WHERE movie_id = $movieID;";
                    $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                ?>
                <?=$row['actor_name']?> as <?=$row['role']?>, 
                <?php } } ?>
            </div>
        </div>
    </div>
    <div class="review">
        <div class="review_title">Reviews</div>
        <div class="review_mine">
            <?php if(empty($_SESSION['user_id'])) { ?>
                <div class="menu review-not-loggedin flex">
                    <div class="message">Sign in or set up an account to write a review</div>
                    <a href="login.php" class="menu_button flex menu_login">Sign in</a>
                </div>
            <?php } else { 
                $sql = "SELECT rating, review FROM movie_review as mr JOIN movie_rating as mra ON mra.movie_id = mr.movie_id AND mra.user_id = mr.user_id WHERE mr.user_id=? AND mr.movie_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ii', $_SESSION['user_id'], $movieID);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if(isset($_POST['edit_review'])) { 
            ?>
                <div class="username">@<?=$_SESSION['username'];?></div>
                <form method="POST">
                    <div class="input-box">
                        <textarea name="myreview" class="review-box"><?=$row['review'];?></textarea>
                    </div>
                    <div class="options flex">
                        <div class="options_rate">
                            <label for="myrating" class="options_rate_label">My Rating:</label>
                                <select name="myrating" id="myrating" class="options_rate_box">
                                    <?php for($x=1; $x<=5; $x++) {
                                        if($x == $row['rating']) { ?>
                                            <option value="<?=$row['rating'];?>" selected><?=$row['rating'];?> stars</option>
                                    <?php } else { ?>
                                            <option value="<?=$x;?>"><?=$x;?> stars</option>
                                    <?php } } ?> 
                                </select> 
                        </div>
                        <div class="options_submit">
                            <input type="submit" name="review_edit_submit" value="Submit"/>
                        </div>
                    </div>
                </form> 
                        <?php } else { ?>
                        <form method="POST">
                            <div class="top-info flex">
                                <div class="username">@<?=$_SESSION['username'];?></div>
                                <div class="username"><?=$row['rating']?>/5 stars</div>
                            </div>
                            <div class="my-review"><?=$row['review']?></div>
                            <input type="submit" name="edit_review" class="edit" value="Edit"/>
                        </form>
            <?php } } } else { ?>
                <div class="username">@<?=$_SESSION['username'];?></div>
                <form method="POST">
                    <div class="input-box">
                        <textarea name="myreview" class="review-box" placeholder="What did you think about the movie? ..."></textarea>
                    </div>
                    <div class="options flex">
                        <div class="options_rate">
                            <label for="myrating" class="options_rate_label">My Rating:</label>
                            <?php 
                                $sql = "SELECT rating FROM movie_rating WHERE user_id=? AND movie_id=?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('ii', $_SESSION['user_id'], $movieID);
                                $stmt->execute();
                                $reviewResult = $stmt->get_result();
                                $stmt->close();

                                if($reviewResult->num_rows == 0) {
                            ?>
                                    <select name="myrating" id="myrating" class="options_rate_box">
                                        <option value="1" selected>1 stars</option>
                                        <option value="2">2 stars</option>
                                        <option value="3">3 stars</option>
                                        <option value="4">4 stars</option>
                                        <option value="5">5 stars</option>
                                    </select>
                            <?php } else { ?>
                                <select name="myrating" id="myrating" class="options_rate_box">
                                <?php while($row = $reviewResult->fetch_assoc()) {
                                    for($x=1; $x<=5; $x++) {
                                        if($x == $row['rating']) { ?>
                                            <option value="<?=$row['rating'];?>" selected><?=$row['rating'];?> stars</option>
                                    <?php } else { ?>
                                            <option value="<?=$x;?>"><?=$x;?> stars</option>
                                    <?php } } } ?> 
                                </select> 
                            <?php } ?>
                        </div>
                        <div class="options_submit">
                            <input type="submit" name="review_submit" value="Submit"/>
                        </div>
                    </div>
                </form>
            <?php } } ?>
        </div>
        <div class="review_all flex">
            <?php
                $sql = "SELECT u.username, mr.review, mra.rating FROM movie_review as mr JOIN users as u ON mr.user_id = u.user_id JOIN movie_rating as mra ON mr.user_id = mra.user_id AND mr.movie_id = mra.movie_id WHERE mr.movie_id = $movieID;";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            if($row['username'] == $_SESSION['username']) {
                                continue;
                            } else {
            ?>             
            <div class="review_all_box">
                <div class="title flex">
                    <div class="title_username">@<?=$row['username']?></div>
                    <div class="title_rating"><?=$row['rating']?>/5 stars</div>
                </div>
                <div class="text"><?=$row['review']?></div>
            </div>
            <?php } } } ?>
        </div>
    </div>
</div>
