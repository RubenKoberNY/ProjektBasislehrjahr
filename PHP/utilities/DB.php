<?php
include 'db_config.php';

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
