<?php

class Utils
{
    public static function CollectUploadedFiles(&$file_post): array
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
                $file_ary[$i]["type"] = str_replace("image/", "", $file_post["type"][$i]);
                $file_ary[$i]["name"] = md5(uniqid($file_post["name"][$i], true));
            }
        }

        return $file_ary;
    }

    public static function FilesValidation(array $files): bool
    {
        foreach ($files as $file) {
            // Check file size
            if ($file["size"] > 1000000) {
                return false;
            }

            // Check image extension
            if ($file['type'] != "jpg" && $file['type'] != "png" && $file['type'] != "jpeg") {
                return false;
            }
        }
        return true;
    }

    public static function MoveStoredImage(array $files)
    {
        foreach ($files as $file) {
            $name = $file["tmp_name"];
            $target_file = "../public/img/products/" . basename($file["name"] . "." . $file["type"]);
            if (!move_uploaded_file($name, $target_file)) {
                echo "move uploaded file error";
            };
        }
    }

    static public function ImageProcessAndUpload($file_post): string
    {
        $fileName = md5(uniqid($file_post["name"], true));
        $fileType = str_replace("image/", "", $file_post["type"]);

        if ($file_post['size'] > 1000000) {
            echo "Error: File too large";
        }

        if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg") {
            echo "Error: Invalid image format";
        }

        $finalName = basename($fileName . "." . $fileType);

        $name = $file_post["tmp_name"];
        $target_file = "../public/img/products/" . $finalName;
        if (!move_uploaded_file($name, $target_file)) {
            echo "move uploaded file error";
        }

        return $finalName;
    }
}
