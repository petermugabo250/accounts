<!DOCTYPE html>
<html>
<head>
    <title>Income Statement</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
<body>
    <div class="content" style="background-color:#4b81f5;">
        <h2>Income Statement</h2>
        <?php
        // Connect to the database
        require_once './includes/connection.php';

        // Prepare the SQL statement to fetch income and expense accounts from the Accounts table
        $sql = "SELECT account_id, account_name, account_type FROM Accounts 
                WHERE account_type = 'income' OR account_type = 'expense'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Initialize total revenues and total expenses
            $total_revenues = 0;
            $total_expenses = 0;

            // Display the table header
            echo '<table>';
            echo '<tr><th>Category</th><th>Amount</th></tr>';

            // Loop through the accounts and calculate the total revenues and total expenses
            while ($row = $result->fetch_assoc()) {
                $account_id = $row['account_id'];

                // Calculate the total debit and credit amounts for each account
                $sql_amounts = "SELECT SUM(debit_amount) as total_debit, SUM(credit_amount) as total_credit 
                                FROM JournalEntries
                                WHERE account_id = $account_id";

                $result_amounts = $conn->query($sql_amounts);
                $row_amounts = $result_amounts->fetch_assoc();

                $debit_amount = $row_amounts['total_debit'];
                $credit_amount = $row_amounts['total_credit'];

                // Calculate the account balance
                $balance = $debit_amount - $credit_amount;

                // Update total revenues or total expenses based on the account type
                if ($row['account_type'] == 'income') {
                    $total_revenues += $balance;
                } else {
                    $total_expenses += $balance;
                }

                // Display the account name and balance in the table
                echo '<tr>';
                echo '<td>' . $row['account_name'] . '</td>';
                echo '<td>' . number_format($balance, 2) . '</td>';
                echo '</tr>';
            }

            // Calculate net income or loss
            $net_income_loss = $total_revenues - $total_expenses;

            // Display the total revenues, total expenses, and net income or loss
            echo '<tr>';
            echo '<td><strong>Revenue:</strong></td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Sales Revenue</td>';
            echo '<td>' . number_format($total_revenues, 2) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Other Revenues</td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><strong>Total Revenue</strong></td>';
            echo '<td>' . number_format($total_revenues, 2) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><strong>Expenses:</strong></td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Cost of Goods Sold</td>';
            echo '<td>' . number_format($total_expenses, 2) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Gross Profit</td>';
            echo '<td>' . number_format($total_revenues - $total_expenses, 2) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Operating Expenses:</td>';
            echo '<td></td>';
            echo '</tr>';

            // Additional expense categories can be displayed here if needed

            echo '<tr>';
            echo '<td><strong>Total Operating Expenses</strong></td>';
            echo '<td>' . number_format($total_expenses, 2) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><strong>Operating Income (or Loss)</strong></td>';
            echo '<td>' . number_format($total_revenues - $total_expenses, 2) . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><strong>Other Income</strong></td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><strong>Other Expenses</strong></td>';
            echo '<td></td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td><strong>Net Income (or Loss)</strong></td>';
            echo '<td>' . number_format($net_income_loss, 2) . '</td>';
            echo '</tr>';

            echo '</table>';
        } else {
            echo 'No income or expense accounts found.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>