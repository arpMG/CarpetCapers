<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpet Capers - Quote</title>

    <?php
        include_once 'classes/CarpetCalc.php';
        if(isset($_GET['submit'])){

            $calculation = new CarpetCalc();
            $calculation->addRooms($_GET['width'], $_GET['length']);
            $calculation->calcCosts($_GET['quality'], $_GET['discount']);
        

        }else{
            //SHouldn;t be here, take them back to index
            header("Location: index.php");
            exit();
        }
        
    ?>
    <style>
        table, th, td{
            border: thin black solid;
            border-collapse: collapse;
            width: 300px;
        }
    </style>
</head>
<body>
    <h1>Carpet Capers - Quotation</h1>
    <pre>
        <?php
            //just dump the inputs - what do we have?
            // print_r($_GET);
            print_r($_GET['width']);
            // print_r($calculation);
        ?>
    </pre>
    <table>
        <tr>
            <th scope="row">Number of Rooms</th>
            <td><?php echo $calculation->numRooms(); ?></td>
        </tr>
        <tr>
            <th scope="row">Total Area (m<sup>2</sup>)</th>
            <td><?php echo $calculation->totalArea;; ?></td>
        </tr>
        <tr>
            <th scope="row">Wastage</th>
            <td><?php echo ($calculation::WASTE)*100; ?>%</td>
        </tr>
        <tr>
            <th scope="row">BLM (rounded)</th>
            <td><?php echo $calculation->getBlm(); ?></td>
        </tr>
        <tr>
            <th scope="row">Carpet Quality</th>
            <td><?php echo $calculation->quality; ?></td>
        </tr>
        <tr>
            <th scope="row">Total Cost</th>
            <td>$<?php echo number_format($calculation->totalCost, 2); ?></td>
        </tr>       
        <tr>
            <th scope="row">Discount Amount</th>
            <td>$<?php echo number_format($calculation->discount_amount, 2); ?></td>
        </tr>
        <tr>
            <th scope="row">Net Cost</th>
            <td>$<?php echo number_format($calculation->excl_cost, 2); ?></td>
        </tr>
        <tr>
            <th scope="row">GST</th>
            <td>$<?php echo number_format($calculation->gst, 2); ?></td>
        </tr>
        <tr>
            <th scope="row">Final Cost</th>
            <td>$<?php echo number_format($calculation->incl_cost, 2); ?></td>
        </tr>
    </table>
</body>
</html>