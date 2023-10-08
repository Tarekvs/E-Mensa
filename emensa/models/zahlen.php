<?php

/**
 * Fetches the current visitor count, increments it by one, and updates the database.
 *
 * @return int Returns the updated visitor count.
 */
function besucherzahlen() {
    // Establish a connection to the database.
    $link = connectdb();
    $link->set_charset("utf8");

    // Fetch the current visitor count from the database.
    $sql = "select counter from zahlen"; 
    $result = mysqli_query($link, $sql);
    $counter = $result->fetch_assoc();
    $zaehler = $counter['counter'];

    // Increment the visitor count by one.
    $inkr = $zaehler + 1;

    // Update the new visitor count in the database.
    $sql = "UPDATE zahlen SET counter=$inkr WHERE counter=$zaehler;";
    mysqli_query($link, $sql);

    // Close the database connection.
    mysqli_close($link);

    // Return the updated visitor count.
    return $inkr;
}
