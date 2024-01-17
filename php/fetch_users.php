<?php
    require "db_connection.php";

    // Get the batch number from the AJAX request
    $batchNumber = isset($_GET['batch']) ? intval($_GET['batch']) : 0;

    // Number of users to fetch per batch
    $batchSize = 5;

    // Calculate the offset
    $offset = $batchNumber * $batchSize;

    // Fetch the users from the database
    // Replace this with your actual database query
    $query = "SELECT * FROM accounts ORDER BY username ASC LIMIT $offset, $batchSize";
    $result = mysqli_query($conn, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return the users as a JSON object
    echo json_encode($users);