# Binotify

> Disusun untuk memenuhi Tugas Milestone 1 - Monolithic PHP & Vanilla Web Application IF3110 Pengembangan Aplikasi Berbasis Web

## Daftar Isi

-   [Deskripsi Aplikasi Web](#deskripsi-aplikasi-web)
-   [Daftar Requirement](#daftar-requirement)
-   [Cara Instalasi](#cara-instalasi)
-   [Cara Menjalankan Server](#cara-menjalankan-server)
-   [Screenshot Tampilan Aplikasi](#screenshot-tampilan-aplikasi)
-   [Pembagian Tugas](#pembagian-tugas)

## Deskripsi Aplikasi _Web_

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
