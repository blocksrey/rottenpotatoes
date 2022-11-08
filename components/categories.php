<?php @include "header.php"; ?>

<div class="categ-box list-box flex">
    <div class="categ flex">
        <form method="POST" class="categ_top-box flex" id="categ_btn_form">
        <?php
            $sql = "SELECT category FROM categories";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
        <input type="submit" class="categ_btn" name="category" value="<?=$row['category']?>" id="<?=$row['category']?>">
        <?php } } ?>
        </form>
    </div>
    <div class="list-box_half flex">
        <div class="label">Discover movies by Category</div>
        <div class="list flex">
        <?php if(isset($_POST['category'])) {
            $category = $_POST['category'];	

            $sql = "SELECT mc.movie_id, title, poster, category, AVG(rating) FROM movie_category as mc JOIN categories as c ON c.category_id = mc.category_id JOIN movie as m ON m.movie_id = mc.movie_id JOIN movie_rating as mra ON mra.movie_id = mc.movie_id WHERE c.category = '" .$_POST['category'] ."' GROUP BY mc.movie_id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php?id=<?=$row["movie_id"]?>"><img class="mov" src="<?=$row['poster'];?>"></a>
                </div>
                <div class="movie_info flex">
                    <div class="movie_info_text">
                        <div class="title"><?=$row['title'];?></div>
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



