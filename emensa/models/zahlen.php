<?php

function besucherzahlen(){

 $link = connectdb();

        $link ->set_charset("utf8");

     $sql = "select counter from zahlen"; //Aktueller Stand abfragen
            $result = mysqli_query($link, $sql);
                            $counter = $result->fetch_assoc();
                            $zaehler = $counter['counter'];
                            $inkr = $zaehler + 1; //Zähler um eins erhöhen

                            $sql = "UPDATE zahlen SET counter=$inkr WHERE counter=$zaehler;"; //Neuen Wert in Datenbank schreiben

                            mysqli_query($link, $sql);


        mysqli_close($link);
        return $inkr;

}
