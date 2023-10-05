<?php
function getratings($id)
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = "SELECT bewertungs_id, benutzer, datum, bemerkung, bewertung, gericht_id FROM bewertungen
            WHERE gericht_id = '$id'
            ORDER BY datum DESC LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function getallratings()
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = $sql = "SELECT bewertungen.bewertungs_id, gericht.name, bewertungen.benutzer, bewertungen.datum, bewertungen.bemerkung, bewertungen.bewertung, bewertungen.markiert
            FROM bewertungen
            INNER JOIN gericht ON bewertungen.gericht_id = gericht.id
            ORDER BY datum DESC
            LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function addrating($benutzer, $bemerkung, $bewertung, $gericht_id)
{
    $link = connectdb();

    $link->set_charset("utf8");

    $user = mysqli_real_escape_string($link, $benutzer);
    $comment = mysqli_real_escape_string($link, $bemerkung);
    $rating = mysqli_real_escape_string($link, $bewertung);
    $meal_id = mysqli_real_escape_string($link, $gericht_id);
    $date = date("Y")."-".date("m")."-".date("d");

    $sql = "INSERT INTO emensawerbeseite.bewertungen (benutzer, datum, bemerkung, bewertung, gericht_id)
            VALUES ('$user', '$date', '$comment', '$rating','$meal_id');";
    mysqli_query($link, $sql); //Befehl ausführen
    mysqli_close($link);
}

function deleterating($id)
{
    $link = connectdb();

    $link->set_charset("utf8");

    $sql = "DELETE
            FROM emensawerbeseite.bewertungen
            WHERE bewertungs_id = '$id';";
    mysqli_query($link, $sql); //Befehl ausführen
    mysqli_close($link);
}

function getrating($id)
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = "SELECT bewertungs_id, benutzer FROM bewertungen
            WHERE bewertungs_id = '$id';";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function myratings($name)
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = "SELECT bewertungen.bewertungs_id, gericht.name, bewertungen.benutzer, bewertungen.datum, bewertungen.bemerkung, bewertungen.bewertung
            FROM bewertungen
            INNER JOIN gericht ON bewertungen.gericht_id = gericht.id
            WHERE benutzer = '$name'
            ORDER BY datum DESC";

    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function mark_rating($id,$bool)
{
    $markiert = 0;

    if ($bool)
    {
        $markiert = 1;
    }
    else
    {
        $markiert = 0;
    }
    $link = connectdb();

    $link->set_charset("utf8");

    $sql = "UPDATE bewertungen
            SET markiert = '$markiert'
            WHERE bewertungs_id = '$id'";
    mysqli_query($link, $sql); //Befehl ausführen
    mysqli_close($link);
}

function isadmin($name)
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = "SELECT name,admin
            FROM benutzer
            WHERE name = '$name'";

    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function markedratings()
{
$link = connectdb();

    $link ->set_charset("utf8");

    $sql ="SELECT bewertungen.bewertungs_id, gericht.name, bewertungen.benutzer, bewertungen.datum, bewertungen.bemerkung, bewertungen.bewertung
            FROM bewertungen
            INNER JOIN gericht ON bewertungen.gericht_id = gericht.id
            WHERE markiert = true
            ORDER BY datum DESC";


    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}