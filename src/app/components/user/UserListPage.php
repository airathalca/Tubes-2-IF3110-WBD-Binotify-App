<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touce-icon" sizes="180x180" href="<?= BASE_URL ?>/images/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/images/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= BASE_URL ?>/images/icon/favicon-16x16.png">
    <link rel="manifest" href="<?= BASE_URL ?>/images/icon/site.webmanifest">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user/user-list.css">
    <script type="text/javascript" src="<?= BASE_URL ?>/javascript/user/user-list.js" defer></script>
    <title>User List</title>
</head>

<body>
    <header></header>
    <nav></nav>
    <main>
        <section>
            <?php foreach ($this->data['user_arr'] as $index => $user) : ?>
                <article>
                    <div>Index: <?= $index ?></div>
                    <div>User ID: <?= $user->user_id ?></div>
                    <div>Email: <?= $user->email ?></div>
                    <div>Username: <?= $user->username ?></div>
                </article>
            <?php endforeach; ?>
        </section>
        <aside></aside>
    </main>
    <footer></footer>
</body>

</html>