<?php


class Utils
{
    const alphaNumeric = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    static $map = array(
        "Big-Five" => "thebigfive",
        "Risiko" => "risiko",
        "Liegestütze" => "liegestuetze",
        "Cooper" => "cooper",
        "Ayurveda" => "ayurveda",
        "Maximisierung" => "maximisierung",
        "Lerntyp" => "lerntyp",
        "self-leadership" => "selfleadership",
        "Work-Life" => "worklife",
        "Social Media Süchtig" => "socialmedia",
        "Bekanntheistest" => "bekanntheit",
        "Einbürgerung" => "einbuergerung",
        "Wer wird Millionär" => "werwirdmillionaer");

    static function redirect($url, $status = 302)
    {
        http_response_code($status);
        header("Location: " . $GLOBALS["BASE_URL"] . substr($url, 1));
        die();
    }


    static function getNewValidId()
    {
        $sql = "SELECT COUNT(*) FROM gameid WHERE gamecode = ?";
        while (true) {
            $id = self::getNewId();
            $stmt = DB::getInstance()->prepare($sql);
            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                $res = $stmt->get_result();
                if ($res->num_rows && $res->fetch_row()[0] == 0) {
                    return $id;
                }
            }
        }
    }

    static function getNewId()
    {
        $id = "";
        for ($i = 0; $i < 6; $i++) {
            $id .= self::alphaNumeric[random_int(0, strlen(self::alphaNumeric) - 1)];
        }
        return $id;
    }
}
