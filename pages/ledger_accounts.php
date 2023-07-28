<!DOCTYPE html>
<html>

<head>
    <title>Ledger Account Details</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>

    <div class="content"  style="background-color:#4b81f5;">
        <h2>View Ledger</h2>

        <?php
        // Connect to the database
        require_once './includes/connection.php';

        // Fetch all unique account IDs and names from the Accounts table
        $sql_accounts = "SELECT account_id, account_name, account_type FROM Accounts";
        $result_accounts = $conn->query($sql_accounts);

        if ($result_accounts->num_rows > 0) {
            // Loop through each account and display its ledger details in a separate table
            while ($row_account = $result_accounts->fetch_assoc()) {
                $account_id = $row_account['account_id'];
                $account_name = $row_account['account_name'];
                $account_type = $row_account['account_type'];

                // Determine whether to show Dr (Debit) side or Cr (Credit) side based on the account type
                $is_debit_account = ($account_type === 'asset' || $account_type === 'expense') ? true : false;

                // Prepare the SQL statement to fetch transactions for the specified account
                $sql = "SELECT t.transaction_date, t.description, j.debit_amount, j.credit_amount
                        FROM Transactions t
                        INNER JOIN JournalEntries j ON t.transaction_id = j.transaction_id
                        WHERE j.account_id = $account_id
                        ORDER BY t.transaction_date";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display the ledger account details in a table
                    echo '<h3>' . $account_name . ' (' . strtoupper($account_type) . ')</h3>';
                    echo '<table>';
                    echo '<tr><th>Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>';

                    $balance = 0;

                    while ($row = $result->fetch_assoc()) {
                        $debit_amount = $row['debit_amount'];
                        $credit_amount = $row['credit_amount'];
                        $balance += ($is_debit_account ? ($debit_amount - $credit_amount) : ($credit_amount - $debit_amount));

                        echo '<tr>';
                        echo '<td>' . $row['transaction_date'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td>' . ($debit_amount > 0 ? number_format($debit_amount, 2, '.', ',') : '') . '</td>';
                        echo '<td>' . ($credit_amount > 0 ? number_format($credit_amount, 2, '.', ',') : '') . '</td>';
                        echo '<td>' . number_format($balance, 2, '.', ',') . '</td>';
                        echo '</tr>';
                    }

                    // Display the final balance on the Dr (Debit) or Cr (Credit) side
                    echo '<tr>';
                    echo '<td colspan="2" align="right"><strong>Total ' . ($is_debit_account ? 'Debit' : 'Credit') . '</strong></td>';
                    echo '<td>' . ($is_debit_account ? number_format($balance, 2, '.', ',') : '') . '</td>';
                    echo '<td>' . (!$is_debit_account ? number_format($balance, 2, '.', ',') : '') . '</td>';
                    echo '<td></td>';
                    echo '</tr>';

                    echo '</table>';
                } 
                else {
                    echo 'Please record first';
                }
            }
        } 
        else {
            echo '<p>No accounts found.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>