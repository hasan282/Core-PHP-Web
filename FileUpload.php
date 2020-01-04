<?php

class FileUpload
{
    private $FileLocation = IMG_LOCATION . '/';
    private $FileSizeLimit = LIMIT_FILESIZE;
    private $FileExtension = FILE_EXTENSION;
    private $ErrorMessage;
    private $UploadResult;

    public function UploadFile($File)
    {
    }

    public function DeleteFile($File)
    {
        unlink($this->FileLocation . $File);
    }

    public function ReplaceFile($OldFile, $NewFile)
    {
    }

    private function _FileSize($File)
    {
        return $File['size'];
    }

    private function _CheckExtension($File)
    {
    }
}
