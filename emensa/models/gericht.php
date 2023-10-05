<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all() {
    try {
        $link = connectdb();

        $link ->set_charset("utf8");

        $sql = 'SELECT id, name, beschreibung FROM gericht ORDER BY name';
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }

}

function db_gericht_intprice_bigger2(){
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = 'SELECT name, preis_intern FROM gericht WHERE preis_intern > 2 ORDER BY name desc ';
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}

function db_gericht_tabelle()
{
    try {
        $link = connectdb();

        $link ->set_charset("utf8");

        $sql = "SELECT id,name,preis_intern,preis_extern,bildname,GROUP_CONCAT(code) AS 'allergene'
                FROM gericht
                LEFT OUTER JOIN gericht_hat_allergen gha on gericht.id = gha.gericht_id
                GROUP BY id
                ORDER BY name";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'error'=>true,
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }
}
function anzahl_gerichte(){

    $link = connectdb();
    $link ->set_charset("utf8");
    $sql = "select COUNT(name) as number from gericht"; //Anzahl Zeilen aus der Tabelle gericht abfragen
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_row($result);
    mysqli_close($link);
    return $rows[0];
}

function wunsch_gericht($name,$Gname,$Gbeschreibung)
{
$link = connectdb();

            $link->set_charset("utf8");

            $email = $_POST['email'];

            date_default_timezone_set('Europe/Berlin');
            $format = "y-m-d";
            $date = date($format, $_SERVER['REQUEST_TIME']);

            $name = mysqli_real_escape_string($link, $name);
            $Gname = mysqli_real_escape_string($link, $Gname);
            $Gbeschreibung = mysqli_real_escape_string($link, $Gbeschreibung);
            $date = mysqli_real_escape_string($link, $date);
            $email = mysqli_real_escape_string($link, $email);

            $sql_wunsch = "INSERT INTO `Wunschgericht` (`Name`,`E-Mail`,`Beschreibung`,`Erstellungsdatum`,`Ersteller`) VALUES('$Gname','$email','$Gbeschreibung','$date','$name');"; //SQL Befehl: Neue Zeile mit Name und E-Mail in der Tabelle "newsletter" hinzufügen
            mysqli_query($link, $sql_wunsch); //Befehl ausführen

            $sql_ersteller = "INSERT INTO `Ersteller` (`Name`,`E-Mail`) VALUES('$name','$email');";
            mysqli_query($link, $sql_ersteller); //Befehl ausführen
            mysqli_close($link);
}

function select_gericht_id($id)
{
    $link = connectdb();

    $link ->set_charset("utf8");

    $sql = "SELECT id,name,bildname
                FROM gericht
                WHERE id='$id'";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $data;
}
