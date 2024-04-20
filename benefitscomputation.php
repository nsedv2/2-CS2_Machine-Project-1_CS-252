<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Benefits Program</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #2980b9;
        }

        h1 {
            text-align: center;
            color: #2980b9;
        }

        .results {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            border: 2px solid #2980b9; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>NSED Co. Employee Benefits Program</h1>
        
        <?php
        // ======================
        // Machine Problem # 2
        // Project Name - Employee Benefits Program
        // Project Description - Calculates and displays factors such as annual gross pay, age, health coverage, disability coverage, and life insurance units to compute deductions
        //                       including health insurance, disability insurance, life insurance, taxes, and retirement plan costs, 
        //                       based on input parameters provided through the URL query string.
        // Programmer - Marcuz Baldovino
        //            - Drexcel Quinia
        //            - Khalel Japa
        // Language - PHP
        // Date Created - April 20, 2024
        // Date Modified - April 20, 2024
        // ======================

        // Retrieve form inputs from the URL
        $annualGrossPay = isset($_GET['annual_gross_pay']) ? $_GET['annual_gross_pay'] : '';
        $age = isset($_GET['age']) ? $_GET['age'] : '';
        $healthCoverage = isset($_GET['health_coverage']) ? $_GET['health_coverage'] : 'Self only';
        $disabilityCoverage = isset($_GET['disability_coverage']) ? $_GET['disability_coverage'] : 'No';
        $lifeInsuranceUnits = isset($_GET['life_insurance_units']) ? $_GET['life_insurance_units'] : '';

        if ($annualGrossPay !== '' && $age !== '' && $lifeInsuranceUnits !== '') {
            // Constants for benefit costs
            $HEALTH_COVERAGE_SELF_ONLY = 1500.00;
            $HEALTH_COVERAGE_FAMILY = 2750.00;
            $DISABILITY_COVERAGE_PERCENTAGE = 1.2;
            $LIFE_INSURANCE_BASE_COST_PER_UNIT = 25.00;
            $LIFE_INSURANCE_COST_PER_YEAR_OVER_25 = 0.95;
            $TAX_RATE_UNDER_42K = 0.18;
            $TAX_RATE_OVER_42K = 0.28;
            $RETIREMENT_PLAN_COST_PERCENTAGE = 0.055;

            // Calculate deductions
            $healthInsuranceCost = ($healthCoverage == "Self only") ? $HEALTH_COVERAGE_SELF_ONLY : $HEALTH_COVERAGE_FAMILY;
            $disabilityInsuranceCost = ($disabilityCoverage == "Yes") ? ($annualGrossPay * $DISABILITY_COVERAGE_PERCENTAGE / 100.0) : 0.0;

            if ($healthCoverage == "Family") {
                $lifeInsuranceCost = $lifeInsuranceUnits * ($LIFE_INSURANCE_BASE_COST_PER_UNIT + $LIFE_INSURANCE_COST_PER_YEAR_OVER_25 * ($age - 25));
            } else {
                $lifeInsuranceCost = $lifeInsuranceUnits * ($LIFE_INSURANCE_BASE_COST_PER_UNIT + $LIFE_INSURANCE_COST_PER_YEAR_OVER_25 * ($age > 25));
            }

            $taxes = ($annualGrossPay <= 42000) ? ($annualGrossPay * $TAX_RATE_UNDER_42K) : ($annualGrossPay * $TAX_RATE_OVER_42K);
            $retirementPlanCost = $annualGrossPay * $RETIREMENT_PLAN_COST_PERCENTAGE;

            // Calculate total deductions
            $totalDeductions = $healthInsuranceCost + $disabilityInsuranceCost + $lifeInsuranceCost + $taxes + $retirementPlanCost;

            // Calculate net pay
            $netPay = $annualGrossPay - $totalDeductions;

            // Monthly calculations
            $monthlyGrossPay = $annualGrossPay / 12;
            $monthlyDeductions = $totalDeductions / 12;
            $monthlyNetPay = $netPay / 12;

            // Output in a table
            echo "<div class='results'>";
            echo "<table>";
            echo "<tr><td colspan='3'></td></tr>";
            echo "<tr><th></th><th>Annual</th><th>Monthly</th></tr>";
            echo "<tr><td class='bold'>Deductions:</td><td></td><td></td></tr>";
            echo "<tr><td>Health Insurance:</td><td>$" . number_format($healthInsuranceCost, 2) . "</td><td>$" . number_format($healthInsuranceCost / 12, 2) . "</td></tr>";
            echo "<tr><td>Disability Insurance:</td><td>$" . number_format($disabilityInsuranceCost, 2) . "</td><td>$" . number_format($disabilityInsuranceCost / 12, 2) . "</td></tr>";
            echo "<tr><td>Life Insurance:</td><td>$" . number_format($lifeInsuranceCost, 2) . "</td><td>$" . number_format($lifeInsuranceCost / 12, 2) . "</td></tr>";
            echo "<tr><td>Taxes:</td><td>$" . number_format($taxes, 2) . "</td><td>$" . number_format($taxes / 12, 2) . "</td></tr>";
            echo "<tr><td>Retirement:</td><td>$" . number_format($retirementPlanCost, 2) . "</td><td>$" . number_format($retirementPlanCost / 12, 2) . "</td></tr>";
            echo "<tr><td>Gross Pay:</td><td>$" . number_format($annualGrossPay, 2) . "</td><td>$" . number_format($monthlyGrossPay, 2) . "</td></tr>";
            echo "<tr><td>Total Deductions:</td><td>$" . number_format($totalDeductions, 2) . "</td><td>$" . number_format($monthlyDeductions, 2) . "</td></tr>";
            echo "<tr><td class='bold'>Net Pay:</td><td>$" . number_format($netPay, 2) . "</td><td>$" . number_format($monthlyNetPay, 2) . "</td></tr>";
            echo "</table>";
            echo "</div>";            
        } else {
            echo "<p>Please provide all required parameters.</p>";
        }
        ?>
    </div>
</body>
</html>





