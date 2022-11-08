<?php @include "header.php"; ?>

<?php if(!empty($_SESSION['user_id'])) { ?>
<div class="list-box flex">
    <div class="showall flex">
        <a href="#" class="showall_btn">Show All</a>
    </div>
    <div class="list-box_half flex">
        <p class="label">Movies I Want To Watch</p>
        <div class="mylist flex">
            <?php 
                $sql = "SELECT w.movie_id, title, poster, AVG(rating) FROM watchlist as w JOIN movie as m ON w.movie_id = m.movie_id JOIN movie_rating as mra ON mra.movie_id = w.movie_id WHERE w.user_id = ? GROUP BY w.movie_id";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
            ?>
                <div class="movie">
                    <div class="movie_poster">
                        <a href="movie.php?id=<?=$row["movie_id"];?>"><img class="mov" src="<?php echo $row["poster"];?>"></a>
                    </div>
                    <div class="movie_info flex">
                        <div class="movie_info_text">
                            <div class="title"><?php echo $row["title"];?></div>
                            <div class="rating">Rating: 
                                <?php 
                                    for ($x = 1; $x <= floor($row["AVG(rating)"]); $x++) echo "★";
                                    for ($y = 1; $y <= 5-floor($row["AVG(rating)"]); $y++) echo "☆";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="list-box_half flex">
        <p class="label">Movies I've Watched</p>
        <div class="top5 flex">
        <?php 
                $sql = "SELECT w.movie_id, title, poster FROM watchedlist as w JOIN movie as m ON w.movie_id = m.movie_id WHERE w.user_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                        <div class="movie">
                            <div class="movie_poster">
                                <a href="movie.php?id=<?=$row["movie_id"];?>"><img class="mov" src="<?php echo $row["poster"];?>"></a>
                            </div>
                            <div class="movie_info flex">
                                <div class="movie_info_text">
                                    <div class="title"><?php echo $row["title"];?></div>
                                    <div class="rating">My Rating: ☆☆☆☆☆
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
            ?>
        </div>
    </div>
</div>

<div class="footer flex">
    <p class="footer_text">Copyright © Rotten Potatoes. Developed by Daniela, Yoon Soo, and Jeffrey.</p>
</div>
<?php } else { 
    header("location: login.php");
} ?>

