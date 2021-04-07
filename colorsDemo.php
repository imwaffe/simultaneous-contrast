<?php 
    session_start();
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
                <div class="col-md-2">
                    <select id="charts-list">
                        <option value="" disabled selected>Select chart</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <span id="hsl"></span>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</body>

<script src="jquery-colorpickersliders/jquery.colorpickersliders.js"></script>
<script src="script/runTest.js"></script>
<script src="script/colourContrast.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $chartLoadedCallbacks.add(loadChartsList);
        $("#charts-list").change(function(){
            displayChart($(this).val());
        })
    });

    function loadChartsList(){
        displayChart(0);
        inputColors.forEach(function(item, index){
            $("#charts-list").append(new Option(item.chart_id,index));
        });
    }
</script>

</html>