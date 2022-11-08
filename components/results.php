<?php @include "header.php"; 

if(isset($_POST['submit_search'])) { 
    $fsearch = $_POST['search'];	

    $sql = "SELECT m.movie_id, title, poster, AVG(rating) FROM movie as m JOIN movie_rating as mr ON mr.movie_id = m.movie_id WHERE title LIKE CONCAT('%',?,'%') GROUP BY m.movie_id UNION SELECT m.movie_id, title, poster, AVG(rating) FROM movie_keyword as mk JOIN movie as m ON m.movie_id = mk.movie_id JOIN keywords AS k ON k.keyword_id = mk.keyword_id JOIN movie_rating as mr ON mr.movie_id = mk.movie_id WHERE keyword LIKE CONCAT('%',?,'%') GROUP BY m.movie_id UNION SELECT m.movie_id, title, poster, AVG(rating) FROM movie_category as mc JOIN movie as m ON m.movie_id = mc.movie_id JOIN categories AS c ON c.category_id = mc.category_id JOIN movie_rating as mr ON mr.movie_id = mc.movie_id WHERE category LIKE CONCAT('%',?,'%') GROUP BY m.movie_id";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $fsearch, $fsearch, $fsearch);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
 ?>

<div class="list-box_half flex">
    <p class="label">Search Results</p>
    <div class="list search-results flex">
        <?php 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
        <div class="movie">
            <div class="movie_poster">
                <a href="movie.php?id=<?=$row["movie_id"];?>"><img class="mov" src="<?=$row['poster'];?>"></a>
            </div>
            <div class="movie_info flex">
                <div class="movie_info_text">
                    <div class="title"><?=$row['title'];?></div>
                    <div class="rating">Rating: 
                        <?php 
                            for ($x = 1; $x <= floor($row['AVG(rating)']); $x++) echo "★";
                            for ($y = 1; $y <= 5-floor($row['AVG(rating)']); $y++) echo "☆";
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

<div class="footer flex">
    <p class="footer_text">Copyright © Rotten Potatoes. Developed by Daniela, Yoon Soo, and Jeffrey.</p>
</div>
