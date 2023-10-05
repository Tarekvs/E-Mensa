<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "kategorie"
 */
function db_kategorie_select_all() {
    $link = connectdb();
    $link ->set_charset("utf8");

    $sql = "SELECT * FROM kategorie";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}

function db_kategorie_select_all_asc()
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = "SELECT * FROM kategorie ORDER BY name ASC";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);
    return $data;
}