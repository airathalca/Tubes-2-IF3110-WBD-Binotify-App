# Binotify

> Disusun untuk memenuhi Tugas Milestone 1 - Monolithic PHP & Vanilla Web Application IF3110 Pengembangan Aplikasi Berbasis Web

## Daftar Isi

-   [Deskripsi Aplikasi _Web_](#deskripsi-aplikasi-web)
-   [Struktur Program](#struktur-program)
-   [Daftar _Requirement_](#daftar-requirement)
-   [Cara Instalasi](#cara-instalasi)
-   [Cara Menjalankan _Server_](#cara-menjalankan-server)
-   [Screenshot Tampilan Aplikasi](#screenshot-tampilan-aplikasi)
-   [Entity Relationship Diagram](#entity-relationship-diagram)
-   [Pembagian Tugas](#pembagian-tugas)

## Deskripsi Aplikasi _Web_

**BNMO** (dibaca: Binomo) dan Doni sedang tergila-gila dengan musik toktok yang berjudul "[Tiba-Tiba](https://youtu.be/sJc1EwOrgM0?t=38)". Musik tersebut dijalankan oleh BNMO dan Doni melalui aplikasi bernama _youcub_ yang dinyalakan pada ponsel pintar milik Indra. Aplikasi _youcub_ tersebut harus tetap dibuka agar lagu tetap berjalan dan Indra kesal karena ponselnya dipinjam terus menerus oleh BNMO dan Doni. Oleh karena itu, Indra memiliki ide untuk membuatkan **Binotify**, aplikasi musik berbasis web pada BNMO. Namun, permasalahannya, BNMO adalah mesin yang kuno sehingga hanya kuat untuk menjalankan sebuah DBMS (PostgreSQL/MariaDB/MySQL) dan PHP murni beserta HTML, CSS, dan Javascript vanilla. Karena Indra tidak paham mengenai hal tersebut, Indra meminta tolong mahasiswa Informatika angkatan 2020 untuk membuatkan aplikasi tersebut.

## Struktur Program

```
.
│   .env.example
│   .gitignore
│   docker-compose.yml
│   Dockerfile
│   README.md
│
├───scripts
│       build-image.sh
│
└───src
    ├───app
    │   │   .htaccess
    │   │   init.php
    │   │
    │   ├───components
    │   │   ├───album
    │   │   │       AddAlbumPage.php
    │   │   │       AdminAlbumDetailPage.php
    │   │   │       AlbumListView.php
    │   │   │       UserAlbumDetailPage.php
    │   │   │
    │   │   ├───home
    │   │   │       HomePage.php
    │   │   │
    │   │   ├───not-found
    │   │   │       NotFoundPage.php
    │   │   │
    │   │   ├───song
    │   │   │       AddSongPage.php
    │   │   │       AdminSongDetailPage.php
    │   │   │       SearchPage.php
    │   │   │       UserSongDetailPage.php
    │   │   │
    │   │   ├───template
    │   │   │       Aside.php
    │   │   │       Navbar.php
    │   │   │
    │   │   └───user
    │   │           LoginPage.php
    │   │           RegisterPage.php
    │   │           UserListPage.php
    │   │
    │   ├───config
    │   │       config.php
    │   │
    │   ├───controllers
    │   │       AlbumController.php
    │   │       HomeController.php
    │   │       NotFoundController.php
    │   │       SongController.php
    │   │       UserController.php
    │   │
    │   ├───core
    │   │       App.php
    │   │       Controller.php
    │   │       Database.php
    │   │       MP3Access.php
    │   │       StorageAccess.php
    │   │       Tables.php
    │   │
    │   ├───exceptions
    │   │       LoggedException.php
    │   │
    │   ├───interfaces
    │   │       ControllerInterface.php
    │   │       ViewInterface.php
    │   │
    │   ├───middlewares
    │   │       AuthenticationMiddleware.php
    │   │       SongLimitMiddleware.php
    │   │       TokenMiddleware.php
    │   │
    │   ├───models
    │   │       AlbumModel.php
    │   │       SongModel.php
    │   │       UserModel.php
    │   │
    │   └───views
    │       ├───album
    │       │       AddAlbumView.php
    │       │       AdminAlbumDetailView.php
    │       │       AlbumListView.php
    │       │       UserAlbumDetailView.php
    │       │
    │       ├───home
    │       │       MainView.php
    │       │
    │       ├───not-found
    │       │       NotFoundView.php
    │       │
    │       ├───song
    │       │       AddSongView.php
    │       │       AdminSongDetailView.php
    │       │       SearchView.php
    │       │       SongDetailView.php
    │       │       UserSongDetailView.php
    │       │
    │       └───user
    │               LoginView.php
    │               RegisterView.php
    │               UserListView.php
    │
    ├───public
    │   │   .htaccess
    │   │   index.php
    │   │
    │   ├───images
    │   │   ├───assets
    │   │   │       arrow-left.svg
    │   │   │       arrow-right-white.svg
    │   │   │       arrow-right.svg
    │   │   │       bars.svg
    │   │   │       dropdown-arrow.svg
    │   │   │       logo-dark.svg
    │   │   │       logo-light.svg
    │   │   │       logo-notext-dark.svg
    │   │   │       sample.png
    │   │   │       search.svg
    │   │   │       user-solid.svg
    │   │   │
    │   │   └───icon
    │   │           android-chrome-192x192.png
    │   │           android-chrome-512x512.png
    │   │           apple-touch-icon.png
    │   │           favicon-16x16.png
    │   │           favicon-32x32.png
    │   │           favicon.ico
    │   │           site.webmanifest
    │   │
    │   ├───javascript
    │   │   ├───album
    │   │   │       add-album.js
    │   │   │       album-list.js
    │   │   │       update-album-detail.js
    │   │   │
    │   │   ├───component
    │   │   │       navbar.js
    │   │   │
    │   │   ├───home
    │   │   │       home.js
    │   │   │
    │   │   ├───lib
    │   │   │       debounce.js
    │   │   │
    │   │   ├───song
    │   │   │       add-song.js
    │   │   │       play-song.js
    │   │   │       search.js
    │   │   │       update-song.js
    │   │   │
    │   │   └───user
    │   │           login.js
    │   │           register.js
    │   │           user-list.js
    │   │
    │   └───styles
    │       ├───album
    │       │       add-album.css
    │       │       album-detail-admin.css
    │       │       album-detail.css
    │       │       album-list.css
    │       │
    │       ├───home
    │       │       home.css
    │       │
    │       ├───not-found
    │       │       not-found.css
    │       │
    │       ├───song
    │       │       add-song.css
    │       │       search.css
    │       │       song-detail-admin.css
    │       │       song-detail.css
    │       │
    │       ├───template
    │       │       aside.css
    │       │       globals.css
    │       │       navbar.css
    │       │
    │       └───user
    │               login.css
    │               register.css
    │               user-list.css
    │
    └───storage
        ├───images
        │       .gitkeep
        │
        └───songs
                .gitkeep
```

## Daftar _Requirement_

1. Login
2. Register
3. Home
4. Daftar Album
5. Search, Sort, dan Filter
6. Edit Lagu
7. Detail Lagu
8. Edit Album
9. Detail Album
10. Tambah Lagu
11. Tambah Album
12. Daftar User

## Cara Instalasi

1. Lakukan pengunduhan _repository_ ini dengan menggunakan perintah `git clone https://gitlab.informatika.org/rayhankinan/if-3110-2022-k-02-01-01.git` pada terminal komputer Anda.
2. Pastikan komputer Anda telah menginstalasi dan menjalankan aplikasi Docker.
3. Lakukan pembuatan _image_ Docker yang akan digunakan oleh aplikasi ini dengan menjalankan perintah `docker build -t tubes-1:latest .` pada terminal _directory_ aplikasi web.
4. Buatlah sebuah file `.env` yang bersesuaian dengan penggunaan (contoh file tersebut dapat dilihat pada `.env.example`).

## Cara Menjalankan _Server_

1. Anda dapat menjalankan program ini dengan menjalankan perintah `docker-compose up -d` pada terminal _directory_ aplikasi web.
2. Aplikasi web dapat diakses dengan menggunakan browser pada URL `http://localhost:8080/public/home`.
3. Aplikasi web dapat dihentikan dengan menjalankan perintah perintah `docker-compose down` pada terminal _directory_ aplikasi web.

## Screenshot Tampilan Aplikasi

### Login

![Login Page](./screenshots/login.png)

### Register

![Register Page](./screenshots/register-1.png)
![Register Page](./screenshots/register-2.png)

### Home

![Home Page](./screenshots/home.png)

### Daftar Album

![Album List Page](./screenshots/list-album-1.png)
![Album List Page](./screenshots/list-album-2.png)

### Search, Sort, dan Filter

![Search, Sort, dan Filter Page](./screenshots/search-sort-filter-1.png)
![Search, Sort, dan Filter Page](./screenshots/search-sort-filter-2.png)

### Edit Lagu

![Edit Song Page](./screenshots/edit-song-1.png)
![Edit Song Page](./screenshots/edit-song-2.png)

### Detail Lagu

![Detail Song Page](./screenshots/detail-song.png)

### Edit Album

![Edit Album Page](./screenshots/edit-album-1.png)
![Edit Album Page](./screenshots/edit-album-2.png)
![Edit Album Page](./screenshots/edit-album-3.png)

### Detail Album

![Detail Album Page](./screenshots/detail-album-1.png)
![Detail Album Page](./screenshots/detail-album-2.png)

### Tambah Lagu

![Add Song Page](./screenshots/add-song-1.png)
![Add Song Page](./screenshots/add-song-2.png)

### Tambah Album

![Add Album Page](./screenshots/add-album-1.png)
![Add Album Page](./screenshots/add-album-2.png)

### Daftar User

![User List Page](./screenshots/list-user-1.png)
![User List Page](./screenshots/list-user-2.png)

## _Entity Relationship Diagram_

![Entity Relationship Diagram](./screenshots/tubeswbd.png)

## Pembagian Tugas

| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    | 13520065 |
| Register                 | 13520065 |
| Home                     | 13520119 |
| Daftar Album             | 13520119 |
| Search, Sort, dan Filter | 13520101 |
| Edit Lagu                | 13520101 |
| Detail Lagu              | 13520101 |
| Edit Album               | 13520119 |
| Detail Album             | 13520119 |
| Tambah Lagu              | 13520101 |
| Tambah Album             | 13520119 |
| Daftar User              | 13520065 |
