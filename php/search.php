<?php
require "db_connection.php";

$search = $_GET['search'];
$sql = "SELECT * FROM accounts WHERE username LIKE ? ORDER BY username ASC";
$stmt = $conn->prepare($sql);
$searchWithWildcards = '%' . $search . '%';
$stmt->bind_param('s', $searchWithWildcards);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($users);