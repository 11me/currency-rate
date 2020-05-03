<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency rate</title>
</head>
<body>
    <style>
        main {
                display: flex;
                justify-content: center;
                margin-top: 20%;
                font-size: 30px;
            }
    </style>
    <main>
        <div id="wrapper">

            <?php echo "<span>" . $currencyArray["USD_Rate"] . " " . "USD: " . $currencyArray["USD"] . "</span>"; ?>
            <?php echo "<br>"; ?>
            <?php echo "<span>" . $currencyArray["EUR_Rate"] . " " . "EUR: " . $currencyArray["EUR"] . "</span>"; ?>

        </div>
    </main>
</body>
</html>
