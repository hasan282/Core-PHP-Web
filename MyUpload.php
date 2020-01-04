<?php

class MyUpload
{
    private $lokasi_simpan = 'images/';
    private $batas_ukuran_file = 500000;
    private $error;
    private $hasil;

    public function ukuran($file)
    {
        return $file['size'];
    }

    public function hapusFile($fileName)
    {
        unlink($this->lokasi_simpan . $fileName);
    }

    public function cekEkstensi($file)
    {
        return strtolower(end(explode('.', $file['name'])));
    }

    public function unggah($file)
    {
        $ukuran = $this->ukuran($file);
        if ($ukuran == 0) {
            $this->hasil = array('status' => '1', 'info' => null);
        } else {
            $ekstensi = $this->cekEkstensi($file);
            $namaBaru = 'img_' . date('Ymd_His') . '.' . $ekstensi;
            $targetFile = $this->lokasi_simpan . $namaBaru;
            if (file_exists($targetFile)) $this->error = "File sudah ada";
            if ($ukuran > $this->batas_ukuran_file) {
                $this->error = $ukuran . "melebihi " . $this->batas_ukuran_file . "byte";
            }
            if ($ekstensi != "jpg" && $ekstensi != "jpeg" && $ekstensi != "png" && $ekstensi != "gif") {
                $this->error = "File bukan berupa gambar";
            }
            if (strlen($this->error) > 0) {
                $this->hasil = array("status" => "0", "info" => "error: " . $this->error);
            } else {
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    $this->hasil = array("status" => "1", "info" => $namaBaru);
                } else {
                    $this->hasil = array("status" => "0", "info" => "error: file tak terupload");
                }
            }
            return $this->hasil;
        }
    }
}
