<?php @include "header.php" ?>

<div class="wrapper">
    <p class="top-title">Explore</p>
    <div class="movie-box flex">
        <div class="movie-box_half flex">
            <p class="small-label">Most Watched Movie This Week</p>
            <div class="big-movie flex">
                <div class="big-movie_poster">
                    <a href="movie.php"><img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/99790a53131197.596c4c8d36869.jpg"></a>
                </div>
                <div class = "big-movie_info flex" onclick="location.href='movie.php';">
                    <div class="title">Black Panther</div>
                    <div class="rating">Rating: ☆☆☆☆☆</div>
                </div>
            </div>
        </div>
        <div class="movie-box_half flex">
            <p class="small-label">Newest Movie</p>
            <div class="big-movie flex">
                <div class="big-movie_poster">
                    <?php 
                        $sql = "SELECT m.movie_id, title, poster, AVG(rating) FROM movie as m JOIN movie_rating as mra ON mra.movie_id = m.movie_id GROUP BY movie_id ORDER BY release_date DESC LIMIT 1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $movieName = $row["title"];
                                $moviePoster = $row["poster"];
                                $movieId = $row["movie_id"];
                                $movieRating = $row["AVG(rating)"];
                            }
                        }
                    ?>
                    <img src="<?php echo $moviePoster; ?>">
                </div>
                <div class="big-movie_info flex" onclick="location.href='movie.php?id=<?php echo $movieId; ?>'">
                    <div class="title"><?php echo $movieName; ?></div>
                    <div class="rating">Rating: 
                        <?php 
                            for ($x = 1; $x <= floor($movieRating); $x++) echo "★";
                            for ($y = 1; $y <= 5-floor($movieRating); $y++) echo "☆";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="list-box_half flex">
        <p class="label home-list-label">Discover New Movies</p>
        <div class="explore flex">
            <?php 
                /*if(empty($_SESSION['username'])) {
                    $sql = "SELECT category, COUNT(w.movie_id)
                    FROM watchedlist as w 
                    JOIN movie_category as mc 
                    ON w.movie_id = mc.movie_id 
                    JOIN categories as c 
                    ON c.category_id = mc.category_id 
                    WHERE user_id = " .$_SESSION['username'] ."
                    GROUP BY category
                    ORDER BY COUNT(w.movie_id) 
                    DESC LIMIT 1;"
                } else {}*/
                for($i=1; $i <= 12; $i++) {
                    $randNum = rand(1,29);
                    $sql = "SELECT m.movie_id, title, poster, AVG(rating) FROM movie as m JOIN movie_rating as mr ON mr.movie_id = m.movie_id WHERE m.movie_id = " .$randNum ." GROUP BY m.movie_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
            ?>
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php?id=<?=$row["movie_id"];?>"><img class="mov" src="<?php echo $row['poster']; ?>"></a>
                </div>
                <div class="movie_info flex">
                    <div class="movie_info_text">
                        <div class="title"><?php echo $row['title']; ?></div>
                        <div class="rating">Rating: 
                            <?php 
                                for ($x = 1; $x <= floor($row["AVG(rating)"]); $x++) echo "★";
                                for ($y = 1; $y <= 5-floor($row["AVG(rating)"]); $y++) echo "☆";
                            ?>
                        </div>
                    </div>
                    <div class="movie_info_potato">
                        <a href=#><img class="like" src="../images/potato-add.png"></a>
                    </div>
                </div>
            </div>
            <?php } } } ?>
        </div>
    </div>
</div>

<div class="footer flex">
    <p class="footer_text">Copyright © Rotten Potatoes. Developed by Daniela, Yoon Soo, and Jeffrey.</p>
</div>
