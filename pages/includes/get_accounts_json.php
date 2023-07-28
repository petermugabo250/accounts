<?php
// Connect to the database (replace with your database credentials)

require_once "connection.php";

// Prepare the SQL statement to fetch account options from the Accounts table
$sql = "SELECT account_id, account_name FROM Accounts";
$result = $conn->query($sql);

$accounts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $accounts[] = array(
            'id' => $row['account_id'],
            'name' => $row['account_name']
        );
    }
}

// Close the database connection
$conn->close();

// Send the account options as JSON data
echo json_encode($accounts);
?>