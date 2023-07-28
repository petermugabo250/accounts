<!DOCTYPE html>
<html>

<head>
    <title>General Journal</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
   
    <div class="content"  style="background-color:#4b81f5;">
        <h2>View Journal</h2>

        <?php
        // Connect to the database
        require_once "includes/connection.php";

        // Fetch data from Transactions, JournalEntries, and Accounts tables
        $sql = "SELECT t.transaction_id, t.transaction_date, t.description, 
         j.account_id, j.debit_amount, j.credit_amount, a.account_name
  FROM Transactions t
  INNER JOIN JournalEntries j ON t.transaction_id = j.transaction_id
  INNER JOIN Accounts a ON j.account_id = a.account_id
  ORDER BY t.transaction_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display the general journal table
            echo '<table>';
            echo '<tr><th>Date</th><th>Description</th><th>Account</th><th>Debit</th><th>Credit</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['transaction_date'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['account_name'] . '</td>';
                echo '<td>' . ($row['debit_amount'] == "0.00" ? '' : number_format($row['debit_amount'], 2, '.', ',') ) . '</td>';
                echo '<td>' . ($row['credit_amount'] == "0.00" ? '' : number_format($row['credit_amount'], 2, '.', ',') ) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'Record transaction first.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>