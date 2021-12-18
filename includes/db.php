<?php

$connect = mysqli_connect('localhost', 'root', '', 'dailyblogid_db');
$url_ori = 'http://localhost/';

if (mysqli_connect_errno())
    die('Gagal terhubung ke database: <b>'.mysqli_connect_error().'</b>');

?>
