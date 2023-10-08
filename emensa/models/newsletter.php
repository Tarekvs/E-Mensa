<?php

/**
 * Fetches the total count of newsletter registrations.
 *
 * @return int Total number of registrations in the "newsletter" table.
 */
function newsletteranmeldungen() {
    // Connect to the database.
    $link = connectdb();

    // Set the character set to UTF-8 for the connection.
    $link->set_charset("utf8");

    // SQL query to count the number of rows in the "newsletter" table.
    $sql = "select COUNT(name) as number from newsletter";

    // Execute the query.
    $result = mysqli_query($link, $sql);

    // Fetch the result.
    $rows = mysqli_fetch_row($result);

    // Close the database connection.
    mysqli_close($link);

    // Return the count.
    return $rows[0];
}

/**
 * Inserts a new newsletter registration into the "newsletter" table.
 *
 * @param array $n_daten An associative array containing 'name' and 'email' of the registrant.
 */
function updatenewsletter($n_daten) {
    // Connect to the database.
    $link = connectdb();

    // Set the character set to UTF-8 for the connection.
    $link->set_charset("utf8");

    // Escape the user input to prevent SQL injection.
    $name = mysqli_real_escape_string($link, $n_daten['name']);
    $email = mysqli_real_escape_string($link, $n_daten['email']);

    // SQL query to insert the new registration into the "newsletter" table.
    $sql = "INSERT INTO newsletter VALUES('$name','$email')";

    // Execute the query.
    mysqli_query($link, $sql);

    // Close the database connection.
    mysqli_close($link);
}
