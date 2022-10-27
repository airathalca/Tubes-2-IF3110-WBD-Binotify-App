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
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/globals.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/navbar.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/album/album-detail-admin.css">
    <!-- JavaScript Constant and Variables -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
        <?php if ($this->data) : ?>
            const album_id = <?= $this->data['album_id'] ?>;
            const image_path = "<?= $this->data['image_path'] ?>";
        <?php endif; ?>
    </script>
    <!-- JavaScript DOM and AJAX -->
    <script src="<?= BASE_URL ?>/javascript/album/update-album-detail.js" defer></script>
    <script src="<?= BASE_URL ?>/javascript/component/navbar.js" defer></script>
    <title>
        <?php if ($this->data) : ?>
            <?= $this->data['judul'] ?>
        <?php else : ?>
            Album not found
        <?php endif; ?>
    </title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <!-- Navigation bar -->
            <?php include(dirname(__DIR__) . '/template/Navbar.php') ?>
            <!-- Form -->
            <div class="pad-40">
                <p class="details-header">Album details</p>
                <?php if ($this->data) : ?>
                    <!-- Album related info -->
                    <form action="/public/album/detail/<?= $this->data['album_id'] ?>?csrf_token=<?= $_SESSION['csrf_token'] ?>" method="post" enctype="multipart/form-data" class="album-form">
                        <input type="hidden" name="album_id" value="<?= $this->data['album_id'] ?>">
                        <input type="hidden" name="old_path" value="<?= $this->data['image_path'] ?>">
                        <div class="form-group">
                            <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Album cover" class="album-cover">
                            <label for="cover">Upload new photo</label>
                            <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <label for="title">Album title</label>
                            <input type="text" name="title" id="title" value="<?= $this->data['judul'] ?>">
                        </div>
                        <!-- <div class="form-group">
                            <label for="artist">Artist</label>
                            <input type="text" name="artist" id="artist" value="<?= $this->data['penyanyi'] ?>">
                        </div> -->
                        <div class="form-group">
                            <label for="date">Published date</label>
                            <input type="date" name="date" id="date" value="<?= $this->data['tanggal_terbit'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre</label>
                            <input type="text" name="genre" id="genre" placeholder="Rock" value="<?= $this->data['genre'] ?>">
                        </div>
                        <div class="button-group">
                            <button class="button green-button" type="submit">Save changes</button>
                            <button class="button red-button" id="delete-button" type="button">Delete album</button>
                        </div>
                    </form>

                    <!-- Delete songs -->
                    <p class="songs-list-header">Songs inside this album:</p>
                    <?php if (!$this->data['songs']) : ?>
                        <p class="info">This album doesn't have any songs yet!</p>
                    <?php endif; ?>
                    <?php if ($this->data['songs']) : ?>
                        <div class="songs-list">
                            <?php foreach ($this->data['songs'] as $song) : ?>
                                <a href="/public/song/detail/<?= $song->song_id ?>" class="single-song">
                                    <p class="song-title"><?= $song->judul ?></p>
                                    <p class="song-genre"><?= $song->genre ?></p>
                                    <p class="song-dateduration"><?= substr($song->tanggal_terbit, 0, 4) ?> - <?= floor($song->duration / 60) ?> min <?= $song->duration % 60 ?> sec</p>
                                    <form action="/public/song/resetalbum/<?= $song->song_id ?>?csrf_token=<?= $_SESSION['csrf_token'] ?>" , method="post">
                                        <input type="hidden" value="<?= $this->data['album_id'] ?>" name="album_id" id="hidden_album_id">
                                        <button class="button red-button" type="submit">Delete song</button>
                                    </form>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!-- Add song into album! -->
                    <p class="add-song-header">Add a song into this album!</p>
                    <?php if (!$this->data['songs_to_add']) : ?>
                        <p class="info">There are no songs available for you to add!</p>
                    <?php endif; ?>
                    <?php if ($this->data['songs_to_add']) : ?>
                        <form action="/public/song/addtoalbum?csrf_token=<?= $_SESSION['csrf_token'] ?>" method="post" class="add-song-form">
                            <input type="hidden" value="<?= $this->data['album_id'] ?>" name="album_id" id="hidden_album_id_2">
                            <div class="dropdown">
                                <select name="song" id="song">
                                    <?php foreach ($this->data['songs_to_add'] as $song) : ?>
                                        <option value="<?= $song->song_id ?>">[ID <?= $song->song_id ?>] <?= $song->judul ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="button green-button">Add song to album</button>
                        </form>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="info">Cannot find the album you're looking for!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>