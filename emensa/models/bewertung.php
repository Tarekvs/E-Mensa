<?php

/**
 * Retrieve ratings for a specific dish based on its ID.
 *
 * @param int $id The dish's ID.
 * @return array The ratings related to the dish.
 */
function getratings($id)
{
    // Establish database connection
    $link = connectdb();
    // Set character set to UTF-8 for the connection
    $link->set_charset("utf8");

    // Define the SQL query to get ratings for the specific dish
    $sql = "SELECT bewertungs_id, benutzer, datum, bemerkung, bewertung, gericht_id FROM bewertungen
            WHERE gericht_id = '$id'
            ORDER BY datum DESC LIMIT 30";
    $result = mysqli_query($link, $sql);

    // Fetch all results in an array
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    // Close the database connection
    mysqli_close($link);

    return $data;
}

/**
 * Retrieve all ratings from the database.
 *
 * @return array The ratings.
 */
function getallratings()
{
    $link = connectdb();
    $link->set_charset("utf8");

    $sql = "SELECT bewertungen.bewertungs_id, gericht.name, bewertungen.benutzer, bewertungen.datum, bewertungen.bemerkung, bewertungen.bewertung, bewertungen.markiert
            FROM bewertungen
            INNER JOIN gericht ON bewertungen.gericht_id = gericht.id
            ORDER BY datum DESC
            LIMIT 30";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);

    return $data;
}

/**
 * Add a new rating to the database.
 *
 * @param string $benutzer The user's name.
 * @param string $bemerkung The user's comment about the dish.
 * @param int $bewertung The rating value.
 * @param int $gericht_id The dish's ID.
 */
function addrating($benutzer, $bemerkung, $bewertung, $gericht_id)
{
    $link = connectdb();
    $link->set_charset("utf8");

    // Escape user inputs for security
    $user = mysqli_real_escape_string($link, $benutzer);
    $comment = mysqli_real_escape_string($link, $bemerkung);
    $rating = mysqli_real_escape_string($link, $bewertung);
    $meal_id = mysqli_real_escape_string($link, $gericht_id);
    $date = date("Y") . "-" . date("m") . "-" . date("d");

    $sql = "INSERT INTO emensawerbeseite.bewertungen (benutzer, datum, bemerkung, bewertung, gericht_id)
            VALUES ('$user', '$date', '$comment', '$rating','$meal_id');";
    mysqli_query($link, $sql);
    mysqli_close($link);
}

/**
 * Delete a specific rating from the database.
 *
 * @param int $id The rating's ID.
 */
function deleterating($id)
{
    $link = connectdb();
    $link->set_charset("utf8");

    $sql = "DELETE
            FROM emensawerbeseite.bewertungen
            WHERE bewertungs_id = '$id';";
    mysqli_query($link, $sql);
    mysqli_close($link);
}

/**
 * Retrieve a specific rating based on its ID.
 *
 * @param int $id The rating's ID.
 * @return array The rating data.
 */
function getrating($id)
{
    $link = connectdb();
    $link->set_charset("utf8");

    $sql = "SELECT bewertungs_id, benutzer FROM bewertungen
            WHERE bewertungs_id = '$id';";
    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);

    return $data;
}

/**
 * Retrieve all ratings given by a specific user.
 *
 * @param string $name The user's name.
 * @return array The ratings given by the user.
 */
function myratings($name)
{
    $link = connectdb();
    $link->set_charset("utf8");

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

/**
 * Mark or unmark a rating.
 *
 * @param int $id The rating's ID.
 * @param bool $bool True to mark, false to unmark.
 */
function mark_rating($id, $bool)
{
    $markiert = $bool ? 1 : 0;
    $link = connectdb();
    $link->set_charset("utf8");

    $sql = "UPDATE bewertungen
            SET markiert = '$markiert'
            WHERE bewertungs_id = '$id'";
    mysqli_query($link, $sql);
    mysqli_close($link);
}

/**
 * Check if a user is an admin.
 *
 * @param string $name The user's name.
 * @return array User data with admin status.
 */
function isadmin($name)
{
    $link = connectdb();
    $link->set_charset("utf8");

    $sql = "SELECT name,admin
            FROM benutzer
            WHERE name = '$name'";

    $result = mysqli_query($link, $sql);

    $data = mysqli_fetch_all($result, MYSQLI_BOTH);
    mysqli_close($link);

    return $data;
}

/**
 * Retrieve all marked ratings.
 *
 * @return array The marked ratings.
 */
function markedratings()
{
    $link = connectdb();
    $link->set_charset("utf8");

    $sql = "SELECT bewertungen.bewertungs_id, gericht.name, bewertungen.benutzer, bewertungen.datum, bewertungen.bemerkung, bewertungen.bewertung
            FROM bewertungen
            INNER JOIN gericht ON bewertungen.gericht_id = gericht.id
