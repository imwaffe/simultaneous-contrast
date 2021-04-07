<!DOCTYPE html>
<?php
    require_once("DotEnv.php");
    (new DotEnv('./.env'))->load();
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Contrasto di simultaneità</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <link href="libraries/prettify/prettify.css" rel="stylesheet" type="text/css" media="all">
        <link href="jquery-colorpickersliders/jquery.colorpickersliders.css" rel="stylesheet" type="text/css" media="all">
        <link href="style/style.css" rel="stylesheet" type="text/css" media="all">

        <script src="libraries/jquery-1.9.0.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="libraries/prettify/prettify.js"></script>
        <script src="libraries/tinycolor.js"></script>
        <script src="libraries/jquery.csv.min.js"></script>

        <script src="script/randomColor.js"></script>

        <script type="text/javascript">
            var gap = <?php echo getenv('TEST_GAP'); ?>;
            var innerSize = <?php echo getenv('TEST_INNERSQUARE_SIZE'); ?>;
            var outerSize = <?php echo getenv('TEST_OUTERSQUARE_SIZE'); ?>;
            var csvFile = <?php echo getenv('TEST_CSV_PATH'); ?>
        </script>
    </head>