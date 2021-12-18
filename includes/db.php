<?php

$connect = mysqli_connect('localhost', 'root', '', 'url_shortener');
$url_ori = 'http://localhost:12701/url-shortener-sederhana/';

if (mysqli_connect_errno())
    die('Gagal terhubung ke database: <b>'.mysqli_connect_error().'</b>');

?>