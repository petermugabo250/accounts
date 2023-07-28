<!DOCTYPE html>
<html>

<head>
    <title>Add New Account</title>
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body>
    <div class="content"  style="background-color:#4b81f5;">
        <h2>Add Account</h2>
        <form action="create_account.php" method="post">
            <label for="account_name">Name:</label>
            <input type="text" id="account_name" name="account_name" required>

            <label for="account_type">Type:</label>
            <select id="account_type" name="account_type" required>
                <option value="asset">Asset</option>
                <option value="expense">Expense</option>
                <option value="equity">Equity</option>
                <option value="liability">Liability</option>
                <option value="income">Income</option>
                <option value="income">Revenue</option>
            </select>

            <input type="submit" value="Add" style="background-color:black;">
        </form>
    </div>
</body>

</html>