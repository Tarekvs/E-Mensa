<?php


function newsletteranmeldungen()
{

    $link = connectdb();

    $link->set_charset("utf8");

    $sql = "select COUNT(name) as number from newsletter"; //Anzahl Zeilen aus der Tabelle newsletter abfragen
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_row($result);
    mysqli_close($link);
    return $rows[0];

}

function updatenewsletter($n_daten){

        $link = connectdb();

        $link->set_charset("utf8");

        $name = mysqli_real_escape_string($link, $n_daten['name']);
        $email = mysqli_real_escape_string($link, $n_daten['email']);

        $sql = "INSERT INTO newsletter VALUES('$name','$email')"; //SQL Befehl: Neue Zeile mit Name und E-Mail in der Tabelle "newsletter" hinzufügen
        mysqli_query($link, $sql); //Befehl ausführen
        mysqli_close($link);
}