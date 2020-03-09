<?php

class Flasher
{
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            $psn = $_SESSION['flash']['pesan'];
            $act = $_SESSION['flash']['aksi'];
            $typ = $_SESSION['flash']['tipe'];
            $flashMessage = "<div class='alert alert-$typ alert-dismissible fade show'>" .
                "$psn <strong>$act</strong><button type='button' class='close' data-dismiss='alert' aria-label='Close'>" .
                "<span aria-hidden='true'>&times;</span></button></div>";
            echo $flashMessage;
            unset($_SESSION['flash']);
        }
    }
}
