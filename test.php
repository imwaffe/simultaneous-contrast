<?php 
    session_start();

    if(!isset($_SESSION['visited_index']) || $_SESSION['visited_index']==false)
        header("location: /");

    $_SESSION['visited_index'] = false;
    $_SESSION['visited_test'] = false;

    $_SESSION['session_id'] = "test_".date("d-m-Y_G-i-s");
?>

<?php include "components/header.php"; ?>

<script type="text/javascript">
    var coneResetTime = 3000;
    var coneResetDelay = 5000;
    var coneReset = false
    <?php if( isset($_GET["cone_reset_time"]) && isset($_GET["cone_reset_delay"]) ): ?>
        coneResetTime = <?php echo $_GET['cone_reset_time']; ?>;
        coneResetDelay = <?php echo $_GET['cone_reset_delay']; ?>;
        coneReset = true;
    <?php endif; ?>
</script>

<link href="/style/test-style.css" rel="stylesheet" type="text/css" media="all">

<body>
    <div class="main-test-container">
        <div class="display-contents">
            <div class="top-row">
                <div class="vertical-center-container">
                    <div class="progress test-progress-bar">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="display-contents">
            <div class="canvas-container">
                <div class="vertical-center-container" align="center">
                    <canvas id="canvas" class="canvas-test" height="400px" width="1200px"></canvas>
                </div>
            </div>
        </div>

        <div class="display-contents" id="whole-test-container">
            <div class="row bottom-row">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <span id="hsl"></span>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6" align="center">
                        <button type="button" class="btn btn-danger" id="resetButton">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> reset
                        </button>
                        <button type="button" class="btn btn-dark-custom" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> conferma e prosegui
                        </button>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="vertical-center alert-message" style="display:none">
        <div class="container" id="wait-message" style="display:none;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h1>attendi...</h1>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>

        <div class="container" id="connection-error-message" style="display:none;">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h1>C'è un problema :(</h1>
                    <p>
                        È stata persa la connessione col server, controlla la tua connessione di rete e riprova più tardi.
                    </p>
                    <p style="text-align: right">
                        <i>Scusaci per l'inconveniente,<br>grazie!</i>
                    </p>
                    <p style="text-align: center">
                        <a class="btn btn-success" href="test.php"><span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span>  torna alla home</a>
                    </p>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

<!-- User details modal -->
<?php include "components/userdetails.php"; ?>

<!-- Confirmation modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog dark-modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="confirmModal">ATTENZIONE!</h5>
          </div>
          <div class="modal-body">
            Sei sicuro di voler confermare il colore scelto?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Indietro</button>
            <button id="next" type="button" class="btn btn-primary" data-bs-dismiss="modal">Conferma</button>
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
            <button id="goFullScreen" type="button" class="btn btn-primary" data-bs-dismiss="modal">Accetta</button>
          </div>
        </div>
    </div>
</div>

</body>

<script type="module" src="/script/runTest/runTest.js"></script>

<?php include "components/footer.php"; ?>