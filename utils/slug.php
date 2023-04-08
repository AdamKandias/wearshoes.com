<?php

require_once("../db/database.php");
$db = new Database();

class Slug
{
    public static function SlugGenerator(string $name)
    {
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($name)));
        global $db;
        return $db->checkAndGenerateSlug($slug);
    }
}
