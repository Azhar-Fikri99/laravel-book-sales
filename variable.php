<?php
echo "Hello World";

//variable di php dibagi 2 jenis
// variable system(built-in)
// variable 
echo 'Document Root: ' . $_SERVER['DOCUMENT_ROOT'];
echo '<br>';

// ini variable system nya
// $_


//variable user (variable yang dibuat oleh pengguna)
$name = 'Azhar Fikri';
$age = 15;
$isHunggry = false;
echo "$name" . " $age " . "$isHunggry";
echo '<br>';

// Re-assign value
$name = 'fikri';
echo $name;
echo '<br>';

//mau menampilkan variable
echo 'nama saya '. $name . ' Umur saya ' . $age , ' Apakah saya lapar ?' . $isHunggry;

//menampilkan variable dengan HTML
echo "<h1 style= color:red> Nama saya $name, umur saya $age, apakah saya lapar ? $isHunggry </h1>";
echo "<br> <br>";


//variable konstant (tidak bisa di lakukan di re-assign)
// 1. define 
// 2. Const

// perbedaan nya : tidak, kalau define itu lawas, const itu yang baru, dalam sisi program gak mempengaruhi .echo '<br>'

// define('nama_variabel', 'nilai_nya')
define("BOOTCAMP","Fullstack Web Dev");
const MATERI = 'laravel';

define('BOOTCAMP2', "DevOps");
echo BOOTCAMP;
echo '<br>';
// const MATERI = 'Javascript';     -> output : error

// Menampilkan variable KOnstanta
echo BOOTCAMP;
echo '<br>';
echo MATERI;

?>