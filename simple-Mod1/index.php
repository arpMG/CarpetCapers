<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carpet Capers - Input</title>
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
        <p> <label for="qual_std">Standard ($120 plm)</label>
            <input type="radio" name="quality" id="qual_std" value="standard" checked>
        </p>
        <p> <label for="qual_prem">Premium ($180 plm)</label>
            <input type="radio" name="quality" id="qual_prem" value="premium">
        </p>
        <p> <label for="qual_exec">Executive ($210 plm)</label>
            <input type="radio" name="quality" id="qual_exec" value="executive">
        </p>
        <br>
        <h3>Discount %</h3>
        <p>Enter discount (max 3%) <input type="number" name="discount" min=0 max=3 step=0.5 value="2"></p>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>