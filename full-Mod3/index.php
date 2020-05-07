<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">

    <?php
    include_once 'classes/Prices.php';
    include 'classes/Rooms.php';
    include 'classes/Costs.php';
    $prices = new Prices("data/prices.xml");
    $rooms = new Rooms;
    $costs = new Costs;

    $showResults = false;


    if (isset($_GET['submit'])) {
        $rooms->addRooms(array_filter($_GET['length']), array_filter($_GET['width']));
        $costs->calcCosts($rooms, $_GET['quality'], $_GET['discount']);

        $showResults = true;
    }
    ?>

</head>

<body>
    <div class="container">
        <header class="logo">
            <h1>Carpet Capers</h1>
        </header>
        <nav>
            <a href="index.php" class="active">Home</a>
            <a href="commission.php">Commision</a>
        </nav>
        <section class="input">
            <h2>Enter your details</h2>
            <form>
                <div class="row" style="padding: 0 20%;">
                    <label for="salesperson">Salesperson</label>
                    <input name="salesperson" type="text">
                </div>
                <div class="flex-h">
                    <section class="half flex-item">
                        <h3>Rooms</h3>
                        <table id="tblRooms" class="tbl">
                            <thead>
                                <th scope="row">Room</th>
                                <th class="forty">Width</th>
                                <th class="forty">Length</th>
                            </thead>
                            <tfoot>
                                <td colspan="3"><button type="button" class="btn block" id="addRoom">Add Room</button></td>
                            </tfoot>
                            <tbody>
                                <tr id=1>
                                    <td>1</td>
                                    <td><input type="number" step=0.01 min=0.0 id="width1" name="width[]"></td>
                                    <td><input type="number" step=0.01 min=0.0 id="length1" name="length[]"></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                    <section class="half flex-item">
                        <h3>Quality</h3>
                        <?php
                        $i = 0;
                        foreach ($prices->getDataAsArray() as $key => $value) {
                        ?>
                            <div class="row">
                                <input id="q_<?php echo $i; ?>" type="radio" name="quality" value="<?php echo $key; ?>" <?php if ($i == 0) {
                                                                                                                            echo "checked";
                                                                                                                        } ?>>
                                <label class="radio-label" for="q_<?php echo $i; ?>"><?php echo $key; ?> - $<?php echo $value; ?>/ blm</label>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                        <h3>Discount</h3>
                        <div class="row">
                            <label for="discount">Discount (max 5%)</label>
                            <input id="discount" type="number" step=1 min=0 max=5 name="discount">
                        </div>
                    </section>
                </div>
                <div class="row">
                    <button class="block" name="submit">Submit</button>
                </div>
            </form>
        </section>
        <section class="output">
            <h2>Results</h2>
            <?php if ($showResults) { ?>
                <table class="tbl output">
                    <tbody>
                        <tr>
                            <th class="half">Number of Rooms</th>
                            <td class="num"><?php echo $rooms->numRooms(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Area</th>
                            <td class="num"><?php echo $rooms->getTotalArea(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Wastage allowance</th>
                            <td class="num"><?php echo ($costs::WASTE * 100); ?>%</td>
                        </tr>
                        <tr>
                            <th scope="row">BLM (rounded)</th>
                            <td class="num"><?php echo $costs->getBlm(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Carpet Quality</th>
                            <td><?php echo $costs->getQuality(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Total Cost</th>
                            <td class="num"><span class="currency">$</span><?php echo $costs->getTotalCost(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Dicsount Amount</th>
                            <td class="num"><span class="currency">$</span><?php echo $costs->getDiscount_amount(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Cost (excl GST)</th>
                            <td class="num"><span class="currency">$</span><?php echo $costs->getExcl_cost(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">GST</th>
                            <td class="num"><span class="currency">$</span><?php echo $costs->getGst(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Cost (incl GST)</th>
                            <td class="num"><span class="currency">$</span><?php echo $costs->getIncl_cost(); ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php }; ?>
        </section>

    </div>
    <script>
        document.getElementById('addRoom').addEventListener('click', function() {
            //add an additional row to the bottom of the rooms table dynamically
            var roomsTable = document.getElementById("tblRooms").getElementsByTagName('tbody')[0];;
            var rowCount = roomsTable.rows.length + 1;

            var newRow = roomsTable.insertRow(-1); //add to end
            var newNum = newRow.insertCell(0); //add first col
            newNum.innerHTML = rowCount; //Show row number

            var newLength = newRow.insertCell(1); //add second col
            newLength.innerHTML = '<input type="number" step=0.01 min=0.0 name="width[]">';

            var newWidth = newRow.insertCell(2); //add third col
            newWidth.innerHTML = '<input type="number" step=0.01 min=0.0 name="length[]">'
        })
    </script>
</body>

</html>