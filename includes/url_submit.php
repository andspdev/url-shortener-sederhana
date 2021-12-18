<?php

$echo = '';
if (isset($_POST['submit'])) 
{
    // Panggil $_POST['url']
    $url = mysqli_real_escape_string($connect, $_POST['url']);
    $echo .= '<hr/>';
    
    // Validasi karakter inputan URL
    if (!preg_match('#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', $url)) 
    {
        $echo .= '<div class="alert alert-danger">Link yang Anda masukan tidak benar! Silahkan masukan kembali.</div>';
    }
    else if (mb_strlen($url) > 500) // Batas maksimal karakter URL -> 500 karakter
    {
        $echo .= '<div class="alert alert-danger">Panjang URL maksimal 500 karakter!</div>';
    }
    else 
    {
        // Buat random karakter URL Shortenernya
        $random_karakter = 'abcdefghijklmnopqrstuvwxyz';
        $kode_random = substr(str_shuffle($random_karakter.strtoupper($random_karakter).'0123456789'), 0, 8);
        $tanggal_buat = date("Y-m-d H:i:s");

        // Insert ke tabel `shortener`
        $insert = mysqli_query($connect, "INSERT INTO shortener SET url = '$url', kode = '$kode_random', tanggal_buat = '$tanggal_buat'");

        // Cek apakah berhasil atau terjadi error pas insert
        if ($insert) 
        {
            setcookie('berhasil', 1, time() + 3600, '/');
            header('location: ?kode='.$kode_random);
        }
        else 
        {
            $echo .='<div class="alert alert-danger">Terjadi kesalahan saat memperpendek link.</div>';
        }
    }
}

if (isset($_POST['submit']) || isset($_GET['kode'])) 
{
    echo '<div class="output">';
    echo $echo; // Pesan err

    // Deteksi kalau ada cookie berhasil, maka tampilin pesan berhasil
    if (isset($_COOKIE['berhasil'])) 
    {
        setcookie('berhasil', null, time() - 3600, '/');
        echo '<div class="alert alert-success">Berhasil memperpendek link</div><br/>';
    }

    if (!empty($_GET['kode']) && !isset($_POST['submit']) )
    {
        // Panggil $_GET['kode]
        $kode = mysqli_real_escape_string($connect, $_GET['kode']);

        $cek_kode = mysqli_query($connect, "SELECT url, kode, tanggal_buat FROM shortener WHERE kode='$kode'");

        // Cek apakah data $_GET['kode'] ada?
        if (mysqli_num_rows($cek_kode) == 0)
        {
            echo '<div class="alert alert-danger">Tidak dapat menemukan link yang Anda minta!</div>';
        }
        else
        {
            $fetch_kode = mysqli_fetch_object($cek_kode);
            $url_short = $url_ori.$fetch_kode->kode;

            echo '<br/>';
            echo '<div class="row">
                    <div class="col-md-2">
                        <div class="pd">
                            <b>Tanggal Buat</b>:
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="pd">
                            '.$fetch_kode->tanggal_buat.'
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="pd">
                            <b>URL Asli</b>:
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="pd">
                            '.$fetch_kode->url.'
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="pd">
                            <b>Link pendek</b>:
                        </div>
                    </div>

                    <div class="col-md-10">
                        <div class="pd">
                            <a href="'.$url_short.'" target="_blank" class="url"><span id="url-short">'.$url_short.'</span></a> 
                            <a href="#salin-link" class="btn btn-outline-success btn-sm" id="salin-link">Salin</a>
                        </div>
                    </div>
                </div>';
        }
    }

    echo '</div>';
}

?>