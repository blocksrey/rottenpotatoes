<?php @include "header.php"?>
<?php require_once "connection.php"?>

<div class="list-box_half flex top5-ranking">
    <p class="label">Top 5 Best Rated Movies</p>
    <div class="top5-rated flex">
        <?php
            $sql = "SELECT mr.movie_id, title, poster, AVG(rating) FROM movie_rating as mr JOIN movie as m ON mr.movie_id = m.movie_id GROUP BY mr.movie_id ORDER BY AVG(rating) DESC LIMIT 5";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <div class="movie">
                    <div class="movie_poster">
                        <a href="movie.php?id=<?=$row["movie_id"];?>" id="<?php echo $row["movie_id"];?>" onclick="movieInfo(this);"><img class="mov" src="<?php echo $row["poster"];?>"></a>
                    </div>
                    <div class="movie_info flex">
                        <div class="movie_info_text flex">
                            <div class="title"><?php echo $row["title"];?></div>
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
                <?php
                    }
                }
        ?>
    </div>
</div>
<div class="list-box_half flex top5-ranking">
    <p class="label">Top 5 Most Reviewed Movies</p>
    <div class="top5-reviewed flex">
        <?php
            $sql = "SELECT mr.movie_id, title, poster, COUNT(review) FROM movie_review as mr JOIN movie as m ON mr.movie_id = m.movie_id GROUP BY mr.movie_id ORDER BY COUNT(review) DESC LIMIT 5";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
        ?>
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php?id=<?=$row["movie_id"];?>"><img class="mov" src="<?php echo $row["poster"];?>"></a>
                </div>
                <div class="movie_info flex">
                    <div class="movie_info_text flex">
                        <div class="title"><?php echo $row["title"];?></div>
                        <div class="rating">Reviews: <?php echo $row["COUNT(review)"];?></div>
                    </div>
                    <div class="movie_info_potato">
                        <a href=#><img class="like" src="../images/potato-add.png"></a>
                    </div>
                </div>
            </div>
        <?php } } ?>
    </div>
</div>

<div class="footer flex">
    <p class="footer_text">Copyright © Rotten Potatoes. Developed by Daniela, Yoon Soo, and Jeffrey.</p>
</div>

<?php mysqli_close($conn); ?>


