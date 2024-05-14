<?php

namespace App\Utility;

class Upload {


    public static function uploadFile($file, $fileName)
    {
        $currentDirectory = getcwd();
        $uploadDirectory = "/storage/";


        $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];

        $fileSize = $file['size'];
        $maxFileSize= 4 * 1024 * 1024;
        $fileTmpName = $file['tmp_name'];

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $pictureName = basename($fileName . '.'. $fileExtension);


        $uploadPath = $currentDirectory . $uploadDirectory . $pictureName;

        if (!in_array($fileExtension, $fileExtensionsAllowed)) {
            throw new \Exception("This file extension is not allowed. Please upload a JPEG or PNG file");
        }

        if ($fileSize > $maxFileSize) {
            throw new \Exception("File exceeds maximum size (4MB)");
        }

        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if ($didUpload) {
            return $pictureName;
        } else {
            throw new \Exception("An error occurred. Please contact the administrator.");
        }
    }
}
