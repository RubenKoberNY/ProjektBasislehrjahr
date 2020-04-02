<?php

class LerntypRepository
{
    public function __construct()
    {
        $lerntyp = "SELECT * FROM quiz";

        $db_erg = mysqli_query( $lerntyp );

        echo '<table border="1">';
        while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
        {
            echo "<tr>";
            echo "<td>". $zeile['id_quiz'] . "</td>";
            echo "<td>". $zeile['Quiz'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        mysqli_free_result( $db_erg );
    }
}

