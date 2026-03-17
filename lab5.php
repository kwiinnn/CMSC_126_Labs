<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Government Payroll Deductions Calculator</title>


  <style>
    /* Dark, apple, minimalist-themed CSS style */

    @import url('https://fonts.cdnfonts.com/css/sf-pro-display');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'SF Pro Display', -apple-system, system-ui, sans-serif;
      background: #f5f5f7;
      color: #1d1d1f;
      min-height: 100vh;
      padding: 40px 20px;
    }

    @media (prefers-color-scheme: dark) {
      body {
        background: #000000;
        color: #f5f5f7;
      }
    }

    .container {
      max-width: 650px;
      margin: 0 auto;
      background: #ffffff;
      padding: 48px;
      border-radius: 18px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
      border: 1px solid #e5e5e7;
    }

    @media (prefers-color-scheme: dark) {
      .container {
        background: #1d1d1f;
        border-color: #424245;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
      }
    }

    h2 {
      text-align: center;
      color: #1d1d1f;
      margin-bottom: 32px;
      font-size: 32px;
      font-weight: 700;
      letter-spacing: -0.5px;
      line-height: 1.2;
    }

    @media (prefers-color-scheme: dark) {
      h2 {
        color: #f5f5f7;
      }
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 24px;
      margin-bottom: 48px;
    }

    label {
      font-weight: 500;
      color: #1d1d1f;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    @media (prefers-color-scheme: dark) {
      label {
        color: #a1a1a6;
      }
    }

    input[type="number"] {
      padding: 12px 16px;
      font-size: 16px;
      border: 1px solid #d2d2d7;
      border-radius: 10px;
      background: #ffffff;
      color: #1d1d1f;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-family: inherit;
    }

    @media (prefers-color-scheme: dark) {
      input[type="number"] {
        background: #424245;
        border-color: #424245;
        color: #f5f5f7;
      }
    }

    input[type="number"]:focus {
      outline: none;
      border-color: #0071e3;
      box-shadow: 0 0 0 3px rgba(0, 113, 227, 0.1);
    }

    @media (prefers-color-scheme: dark) {
      input[type="number"]:focus {
        box-shadow: 0 0 0 3px rgba(0, 113, 227, 0.25);
      }
    }

    button {
      padding: 12px;
      background: #0071e3;
      color: #ffffff;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      font-family: inherit;
    }

    button:hover {
      background: #0077ed;
    }

    button:active {
      background: #0066cc;
    }

    button:disabled {
      background: #d2d2d7;
      cursor: not-allowed;
    }

    .results-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 32px;
      font-size: 15px;
    }

    .results-table th,
    .results-table td {
      padding: 12px 16px;
      border: none;
      border-bottom: 1px solid #e5e5e7;
      text-align: left;
    }

    @media (prefers-color-scheme: dark) {

      .results-table th,
      .results-table td {
        border-bottom-color: #424245;
      }
    }

    .results-table th {
      background: #f5f5f7;
      color: #1d1d1f;
      font-weight: 600;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
    }

    @media (prefers-color-scheme: dark) {
      .results-table th {
        background: #1d1d1f;
        color: #a1a1a6;
      }
    }

    .results-table tr:last-child th,
    .results-table tr:last-child td {
      border-bottom: none;
    }

    .section-title {
      background: #f5f5f7;
      font-weight: 600;
      color: #1d1d1f;
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.8px;
    }

    @media (prefers-color-scheme: dark) {
      .section-title {
        background: #1d1d1f;
        color: #a1a1a6;
      }
    }

    .error {
      color: #d70015;
      font-weight: 500;
      text-align: center;
      background: #fef2f2;
      padding: 16px;
      border-radius: 10px;
      margin-top: 20px;
      font-size: 15px;
    }

    @media (prefers-color-scheme: dark) {
      .error {
        background: rgba(215, 0, 21, 0.1);
        color: #ff453a;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Payroll Calculator</h2>
    <form method="POST" action="">
      <label for="salary">Enter Monthly Salary (₱):</label>
      <input type="number" id="salary" name="salary" step="1" required>
      <button type="submit">Compute Deductions</button>
    </form>

    <?php
    // The PHP code receives the inputted value upon form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form was submitted
    
      // Retrieve the salary from the POST request
      $salaryInput = $_POST['salary'];

      // Validate that the value is numeric and positive
      if (is_numeric($salaryInput) && $salaryInput > 0) {

        // Assign the valid input to a monthly salary variable
        $monthlySalary = (float) $salaryInput;

        // FUNCTION DEFINITIONS
    
        // Function to compute GSIS deduction
        function computeGSIS($salary)
        {
          return $salary * 0.09; // GSIS deduction = 9% of salary
        } // End computeGSIS function
    
        // Function to compute Pag-IBIG deduction
        function computePagIBIG($salary)
        {
          $deduction = $salary * 0.02; // Pag-IBIG deduction = 2% of salary
          if ($deduction > 100) { // Check if deduction exceeds the cap
            return 100.00; // Cap at max of ₱100/mo
          } // End if condition
          return $deduction; // Return calculated deduction if under 100
        } // End computePagIBIG function
    
        // Function to compute PhilHealth deduction
        function computePhilHealth($salary)
        {
          $salaryBase = $salary; // Initialize salary base with actual salary
          if ($salaryBase < 10000) { // If salary is less than P10,000
            $salaryBase = 10000; // Salary base used is P10,000
          } elseif ($salaryBase > 100000) { // If salary exceeds P100,000 limit
            $salaryBase = 100000; // Cap salary base at P100,000
          } // End if-elseif block
          return $salaryBase * 0.025; // PhilHealth deduction is 2.5% of salary base
        } // End computePhilHealth function
    
        // Function to compute Income Tax using the TRAIN Law table
        function computeIncomeTax($netTaxableIncome)
        {
          if ($netTaxableIncome <= 250000) { // ₱250,000 and below tier
            return 0; // 0% tax
          } elseif ($netTaxableIncome <= 400000) { // Over ₱250,000 – ₱400,000 tier
            return ($netTaxableIncome - 250000) * 0.15; // 15% of excess over ₱250,000
          } elseif ($netTaxableIncome <= 800000) { // Over ₱400,000 – ₱800,000 tier
            return 22500 + ($netTaxableIncome - 400000) * 0.20; // ₱22,500 + 20% of excess
          } elseif ($netTaxableIncome <= 2000000) { // Over ₱800,000 – ₱2,000,000 tier
            return 102500 + ($netTaxableIncome - 800000) * 0.25; // ₱102,500 + 25% of excess
          } elseif ($netTaxableIncome <= 8000000) { // Over ₱2,000,000 – ₱8,000,000 tier
            return 402500 + ($netTaxableIncome - 2000000) * 0.30; // ₱402,500 + 30% of excess
          } else { // Over ₱8,000,000 tier
            return 2202500 + ($netTaxableIncome - 8000000) * 0.35; // ₱2,202,500 + 35% of excess
          } // End if-else tax tiers
        } // End computeIncomeTax function
    
        // Monthly computations
        $gsis = computeGSIS($monthlySalary); // Calculate monthly GSIS deduction
        $pagibig = computePagIBIG($monthlySalary); // Calculate monthly Pag-IBIG deduction
        $philhealth = computePhilHealth($monthlySalary); // Calculate monthly PhilHealth deduction
        $totalMonthlyDeductions = $gsis + $pagibig + $philhealth; // Total Deductions = GSIS + Pag-IBIG + PhilHealth
        $monthlyTakeHome = $monthlySalary - $totalMonthlyDeductions; // Monthly Take home Pay = Monthly Salary − Total Deductions
    
        // Annual computations
        $annualSalary = $monthlySalary * 12; // Annual Salary = Monthly Salary × 12
        $annualGSIS = $gsis * 12; // Calculate annual GSIS deduction
        $annualPagIBIG = $pagibig * 12; // Calculate annual Pag-IBIG deduction
        $annualPhilHealth = $philhealth * 12; // Calculate annual PhilHealth deduction
        $totalAnnualDeductions = $annualGSIS + $annualPhilHealth + $annualPagIBIG; // Total deductions = GSIS*12 + PhilHealth*12 + Pag-ibig*12
    
        // Bonuses computations
        $thirteenthMonth = $monthlySalary; // 13th month pay equivalent to 1 Month Salary
        $bonus = $monthlySalary; // Bonus equivalent to 1 Month Salary
        $totalBonuses = $thirteenthMonth + $bonus; // Total bonus = 13th month pay + bonus
    
        // Function to compute the Taxable Bonus
        function computeTaxableBonus($totalBonuses)
        {
          if ($totalBonuses > 90000) { // Check if Total Bonus exceeds the ₱90,000 exemption
            return $totalBonuses - 90000; // Return the excess amount as taxable
          } // End if condition
          return 0; // Return 0 if the total bonus is ₱90,000 or less
        } // End computeTaxableBonus function
    
        // Taxable bonus computation
        $taxableBonus = computeTaxableBonus($totalBonuses); // Call function to get taxable bonus
    
        // Gross Annual Income computation
        $grossAnnualIncome = $annualSalary; // Gross Annual Income = Annual Salary
    
        // Net Taxable Income computation
        $netTaxableIncome = $grossAnnualIncome + $taxableBonus - $totalAnnualDeductions; // nti = gai + tbi – total deductions
    
        // Income Tax Payable computation
        $incomeTaxPayable = computeIncomeTax($netTaxableIncome); // Pass taxable income to tax function
    
        // DISPLAY RESULTS
        // Format numbers to 2 decimal places using number_format for clean output
        echo "<table class='results-table'>";

        // Display Monthly Data
        echo "<tr><td colspan='2' class='section-title'>Monthly Summary</td></tr>";
        echo "<tr><td>Monthly Salary</td><td>₱ " . number_format($monthlySalary, 2) . "</td></tr>";
        echo "<tr><td>GSIS Deduction</td><td>₱ " . number_format($gsis, 2) . "</td></tr>";
        echo "<tr><td>Pag-IBIG Deduction</td><td>₱ " . number_format($pagibig, 2) . "</td></tr>";
        echo "<tr><td>PhilHealth Deduction</td><td>₱ " . number_format($philhealth, 2) . "</td></tr>";
        echo "<tr><td><strong>Total Monthly Deductions</strong></td><td><strong>₱ " . number_format($totalMonthlyDeductions, 2) . "</strong></td></tr>";
        echo "<tr><td><strong>Net Monthly Pay</strong></td><td><strong>₱ " . number_format($monthlyTakeHome, 2) . "</strong></td></tr>";

        // Display Annual Data & Bonuses
        echo "<tr><td colspan='2' class='section-title'>Annual Summary & Bonuses</td></tr>";
        echo "<tr><td>Yearly Salary</td><td>₱ " . number_format($annualSalary, 2) . "</td></tr>";
        echo "<tr><td>13th Month Pay</td><td>₱ " . number_format($thirteenthMonth, 2) . "</td></tr>";
        echo "<tr><td>Regular Bonus</td><td>₱ " . number_format($bonus, 2) . "</td></tr>";
        echo "<tr><td><strong>Total Bonuses</strong></td><td><strong>₱ " . number_format($totalBonuses, 2) . "</strong></td></tr>";

        // Display Tax Computation
        echo "<tr><td colspan='2' class='section-title'>Tax Computation</td></tr>";
        echo "<tr><td>Taxable Bonus Portion</td><td>₱ " . number_format($taxableBonus, 2) . "</td></tr>";
        echo "<tr><td>Total Annual Deductions</td><td>₱ " . number_format($totalAnnualDeductions, 2) . "</td></tr>";
        echo "<tr><td><strong>Annual Taxable Income</strong></td><td><strong>₱ " . number_format($netTaxableIncome, 2) . "</strong></td></tr>";
        echo "<tr><td><strong>Income Tax Payable</strong></td><td><strong>₱ " . number_format($incomeTaxPayable, 2) . "</strong></td></tr>";

        echo "</table>";

      } else { // Handle invalid input
        // Display error message if validation fails
        echo "<p class='error'>Error: Please enter a valid, positive numeric salary.</p>"; // Validates that value is numeric and positive
      } // End validation block
    } // End POST check
    ?>
  </div>

</body>

</html>