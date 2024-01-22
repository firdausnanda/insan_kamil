<?php

function tampilkanRating($rating) {
    // Pastikan rating berada dalam rentang 0-5
    $rating = max(0, min(5, $rating));

    // String untuk menyimpan ikon bintang
    $stars = '';

    // Bagian untuk bintang penuh (bilangan bulat)
    $bintangPenuh = floor($rating);

    // Loop untuk menambahkan bintang penuh
    for ($i = 0; $i < $bintangPenuh; $i++) {
        $stars .= '<i class="bi bi-star-fill"></i>';
    }

    // Bagian untuk bintang sebagian
    $bintangSebagian = $rating - $bintangPenuh;

    // Tambahkan bintang sebagian jika ada
    if ($bintangSebagian > 0) {
        // Hitung lebar karakter untuk bintang sebagian (misalnya, setengah bintang)
        $lebarSebagian = 5 - $bintangPenuh;
        $karakterBintangSebagian = str_repeat('<i class="bi bi-star-half"></i>', $bintangSebagian * $lebarSebagian);

        $stars .= $karakterBintangSebagian;
    }

    // Tambahkan bintang kosong jika rating kurang dari 5
    for ($i = strlen($stars); $i < 5; $i++) {
        $stars .= '<i class="bi bi-star"></i>';
    }

    // Tampilkan rating dalam bentuk bintang
    echo $stars;
}
