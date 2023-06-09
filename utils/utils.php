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

    public static function CurrencyFormatting(string $price): string
    {
        return number_format($price / 100, 2, '.', ',');
    }

    public static function EmailValidation(string $email)
    {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($pattern, $email);
    }

    public static function GenerateNotFoundMessage($category, $search, $minPrice, $maxPrice, $sizes): string
    {
        $stringCategory = $category;
        if ($category == '1') {
            $stringCategory = 'sport';
        } else if ($category == '2') {
            $stringCategory = 'classic';
        } else if ($category == '3') {
            $stringCategory = 'casual';
        }

        $message = "";

        if (!empty($search)) {
            $message .= "<p class='text-center m-0'><span class='fw-bold'>Product Name: </span> $search</p>";
        }

        if (!empty($category)) {
            $message .= "<p class='text-center m-0'><span class='fw-bold'>Category: </span>" . ucfirst($stringCategory) . "</p>";
        }

        if ($minPrice != '' && $maxPrice != '') {
            $message .= "<p class='text-center m-0'><span class='fw-bold'>Price From: </span> \$$minPrice<span class='fw-bold'> To: </span> \$$maxPrice</p>";
        }

        if (!empty($sizes)) {
            $message .= "<p class='text-center m-0'><span class='fw-bold'>Size: </span>" . implode(", ", $sizes) . "</p>";
        }

        if (!empty($message)) {
            return $message .= "<p class='text-danger fw-bold text-center h5 mt-2'>Product With That Filter Not Found!</p>";
        } else {
            return "<p class='text-danger fw-bold text-center h5 mt-2'>Product Not Found!</p>";
        }
    }
}
