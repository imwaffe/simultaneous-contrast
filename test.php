<?php 
    session_start();

    if(!isset($_SESSION['visited_index']) || $_SESSION['visited_index']==false)
        header("location: index.php");

    $_SESSION['visited_index'] = false;
    $_SESSION['visited_test'] = false;

    $_SESSION['session_id'] = "test_".date("d-m-Y_G-i-s");

    require_once("components/DotEnv.php");
    (new DotEnv('.env'))->load();
?>

<?php include "components/header.php"; ?>

<body>
    <div class="jumbotron vertical-center">
    <div class="container" id="test-container">
        <div class="row" style="margin-top:10px">
            <div class="col-md-12">
                <div align="center">
                    <canvas id="canvas" class="canvas-test" height="400px" width="1200px"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <span id="hsl"></span>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4" align="center">
                <button type="button" class="btn btn-danger" id="resetButton">
                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> reset
                </button>
            </div>
            <div class="col-md-6" align="center">
                <button type="button" class="btn btn-dark-custom" data-toggle="modal" data-target="#confirmModal">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> conferma e prosegui
                </button>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <div class="container" id="wait-message" style="display: none;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1>attendi...</h1>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
</div>

<!-- Confirmation modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog dark-modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModal">ATTENZIONE!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Sei sicuro di voler confermare il colore scelto?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Indietro</button>
            <button id="next" type="button" class="btn btn-primary" data-dismiss="modal">Conferma</button>
          </div>
        </div>
    </div>
</div>

<!-- Fullscreen modal -->
<div class="modal fade" id="fullScreenModal" tabindex="-1" role="dialog" aria-labelledby="fullScreenModal" aria-hidden="true">
    <div class="modal-dialog dark-modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="fullScreenModal">ATTENZIONE!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                Per poter svolgere il test è necessario visualizzare la pagina a schermo intero.
            </p>
            <p>
                Clicca su <b><i>Accetta</i></b> per proseguire con il test a schermo intero.
            </p>
          </div>
          <div class="modal-footer">
            <a class="btn btn-danger" href="index.php">Annulla il test</a>
            <button id="goFullScreen" type="button" class="btn btn-primary" data-dismiss="modal">Accetta</button>
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
<script src="script/colourContrast.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".modal").on("hide.bs.modal", function(){
            lastTimeStamp = Date.now();
        })
        $(".modal").on("show.bs.modal", function(){
            actualTime += (Date.now()-lastTimeStamp);
        })

        $("#goFullScreen").click(function(){
            openFullscreen();
        });
        $("#fullScreenModal").on("hidden.bs.modal", function () {
            exitFullScreenHandler();
        });

        $("#next").click(function(){
            exitFullScreenHandler();
        });

        if (document.addEventListener){
            document.addEventListener('fullscreenchange', exitFullScreenHandler, false);
            document.addEventListener('mozfullscreenchange', exitFullScreenHandler, false);
            document.addEventListener('MSFullscreenChange', exitFullScreenHandler, false);
            document.addEventListener('webkitfullscreenchange', exitFullScreenHandler, false);
        }

        window.addEventListener('beforeunload', alertOnLeaving);


        $("#fullScreenModal").modal("show");
    });

    function exitFullScreenHandler(){
        if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement){
            $("#fullScreenModal").modal("show");
        }
    }

    var elem = document.documentElement;
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem = window.top.document.body;
            elem.msRequestFullscreen();
        }
    }

    function alertOnLeaving(e){
        e.preventDefault();
        e.returnValue = "";
    }
</script>

</html>