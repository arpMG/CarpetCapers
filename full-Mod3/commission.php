<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commission | Carpet Capers</title>

    <link rel="stylesheet" href="style.css">


    <?php

    date_default_timezone_set ( "Australia/Melbourne" );

    include "classes/Commission.php";
    $commission = null;

    $search = [
        "name" => "",
        "month" => "",
        "year" => ""
    ];
    
    if (isset($_GET['submit'])) {
        
        $commission = new Commission("data/sales.csv");
        try {
            $search["name"] = filter_input(INPUT_GET, "salesperson", FILTER_SANITIZE_STRING);
            $search["month"] = filter_input(INPUT_GET, "month", FILTER_SANITIZE_NUMBER_INT);
            $search["year"] = filter_input(INPUT_GET, "year", FILTER_SANITIZE_NUMBER_INT);

            $commission->calculate($search);
        } catch (Exception $e) {
            echo $e;
        }
    }
    ?>
</head>

<body>
    <div class="container">
        <header class="logo">
            <h1>Carpet Capers</h1>
        </header>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php" class="active">Commission</a>
        </nav>
        <section class="input">
            <h2>Commission Search</h2>
            <form>
                <div class="row">
                    <!-- Validation COULD get a list of unique names in file and use them only -->
                    <label for="salesperson">Salesperson</label>
                    <input name="salesperson" type="text" required>
                </div>
                <div class="row">
                    <label for="month">Month</label>
                    <!-- <input name="month" type="number" min="1" max="12"> -->
                    <select name="month" id="month" required>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $dateObj   = DateTime::createFromFormat('!m', $i);
                            echo "<option value='$i'>" . $dateObj->format('F') . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <!-- Validation COULD get a list of unique years in the file and use them only -->
                    <label for="year">Year</label>
                    <input name="year" type="number" min="2010" max="<?php echo date('Y'); ?>" required>
                </div>

                <div class="row">
                    <button class="block" type="submit" name="submit">Get Commission</button>
                </div>
            </form>
        </section>
        <section class="output">
            <h2>Commission Amount</h2>
            <table class="tbl">
                <tr>
                    <th scope="row">Salesperson</th>
                    <td><?php if(!empty($search['name'])){echo $search['name'];} ?></td>
                </tr>
                <tr>
                    <th scope="row">Commission Period</th>
                    <td><?php
                        if(!empty($search['month'])){
                            $dateObj = DateTime::createFromFormat('!m', $search['month']);
                            echo $dateObj->format('F') . ", " . $search['year'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Total Sales</th>
                    <td class="num"><span class="currency">$</span><?php 
                        if(!empty($commission)){
                            echo number_format($commission->getTotalSales(), 2); 
                        }
                        ?></td>
                </tr>
                <tr>
                    <th scope="row">Commission Rate</th>
                    <td class="num"><?php 
                        if(!empty($commission)){
                            echo ($commission->getRate() * 100) . "%"; 
                        }?></td>
                </tr>
                <tr>
                    <th scope="row">Commission Amount</th>
                    <td class="num"><span class="currency">$</span><?php 
                        if(!empty($commission)){
                            echo number_format($commission->getCommission(), 2); 
                        }?></td>
                </tr>
            </table>
        </section>

    </div>

</body>

</html>