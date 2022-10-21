<?php @include "header.php" ?>

<div class="wrapper">
    <p class="top-title">Explore</p>
    <div class="movie-box flex">
        <div class="movie-box_half flex">
            <p class="label">Most Watched Movie This Week</p>
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
            <p class="label">Newest Movie</p>
            <div class="big-movie flex">
                <div class="big-movie_poster">
                    <img src="https://assets.mubicdn.net/images/notebook/post_images/31814/images-w1400.jpg?1606176049">
                </div>
                <div class="big-movie_info flex" onclick="location.href='movie.php';">
                    <div class="title">Jaws</div>
                    <div class="rating">Rating: ☆☆☆☆☆</div>
                </div>
            </div>
        </div>
    </div>

    <div class="list-box_half flex">
        <p class="label home-list-label">Discover New Movies</p>
        <div class="explore flex">
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php"><img class="mov" src="https://originalvintagemovieposters.com/wp-content/uploads/2020/05/Ghostbusters-9294-scaled.jpg"></a>
                </div>
                <div class="movie_info flex">
                    <div class="movie_info_text">
                        <div class="title">Ghostbusters</div><br>
                        <div class="rating">Rate ☆☆☆☆☆</div>
                    </div>
                    <div class="movie_info_potato">
                        <a href=#><img class="like" src="../images/potato-add.png"></a>
                    </div>
                </div>
            </div>
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php"><img class="mov" src="https://assets.mubi.com/images/notebook/post_images/19893/images-w1400.jpg?1449196747"></a>
                </div>
                <div class="movie_info flex">Movie Info</div>
            </div>
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php"><img class="mov" src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/movie-poster-template-design-21a1c803fe4ff4b858de24f5c91ec57f_screen.jpg?ts=1574144362"></a>
                </div>
                <div class="movie_info flex">Movie Info</div>
            </div>
            <div class="movie">
                <div class="movie_poster">
                    <a href="movie.php"><img class="mov" src="https://lylesmoviefiles.com/wp-content/uploads/2017/01/martian-movie-poster.jpg"></a>
                </div>
                <div class="movie_info flex">Movie Info</div>
            </div>
            <div class="movie">
                <div class="movie_poster">
                    <a href=#><img src="../images/potato.png" class="like"></a>
                </div>
                <div class="movie_info flex">Movie Info</div>
            </div>
            <div class="movie">
                <div class="movie_poster">
                    <a href=#><img src="../images/potato.png" class="like"></a>
                </div>
                <div class="movie_info flex">Movie Info</div>
            </div>
        </div>
    </div>
</div>