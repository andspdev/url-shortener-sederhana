<?php

include './db.php';

$kode = mysqli_real_escape_string($connect, $_GET['kode']);
$cek_kode = mysqli_query($connect, "SELECT url FROM shortener WHERE kode='$kode'");

if (mysqli_num_rows($cek_kode) == 0)
    $url_redirect = $url_ori.'?kode='.$kode;
else
{
    $fetch_kode = mysqli_fetch_object($cek_kode);
    $url_redirect = $fetch_kode->url;
}

header('location: '.$url_redirect);

?>