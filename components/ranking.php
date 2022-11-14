<?php @include "header.php"?>
<?php require_once "connection.php"?>

<div class="list-box flex">
    <div class="showstats flex">
        <a href="statistics.php" class="showstats_btn">Learn More</a>
    </div>
    <div class="list-box_half flex top5-ranking">
        <p class="label">Top 5 Best Rated Movies</p>
        <div class="top5 flex" id="rarank-mov">
            <?php
            $sql = "SELECT mr.movie_id, title, poster, AVG(rating) FROM movie_rating as mr JOIN movie as m ON mr.movie_id = m.movie_id GROUP BY mr.movie_id ORDER BY AVG(rating) DESC LIMIT 5";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <div class="movie">
                    <div class="movie_poster">
                        <a href="movie.php?id=<?=$row["movie_id"]?>" id="<?php echo $row["movie_id"]?>" onclick="movieInfo(this);"><img class="mov" src="<?php echo $row["poster"];?>"></a>
                    </div>
                    <div class="movie_info flex">
                        <div class="movie_info_text flex">
                            <div class="title"><?php echo $row["title"];?></div>
                            <div class="rating">Rating: 
                                <?php 
                                    for ($x = 1; $x <= round($row["AVG(rating)"]); $x++) echo "★";
                                    for ($y = 1; $y <= 5-round($row["AVG(rating)"]); $y++) echo "☆";
                                ?>
                            </div>
                        </div>
                        <div class="movie_info_btns flex">
                        <?php if(empty($_SESSION['user_id'])) { ?>
                            <a href="login.php" class="like rate-btn">★</a>
                        <?php } else { 
                            $sqli = "SELECT rating FROM movie_rating WHERE movie_id=? AND user_id=?";
                            $stmti = $conn->prepare($sqli);
                            $stmti->bind_param('ii', $row['movie_id'], $_SESSION['user_id']);
                            $stmti->execute();
                            $resulti = $stmti->get_result();
                            $stmti->close(); ?>
                            <a href="#modal-one" class="like rate-btn" onclick="ranksRate(<?=$row['movie_id']?>, 'rarank-mov')">
                            <?php if($resulti->num_rows > 0) { while($rowi = $resulti->fetch_assoc()) { echo $rowi['rating']; }}?> ★</a>
                        <?php } ?>
                            <form method="POST" action="mymovies.php?id=<?=$row['movie_id']?>&url=ranking.php#rarank-mov" class="btns-form flex">
                                <?php 
                                    $iquery = "SELECT movie_id FROM watchlist WHERE movie_id=? AND user_id=?";
                                    $istmt = $conn->prepare($iquery);
                                    $istmt->bind_param('ii', $row["movie_id"], $_SESSION['user_id']);
                                    $istmt->execute();
                                    $iresult = $istmt->get_result();
                                    $istmt->close(); 
                                    if($iresult->num_rows>0){ ?>
                                        <input type="submit" name="del_btn_wl" class="like del" value="♥-"/>
                                    <?php } else { ?>
                                        <input type="submit" name="add_btn_wl" class="like add" value="♥+"/>
                                    <?php } ?>
                                    <?php 
                                    $iquery = "SELECT movie_id FROM watchedlist WHERE movie_id=? AND user_id=?";
                                    $istmt = $conn->prepare($iquery);
                                    $istmt->bind_param('ii', $row["movie_id"], $_SESSION['user_id']);
                                    $istmt->execute();
                                    $iresult = $istmt->get_result();
                                    $istmt->close(); 
                                    if($iresult->num_rows>0){ ?>
                                        <input type="submit" name="del_btn_wdl" class="like del" value="✓-"/>
                                    <?php } else { ?>
                                        <input type="submit" name="add_btn_wdl" class="like add" value="✓+"/>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>
    <div class="list-box_half flex top5-ranking">
        <p class="label">Top 5 Most Reviewed Movies</p>
        <div class="top5 flex" id="rera-mov">
            <?php
                $sql = "SELECT mr.movie_id, title, poster, COUNT(review) FROM movie_review as mr JOIN movie as m ON mr.movie_id = m.movie_id GROUP BY mr.movie_id ORDER BY COUNT(review) DESC LIMIT 5";
                $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
            ?>
                <div class="movie">
                    <div class="movie_poster">
                        <a href="movie.php?id=<?=$row["movie_id"]?>"><img class="mov" src="<?=$row["poster"]?>"></a>
                    </div>
                    <div class="movie_info flex">
                        <div class="movie_info_text flex">
                            <div class="title"><?php echo $row["title"];?></div>
                            <div class="rating">Reviews: <?php echo $row["COUNT(review)"];?></div>
                        </div>
                        <div class="movie_info_btns flex">
                        <?php if(empty($_SESSION['user_id'])) { ?>
                            <a href="login.php" class="like rate-btn">★</a>
                        <?php } else { 
                        $sqli = "SELECT rating FROM movie_rating WHERE movie_id=? AND user_id=?";
                        $stmti = $conn->prepare($sqli);
                        $stmti->bind_param('ii', $row['movie_id'], $_SESSION['user_id']);
                        $stmti->execute();
                        $resulti = $stmti->get_result();
                        $stmti->close(); ?>    
                            <a href="#modal-one" class="like rate-btn" onclick="ranksRate(<?=$row['movie_id']?>, 'rera-mov')">
                            <?php if($resulti->num_rows > 0) { while($rowi = $resulti->fetch_assoc()) { echo $rowi['rating']; }}?> ★</a>
                        <?php } ?>
                            <form method="POST" action="mymovies.php?id=<?=$row['movie_id']?>&url=ranking.php#rera-mov" class="btns-form flex">
                                <?php 
                                    $iquery = "SELECT movie_id FROM watchlist WHERE movie_id=? AND user_id=?";
                                    $istmt = $conn->prepare($iquery);
                                    $istmt->bind_param('ii', $row["movie_id"], $_SESSION['user_id']);
                                    $istmt->execute();
                                    $iresult = $istmt->get_result();
                                    $istmt->close(); 
                                    if($iresult->num_rows>0){ ?>
                                        <input type="submit" name="del_btn_wl" class="like del" value="♥-"/>
                                    <?php } else { ?>
                                        <input type="submit" name="add_btn_wl" class="like add" value="♥+"/>
                                    <?php } ?>
                                    <?php 
                                    $iquery = "SELECT movie_id FROM watchedlist WHERE movie_id=? AND user_id=?";
                                    $istmt = $conn->prepare($iquery);
                                    $istmt->bind_param('ii', $row["movie_id"], $_SESSION['user_id']);
                                    $istmt->execute();
                                    $iresult = $istmt->get_result();
                                    $istmt->close(); 
                                    if($iresult->num_rows>0){ ?>
                                        <input type="submit" name="del_btn_wdl" class="like del" value="✓-"/>
                                    <?php } else { ?>
                                        <input type="submit" name="add_btn_wdl" class="like add" value="✓+"/>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </div>
    <div id="modal-one" class="modal">
        <div class="modal-dialog">
            <div class="modal-header flex">
                <h2>How would you rate this movie?</h2>
                <a href="#" class="btn-close">×</a>
            </div>
            <form method="POST" action="/" id="modalRank">
                <fieldset class="modal-body flex">
                    <span class="star-cb-group flex">
                        <?php for($i=1; $i<=5; $i++) { ?>
                            <input type="radio" name="rating" id="r<?=$i?>" value="<?=$i?>" checked="checked"/><label for="r<?=$i?>"><?=$i?></label>
                        <?php } ?>                          
                    </span>
                </fieldset>
                <div class="modal-footer">
                    <input type="submit" name="rate_submit" class="modal-footer_btn" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="footer flex">
    <p class="footer_text">Copyright © Rotten Potatoes. Developed by Daniela, Yoon Soo, and Jeffrey.</p>
</div>

<?php mysqli_close($conn); ?>


