<?php

class Upload
{
    private $Location = IMG_LOCATION . '/';
    private $FileLimit = LIMIT_FILESIZE;
    private $ifError;
    private $Result;

    private function _FileSize($file)
    {
        return $file['size'];
    }

    private function _CheckExtens($file)
    {
        return strtolower(end(explode('.', $file['name'])));
    }

    public function UploadFile($file)
    {
        $FileSize = $this->_FileSize($file);
        if ($FileSize == 0) {
            $this->Result = array('status' => '1', 'info' => null);;
        } else {
            $FileExtens = $this->_CheckExtens($file);
            $NewName = 'img_' . date('Ymd_His') . '.' . $FileExtens;
            $FileTarget = $this->Location . $NewName;
            if (file_exists($FileTarget)) $this->ifError = 'File Sudah Ada';
            if ($FileSize > $this->FileLimit) $this->ifError = 'Melebihi Batas Ukuran';
            if ($FileExtens != 'jpg' && $FileExtens != 'jpeg' && $FileExtens != 'png' && $FileExtens != 'gif') {
                $this->ifError = 'File Tidak Terdeteksi Sebagai Gambar';
            }
            if (strlen($this->ifError) > 0) {
                $this->Result = array('status' => '0', 'info' => '');
            } else {
                if (move_uploaded_file($file['tmp_name'], $FileTarget)) {
                    $this->Result = array('status' => 1, 'info' => $NewName);;
                } else {
                }
            }
        }
    }

    public function DeleteFile($file)
    {
        unlink($this->Location . $file);
    }
}
