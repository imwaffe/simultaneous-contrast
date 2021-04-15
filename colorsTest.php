<?php 
    session_start();
    require_once("./components/DotEnv.php");
    (new DotEnv('./.env'))->load();
?>

<?php include "./components/header.php"; ?>
<style>
    .canvas-test{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
    }
</style>

<body>
    <div class="jumbotron vertical-center">
        <div class="container">
            <div class="row" style="margin-top:10px">
                <div class="col-md-12">
                    <div align="center">
                        <canvas id="canvas" class="canvas-test" height="400px" width="1100px"></canvas>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" style="text-align:center">
                    <input type="text" id="hsl-bg-input" data-color-format="rgb">
                    <span class="hsl" id="hsl_bg"></span>
                </div>
                <div class="col-md-6"style="text-align:center">
                    <input type="text" id="hsl-fg-input" data-color-format="rgb">
                    <span class="hsl" id="hsl_fg"></span>
                </div>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript">
    var gap = <?php echo getenv('TEST_GAP'); ?>;
    var innerSize = <?php echo getenv('TEST_INNERSQUARE_SIZE'); ?>;
    var outerSize = <?php echo getenv('TEST_OUTERSQUARE_SIZE'); ?>;
</script>
<script src="jquery-colorpickersliders/jquery.colorpickersliders.js"></script>
<script src="script/runTest.js"></script>
<script src="script/colorsTest.js"></script>

</html>