<html lang="en">
<?php
include "../app/core/functions.php";

$rows = db_query("select * from artists order by id desc limit 24");

?>

<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../public/assets/css/style1.css">
    <link rel="stylesheet" href="../public/assets/css/style1.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Music Website</title>
</head>

<body>
    <header>
        <div class="menu_side">
            <h1>Music_KPV</h1>
            <div class="Music">
                <h4 class="active"><span></span><i class="bi bi-person"></i><a href="profile" style="text-decoration:  none; color:azure;">Cá nhân</a></h4>
                <h4 class="active"><span></span><i class="bi bi-disc"></i></i>Khám phá</h4>
                <h4 class="active"><span></span><i class="bi bi-music-note-list"></i></i>Playlist</h4>
                <h4 class="active"><span></span><i class="bi bi-person-bounding-box"></i><a href="" id="artist-link" style="text-decoration:  none; color:azure;"></i>Theo dõi</h4>

                <div id="artist-list"></div>
            </div>
            <div class="menu_buttons">
                <div class="button">
                    <button class="playlist_button">Danh sách phát</button>
                </div>
                <div class="button">
                    <button class="recent_button">Nghe gần đây</button>
                </div>
            </div>
            <div class="menu_song">
                <li class="songItem">
                    <span>01</span>
                    <img src="" alt="">
                    <h5>Fuck you! <br>
                        <div class="subtitle">Hong Phuc</div>
                    </h5>
                    <i class="bi playlistPlay bi-play-fill" id="1"></i>
                </li>
            </div>
        </div>

        <section class="content">
            <div class="song_side">
                <?php if (!empty($rows)) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <div class="artist">
                            <h2><?= $row['name'] ?></h2>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#artist-link").click(function(e){
    e.preventDefault();
    $.ajax({
      url: 'get_artists.php',
      type: 'get',
      success: function(data) {
        var artists = JSON.parse(data);
        // Clear the song_side div
        $('.song_side').empty();
        // Add each artist to the song_side div
        $.each(artists, function(i, artist) {
          $('.song_side').append('<div class="artist">' + artist.name + '</div>');
        });
      }
    });
  });
});
</script>
        <div class="music-card">
            <div style="overflow: hidden;">
                <a href="<?= ROOT ?>/song/<?= $row['slug'] ?>"><img src="<?= ROOT ?>/<?= $row['image'] ?>"></a>
            </div>
            <div class="card-content">
                <div class="card-title"><?= esc($row['title']) ?></div>
                <div class="card-subtitle"><?= esc(get_artist($row['artist_id'])) ?></div>
                <div class="card-subtitle" style="font-size: 12px;">Category: <?= esc(get_category($row['category_id'])) ?></div>
            </div>
        </div>
    </header>
</body>

</html>