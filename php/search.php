<?php
require "db_connection.php";

$search = $_GET['search'];

$sql = "SELECT * FROM accounts WHERE username LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchParam);
$searchParam = "%$search%";
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo '<a href="profile.php?id=' . $row['id'] . '">' . $row['username'] . '</a><br>';
}