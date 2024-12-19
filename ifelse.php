<!DOCTYPE html>
<body>
    <head>
        <style>
            h1{
                color: aqua;
                background-color: black;
            }
            h2,h3{
                color: lightcoral;
                background-color: blue;
                display: inline-block;
            }
        </style>
    </head>

<?php 
    $nama = "Budi Santoso";
    $totalBelanja = 150000;
    $keterangan = '';

    //ifelse
    if($totalBelanja > 100000){
        $keterangan = "Selamat $nama anda mendapatkan hadiah!";
        
    }else{
        $keterangan = 'Terimakashi sudah berbelanja '. $nama;
    }
?>

<?php
//tampilin --h1--
echo "<h1> $keterangan ";


?>


<!-- //cara tulis singkat nya, antara php dan echo -->
<!-- <?= $keterangan ?> -->


<!-- penting : cara singkat ini hanya cocok untuk 1 variable saja -->
<h2> Nama : <?= $nama ?> </h2>
<h3>Total Belanja : RP <?= number_format($totalBelanja,2,',')?> </h3>
<h3>Keterangan:  <?= $keterangan ?></h3>

</body>
</html>