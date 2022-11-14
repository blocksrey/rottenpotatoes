<?php @include "header.php"; ?> 

<div class="list-box">
    <div class="label stats-label">MOVIE STATISTICS</div>
    <div class="stats-wrapper flex">
        <div class="rating-ranks bars-chart">
            <h1 class="stats-title">Rank by Categories' Average Rating</h1><br>
            <div class="bars flex">
                    <?php
                        $sql = "SELECT c.category, AVG(rating) AS ratings, DENSE_RANK() OVER (ORDER BY ratings DESC) AS rank FROM movie_rating AS mr RIGHT JOIN movie_category AS mc ON mc.movie_id = mr.movie_id RIGHT JOIN categories AS c ON c.category_id = mc.category_id LEFT JOIN ( SELECT c.category_id, COUNT(movie_id) AS movies FROM movie_category AS mc RIGHT JOIN categories AS c ON mc.category_id = c.category_id ) AS n ON n.category_id = c.category_id GROUP BY category";
                        $result = $conn->query($sql);
                        if($result->num_rows) {
                            while($row = $result->fetch_assoc()) {
                    ?>
                            <li class="bars_each">
                                <span class="bar">
                                    <span id="<?=$row['category']?>" style="width:<?php if($row['ratings']==NULL) {echo "0";} else { echo ($row['ratings']*80)/5; }?>%; background-color: <?php if($row['rank']==1) { echo "rgba(252, 226, 77, 0.942)"; }?>">
                                        <span class="rate-num"><?=$row['ratings']?> ★</span>
                                    </span>
                                </span>
                                <div class="bar_info flex">
                                    <h3 class="rank">#<?=$row['rank']?></h3>
                                    <h3><?=$row['category']?></h3>
                                </div>
                            </li>
                    <?php } } ?>
            </div>
        </div>  
        <div class="rating-ranks table-chart flex">
            <table class="stats-table flex">
                <h1 class="stats-title">Total Counts per Category</h1><br>
                <tr>
                    <th>Category</th>
                    <th>Movies</th>
                    <th>Reviews</th>
                    <th>Ratings</th>
                </tr>
                <?php
                    $sql = "SELECT table1.category, movies, reviews, ratings FROM ( SELECT COALESCE(category, 'Total') AS category, COUNT(movie_id) AS movies FROM movie_category AS mc RIGHT JOIN categories AS c ON mc.category_id = c.category_id GROUP BY category WITH ROLLUP ) AS table1 JOIN( SELECT COALESCE(c.category, 'Total') AS category, COUNT(review) AS reviews FROM movie_review AS mr RIGHT JOIN movie_category AS mc ON mc.movie_id = mr.movie_id RIGHT JOIN categories AS c ON c.category_id = mc.category_id LEFT JOIN( SELECT mc.category_id, COUNT(movie_id) AS movies FROM movie_category AS mc RIGHT JOIN categories AS c ON mc.category_id = c.category_id ) AS n ON n.category_id = c.category_id GROUP BY category WITH ROLLUP ) AS table2 ON table1.category = table2.category JOIN(SELECT COALESCE(c.category, 'Total') AS category, COUNT(rating) AS ratings FROM movie_rating AS mr RIGHT JOIN movie_category AS mc ON mc.movie_id = mr.movie_id RIGHT JOIN categories AS c ON c.category_id = mc.category_id LEFT JOIN( SELECT c.category_id, COUNT(movie_id) AS movies FROM movie_category AS mc RIGHT JOIN categories AS c ON mc.category_id = c.category_id ) AS n ON n.category_id = c.category_id GROUP BY category WITH ROLLUP) AS table3 ON table3.category = table1.category";
                    $result = $conn->query($sql);
                    if($result->num_rows) {
                        while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="categ-td"><?=$row['category']?></td>
                    <td><?=$row['movies']?></td>
                    <td><?=$row['reviews']?></td>
                    <td><?=$row['ratings']?></td>
                </tr>
                <?php } } ?>
            </table>
        </div>
    </div>
</div>

<div class="footer flex">
    <p class="footer_text">Copyright © Rotten Potatoes. Developed by Daniela, Yoon Soo, and Jeffrey.</p>
</div>

<?php mysqli_close($conn); ?>

