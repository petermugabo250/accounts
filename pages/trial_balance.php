<!DOCTYPE html>
<html>

<head>
    <title>Trial Balance</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>

    <div class="content">
        <h2>View Trial Balance</h2>

        <?php
        // Connect to the database
        require_once './includes/connection.php';

        // Fetch account balances from the Accounts table
        $sql = "SELECT account_id, account_name FROM Accounts";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Initialize total debit and credit balances
            $total_debit = 0;
            $total_credit = 0;

            // Display the trial balance table
            echo '<table>';
            echo '<tr><th>Account</th><th>Debit</th><th>Credit</th></tr>';

            while ($row = $result->fetch_assoc()) {
                $account_id = $row['account_id'];
                $account_name = $row['account_name'];

                // Calculate the total debit and credit amounts for each account
                $sql_amounts = "SELECT SUM(debit_amount) as total_debit, SUM(credit_amount) as total_credit 
                                FROM JournalEntries
                                WHERE account_id = $account_id";

                $result_amounts = $conn->query($sql_amounts);
                $row_amounts = $result_amounts->fetch_assoc();

                $debit_amount = $row_amounts['total_debit'];
                $credit_amount = $row_amounts['total_credit'];

                // Calculate the balance for each account
                $balance = $debit_amount - $credit_amount;
                
                // 0 balance accounts are not displayed
                if ($balance == 0) {
                    continue;
                }

                // Update the total debit and credit balances
                if ($balance > 0) {
                    $total_debit += $balance;
                } elseif ($balance < 0) {
                    $total_credit += $balance;
                }

                echo '<tr>';
                echo '<td>' . $account_name . '</td>';
                echo '<td>' . ($balance == 0 ? '' : ($balance > 0 ? number_format($balance, 2, '.', ',') : '')) . '</td>';
                echo '<td>' . ($balance == 0 ? '' : ($balance < 0 ? number_format(abs($balance), 2, '.', ',') : '')) . '</td>';
        
                echo '</tr>';
            }

            // Display the total debit and credit balances in the last row
            echo '<tr>';
            echo '<td><strong>Total</strong></td>';
            echo '<td>' . number_format($total_debit, 2, '.', ',') . '</td>';
            echo '<td>' . number_format(abs($total_credit), 2, '.', ',') . '</td>';
            echo '</tr>';

            echo '</table>';
        } else {
            echo 'No accounts found.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>

</html>