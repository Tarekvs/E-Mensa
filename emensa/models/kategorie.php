<?php
/**
 * This file contains all SQL statements related to the "kategorie" table.
 */

/**
 * Fetches all records from the "kategorie" table.
 *
 * @return array An array of records from the "kategorie" table.
 */
function db_kategorie_select_all() {
    // Connect to the database.
    $link = connectdb();

    // Set the character set to UTF-8 for the connection.
    $link ->set_charset("utf8");

    // SQL query to select all records from "kategorie".
    $sql = "SELECT * FROM kategorie";

    // Execute the query.
    $result = mysqli_query($link, $sql);

    // Fetch all the results as an associative array.
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    // Close the database connection.
    mysqli_close($link);

    // Return the fetched data.
    return $data;
}

/**
 * Fetches all records from the "kategorie" table in ascending order by name.
 *
 * @return array An array of records from the "kategorie" table sorted by name in ascending order.
 */
function db_kategorie_select_all_asc() {
    // Connect to the database.
    $link = connectdb();

    // Set the character set to UTF-8 for the connection.
    $link ->set_charset("utf8");

    // SQL query to select all records from "kategorie" and order them by "name" in ascending order.
    $sql = "SELECT * FROM kategorie ORDER BY name ASC";

    // Execute the query.
    $result = mysqli_query($link, $sql);

    // Fetch all the results as an associative array.
    $data = mysqli_fetch_all($result, MYSQLI_BOTH);

    // Close the database connection.
    mysqli_close($link);

    // Return the fetched data.
    return $data;
}
