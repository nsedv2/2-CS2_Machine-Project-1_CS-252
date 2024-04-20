<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Savings Interest Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        h1, h2 {
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #4caf50;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Savings Account Interest Calculator</h1>

        <?php
            // ======================
            // Machine Problem # 1
            // Project Name - Savings Interest Tracker
            // Project Description - calculates and displays the yearly interest earned and balance of a savings account based on provided initial balance,
            //                       interest rate, initial year, and final year, using sanitized input parameters retrieved from the URL query string.
            // Programmer - Marcuz Baldovino
            //            - Drexcel Quinia
            //            - Khalel Japa
            // Language - PHP
            // Date Created - April 20, 2024
            // Date Modified - April 20, 2024
            // ======================

            function sanitize_input($data) {
                return htmlspecialchars(stripslashes(trim($data)));
            }

            // Collect and sanitize input from the URL query string
            $initialBalance = isset($_GET['initialBalance']) ? floatval(sanitize_input($_GET['initialBalance'])) : 0;
            $interestRate = isset($_GET['interestRate']) ? floatval(sanitize_input($_GET['interestRate'])) : 0;
            $initialYear = isset($_GET['initialYear']) ? intval(sanitize_input($_GET['initialYear'])) : 0;
            $finalYear = isset($_GET['finalYear']) ? intval(sanitize_input($_GET['finalYear'])) : 0;

            if ($interestRate > 1) {
                $interestRate /= 100;
            }

            // Header
            echo "<h2>Yearly Account Summary</h2>";
            echo "<table>";
            echo "<tr><th>Year</th><th>Interest</th><th>Balance</th></tr>";

            // Initial year output with no interest
            echo "<tr><td>$initialYear</td><td>Php 0.00</td><td>Php " . number_format($initialBalance, 2) . "</td></tr>";

            // Calculate and display the interest and balance for each subsequent year
            $currentBalance = $initialBalance;
            for ($year = $initialYear + 1; $year <= $finalYear; $year++) {
                $interestEarned = $currentBalance * $interestRate; // Calculate interest
                $currentBalance += $interestEarned; // Update balance

                // Display year, interest earned, and new balance in table rows
                echo "<tr><td>$year</td><td>Php " . number_format($interestEarned, 2) . "</td><td>Php " . number_format($currentBalance, 2) . "</td></tr>";
            }
            echo "</table>";
        ?>
    </div>
</body>
</html>
