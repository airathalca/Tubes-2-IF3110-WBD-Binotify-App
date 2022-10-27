<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/globals.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/navbar.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/aside.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/song/song-detail-admin.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        <?php if ($this->data) { ?>
            const song_id = <?= $this->data['song_id'] ?>;
            const image_path = "<?= $this->data['image_path'] ?>";
            const audio_path = "<?= $this->data['audio_path'] ?>";
            const duration = "<?= $this->data['duration'] ?>";
            const album_id = "<?= $this->data['album'] ?>";
        <?php } ?>
    </script>
    <script src="<?= BASE_URL ?>/javascript/song/update-song.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        <?php if ($this->data) { ?>
            <?= $this->data['judul'] ?>
        <?php } else { ?>
            Song not found
        <?php } ?>
    </title>
</head>

<body>
    <div class="black-body">
        <!-- Aside -->
        <?php include(dirname(__DIR__) . '/template/Aside.php') ?>
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Form -->
            <div class="pad-40">
                <p class="details-header">Song details</p>
                <?php if ($this->data) { ?>
                    <!-- Song related info -->
                    <form action="/public/song/detail/<?= $this->data['song_id'] ?>?csrf_token=<?= $_SESSION['csrf_token'] ?>" method="post" enctype="multipart/form-data" class="song-form">
                        <input type="hidden" name="song_id" value="<?= $this->data['song_id'] ?>">
                        <input type="hidden" name="album_id" value="<?= $this->data['album'] ?>">
                        <input type="hidden" name="old_image_path" value="<?= $this->data['image_path'] ?>">
                        <input type="hidden" name="old_audio_path" value="<?= $this->data['audio_path'] ?>">
                        <input type="hidden" name="old_duration" value="<?= $this->data['duration'] ?>">
                        <div class="form-group">
                            <div class ="flex-img">
                                <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Song cover" class="song-cover">
                                <div>
                                    <p class="song-title"><?= $this->data['judul'] ?></p>
                                    <p class="song-artist"><?= $this->data['penyanyi'] ?></p>
                                    <p class="song-genre"><?= $this->data['genre'] ?></p>
                                    <p class="song-date"><?= date('d F Y', strtotime($this->data['tanggal_terbit'])) ?> </p>
                                    <p class="song-duration"><?=floor(((int) $this->data['duration']) / 60) . " min " . 
                                    ((int) $this->data['duration']) % 60 . " sec" ?></p>
                                 </div>
                            </div>
                            <label for="cover">Upload new photo</label>
                            <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <audio controls class="audio-player">
                                <source src="<?= STORAGE_URL?>/songs/<?=$this->data['audio_path']?>" id="audio-source">
                            </audio>
                            <label for="cover">Upload new audio</label>
                            <input type="file" name="audio" id="audio" accept="audio/mpeg">
                        </div>
                        <div class="form-group">
                            <label for="title">Song title</label>
                            <input type="text" name="title" id="title" value="<?= $this->data['judul'] ?>">
                            <p class="alert-hide" id="title-alert">Please fill out the song title!</p>
                        </div>
                        <div class="form-group">
                            <label for="date">Published date</label>
                            <input type="date" name="date" id="date" value="<?= $this->data['tanggal_terbit'] ?>">
                            <p class="alert-hide" id="date-alert">Please fill out the published date!</p>
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <input type="text" name="genre" id="genre" value="<?= $this->data['genre'] ?>">
                            <p class="alert-hide" id="genre-alert">Please fill out the song genre!</p>
                        </div>
                        <div class="button-group">
                            <button class="button green-button" type="submit">Save changes</button>
                            <button class="button red-button" id="delete-button" type="button">Delete song</button>
                        </div>
                    </form>
                    <?php if ($this->data['album'] === NULL) { ?>
                        <p class="info">This song doesn't belong to any album yet!</p>
                    <?php } else  { ?>
                        <a href="<?= BASE_URL?>/album/detail/<?= $this->data['album']?>" class="button button-album">See album!</a>
                    <?php } ?>
                <?php } else { ?>
                    <p class="info">Cannot find the song you're looking for!</p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>