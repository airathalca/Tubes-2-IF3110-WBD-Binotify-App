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
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/styles/album/album-detail-admin.css">
    <!-- JavaScript DOM and AJAX -->
    <script type="text/javascript" defer>
        const CSRF_TOKEN = "<?= $_SESSION['csrf_token'] ?? '' ?>";
    </script>
    <script src="<?= BASE_URL ?>/javascript/album/add-album.js" defer></script>
    <title>
        <?php if ($this->data) { ?>
            <?= $this->data['judul'] ?>
        <?php } else { ?>
            Album not found
        <?php } ?>
    </title>
</head>

<body>
    <div class="black-body">
        <div class="wrapper">
            <!-- Navigation bar -->

            <!-- Form -->
            <div class="pad-40">
                <p class="details-header">Album details</p>
                <?php if ($this->data) { ?>
                    <!-- Album related info -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <img src="<?= STORAGE_URL ?>/images/<?= $this->data['image_path'] ?>" alt="Album cover" class="album-cover">
                            <label for="cover">Upload new photo</label>
                            <input type="file" name="cover" id="cover" accept="image/png, image/jpeg">
                        </div>
                        <div class="form-group">
                            <label for="title">Album title</label>
                            <input type="text" name="title" id="title" value=<?= $this->data['judul'] ?>>
                        </div>
                        <div class="form-group">
                            <label for="artist">Artist</label>
                            <input type="text" name="artist" id="artist" value=<?= $this->data['penyanyi'] ?>>
                        </div>
                        <div class="button-group">
                            <button class="button green-button" type="submit">Save changes</button>
                            <button class="button red-button" type="button">Delete album</button>
                        </div>
                    </form>
                    
                    <!-- Delete songs -->
                    <p class="songs-list-header">Songs inside this album:</p>
                    <div class="songs-list">
                        <div class="single-song">
                            <p class="song-title">Bidadari Surga</p>
                            <p class="song-genre">Rock</p>
                            <p class="song-dateduration">1 April 2016 - 3 min 59 sec</p>
                            <button class="button red-button">Delete song</button>
                        </div>
                        <div class="single-song">
                            <p class="song-title">Bidadari Surga</p>
                            <p class="song-genre">Rock</p>
                            <p class="song-dateduration">1 April 2016 - 3 min 59 sec</p>
                            <button class="button red-button">Delete song</button>
                        </div>
                        <div class="single-song">
                            <p class="song-title">Bidadari Surga</p>
                            <p class="song-genre">Rock</p>
                            <p class="song-dateduration">1 April 2016 - 3 min 59 sec</p>
                            <button class="button red-button">Delete song</button>
                        </div>
                    </div>

                    <!-- Add song into album! -->
                    <p class="add-song-header">Add a song into this album!</p>
                    <form action="" method="post" class="add-song-form">
                        <div class="dropdown">
                            <select name="song" id="song">
                                <option value="1">Bidadari Surga</option>
                                <option value="2">Bidadari Neraka</option>
                            </select>
                        </div>
                        <button type="submit" class="button green-button">Add song to album</button>
                    </form>
                <?php } else { ?>
                    <p class="info">Cannot find the album you're looking for!</p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>