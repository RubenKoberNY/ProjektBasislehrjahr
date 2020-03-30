<?php

class Render
{
    private static $tempdir = "templates";
    private static $layout = "layout.php";

    public function __construct()
    {
    }

    public static function render($file, $stylesheet = null, $script = null, $args = array(), $nolayout = false)
    {
        if (file_exists(self::$tempdir . "/" . explode("/", $file)[0])) {
            $page = "";
            if ($nolayout) {
                $page = file_get_contents(self::$tempdir . "/" . $file);
            } else {
                $page = file_get_contents(self::$tempdir . "/" . self::$layout);
                $page = str_replace("%%content%%", file_get_contents(self::$tempdir . "/" . $file), $page);
            }
            foreach ($args as $key => $value) {
                $page = str_replace("%" . $key . "%", $value, $page);
            }
            if ($stylesheet != null) {
                $page = str_replace("<!--style-->", "<link rel='stylesheet' href='/" . self::$tempdir . "/" . $stylesheet . "'>", $page);
            }
            if ($script != null) {
                $page = str_replace("<!--scripts-->", "<script src='/" . self::$tempdir . "/" . $script . "'></script>", $page);
            }
            echo $page;
        } else {
            self::render("general/404.html", null, null, array(), true);
            return;
        }
    }

    public static function renderPhpFile($path, $args = array())
    {
        ob_start();
        self::$tempdir . "/" . $path;
        $var = ob_get_contents();
        $page = str_replace("%%content%%", $var, file_get_contents(self::$tempdir . "/" . self::$layout));
        ob_end_clean();
        echo $page;
    }
}
