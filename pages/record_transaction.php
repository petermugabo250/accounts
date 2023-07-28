<!DOCTYPE html>
<html>
 
<head>
    <title>Record Transaction</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>
 
<body>
    <div class="content">
        <h2>Record Transaction</h2>
        <form action="save_transaction.php" method="post">
            <label for="transaction_date">Transaction Date:</label>
            <input type="date" id="transaction_date" name="transaction_date" required>
 
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <div class="inputWraper">
                <h3>Journal Entries</h3>
                <div class="entry-container" id="entry-container">
                    <div class="entry-row">
                        <label for="account1">Account:</label>
                        <select id="account1" name="accounts[]" required>
                            <!-- Populate this select dropdown with account options from the "Accounts" table in the database -->
                            <?php include './includes/get_accounts.php'; ?>
                            <!-- Add more options for each account in the "Accounts" table -->
                        </select>
 
                        <label for="debit1">Debit:</label>
                        <input type="number" step="0.01" id="debit1" name="debits[]" required>
 
                        <label for="credit1">Credit:</label>
                        <input type="number" step="0.01" id="credit1" name="credits[]" required>
                    </div>
                </div>
            </div>
            <!-- Add more entry rows dynamically using JavaScript as needed -->
            <!-- <div class="inputWraper"> -->
 
            <input type="button" value="Add Entry Row" onclick="addEntryRow()">
 
            <input type="submit" value="Record Transaction">
            <!-- </div> -->
        </form>
    </div>
 
    <!-- Your existing HTML code -->
    <script>
        let entryCount = 1;
 
        function addEntryRow() {
            entryCount++;
 
            const entryRow = document.createElement('div');
            entryRow.classList.add('entry-row');
 
            // Use AJAX to fetch account options
            fetch('./includes/get_accounts_json.php')
                .then(response => response.json())
                .then(accounts => {
                    const selectHtml = accounts.map(account => `<option value="${account.id}">${account.name}</option>`).join('');
                    entryRow.innerHTML = `
                    <label for="account${entryCount}">Account:</label>
                    <select id="account${entryCount}" name="accounts[]" required>
                        <option value="">Select an account</option>
                        ${selectHtml}
                    </select>
 
                    <label for="debit${entryCount}">Debit:</label>
                    <input type="number" step="0.01" id="debit${entryCount}" name="debits[]" required>
 
                    <label for="credit${entryCount}">Credit:</label>
                    <input type="number" step="0.01" id="credit${entryCount}" name="credits[]" required>
 
                  <button type="button" class="remove-btn" onclick="removeEntryRow(this)">-</button>
                `;
 
                    const entryContainer = document.getElementById('entry-container');
                    entryContainer.appendChild(entryRow);
                })
                .catch(error => console.error('Error fetching accounts:', error));
        }
 
        function removeEntryRow(button) {
            const entryRow = button.parentNode;
            const entryContainer = document.getElementById('entry-container');
            entryContainer.removeChild(entryRow);
        }
    </script>
 
</body>
 
</html>