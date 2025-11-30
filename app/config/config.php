<?php
// mendeklarasikan variabel constant secara global
define('BASE_URL', 'http://localhost:8080'); // buat base url atau url utama
define('BASE_URL_IMG', 'http://localhost:8080/app/resource/'); 
define('PROFILE_PATH', $_SERVER['DOCUMENT_ROOT'].'/rating-web/app/resource/profile/'); // buat path menyimpan gambar profile
define('MOVIE_PATH', $_SERVER['DOCUMENT_ROOT'].'/app/resource/movie/'); // path menyimpan gambar movie
define('ACTOR_PATH', $_SERVER['DOCUMENT_ROOT'].'/rating-web/app/resource/actor/'); // path menyimpan gambar actor

define('DB_HOST', 'mysql'); // host database
define('DB_USER', 'root'); // user database
define('DB_PASS', ''); // password database
define('DB_NAME', 'ratingfilm'); // nama database