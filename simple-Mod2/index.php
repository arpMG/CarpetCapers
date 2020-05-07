<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpet Capers - Input</title>
    <?php
        include_once "classes/Prices.php";
        $prices = new Prices("data/prices.xml");
    ?>
</head>
<body>
    <h1>Carpet Capers - Input</h1>
    <form action="quote.php">
        <h2>Rooms</h2>
        <p>Room 1 - Length <input name="length[]" type="number" value="5"> Width <input name="width[]" type="number" value="4"> </p>
        <p>Room 2 - Length <input name="length[]" type="number" value="4"> Width <input name="width[]" type="number" value="3"> </p>
        <p>Room 3 - Length <input name="length[]" type="number" value="2"> Width <input name="width[]" type="number" value="6"> </p>
        <p>Room 4 - Length <input name="length[]" type="number" > Width <input name="width[]" type="number" > </p>
        <p>Room 5 - Length <input name="length[]" type="number" > Width <input name="width[]" type="number" > </p>
        <br>
        <h3>Quality</h3>
        <?php 
            $i = 0;
            foreach ($prices->getData() as $key => $value) {
        ?>
            <p><label for="qual_<?php echo $i; ?>"><?php echo $key; ?> ($<?php echo $value?> plm)</label>
                <input type="radio" name="quality" id="qual_<?php echo $i; ?>" value="<?php echo $key; ?>" <?php if($i++==0){echo "checked";} ?>>
            </p>
        <?php
            }

            // $name = "";
            // $sale->name;

            // if($name == $sale->name)

            // if(strcasecmp($name, $sale->name) == 0 &&
            //  //month && 
            //  //year ){

            //  }

        ?>
        

        <br>
        <h3>Discount %</h3>
        <p>Enter discount (max 3%) <input type="number" name="discount" min=0 max=3 step=0.5 value="2"></p>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>