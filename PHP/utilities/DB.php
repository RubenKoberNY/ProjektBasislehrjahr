<?php

define("db_host", "45.81.233.119");
define("db_user", "testing");
define("db_pwd", "nyptesting123");
define("db_dbname", "corona_prototype");

class DB
{
    private static $instance = NULL;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new mysqli(db_host, db_user, db_pwd, db_dbname);
        }
        return self::$instance;
    }
}
    /*INSERT INTO
        Albums (AlbumName, ArtistId)
    VALUES
        ('Ziltoid the Omniscient',  '12');

CLASSES =        PascalCase
METHODS & VARS = camelCase
 */
