<!DOCTYPE html>
<html>

<head>
    <title>Ledger Account Details</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
    <?php include './includes/sidebar.php'; ?>
    <?php include './includes/topnav.php'; ?>

    <div class="content">
        <h2>Ledger Account</h2>

        <?php
        // Connect to the database
        require_once './includes/connection.php';
        // Get the account ID from the URL parameter (replace 'account_id' with the actual parameter name)
        $account_id = $_GET['account_id'];

        // Prepare the SQL statement to fetch transactions for the specified account
        $sql = "SELECT t.transaction_date, t.description, j.debit_amount, j.credit_amount
                FROM Transactions t
                INNER JOIN JournalEntries j ON t.transaction_id = j.transaction_id
                WHERE j.account_id = $account_id
                ORDER BY t.transaction_date";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display the ledger account details in a T-shaped format
            echo '<table>';
            echo '<tr><th>Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>';

            $balance = 0;

            while ($row = $result->fetch_assoc()) {
                $debit_amount = $row['debit_amount'];
                $credit_amount = $row['credit_amount'];
                $balance += ($debit_amount - $credit_amount);

                echo '<tr>';
                echo '<td>' . $row['transaction_date'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . ($debit_amount > 0 ? $debit_amount : '') . '</td>';
                echo '<td>' . ($credit_amount > 0 ? $credit_amount : '') . '</td>';
                echo '<td>' . $balance . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No transactions found for this account.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>