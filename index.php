<?php
    session_start();
    $_SESSION['visited_index'] = false;
    $_SESSION['visited_test'] = false;
    
    require_once "libraries/Mobile_Detect.php";
    $detect = new Mobile_Detect;
    if($detect->isMobile())
        header('Location: /onlymobile.php');
    else
        $_SESSION['visited_index'] = true;
?>

<?php include "components/header.php"; ?>

<script>
    let supported = false;
</script>
<script>
    try {
        import("foo").catch(() => {});
    } catch (e) {};
    supported = true;
</script>
<script>
    if(!supported)
        window.location.replace("/notsupported.php");
</script>

    <body>
        <div class="vertical-center">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="container description">
                    <h1>Istruzioni</h1>
                    <p>
                        Utilizzando i selettori (<b><i>Tinta</i></b>, <b><i>Saturazione</i></b> e <b><i>Luminosità</i></b>) devi cercare di far coincidere il colore del quadrato piccolo a destra <i>(cerchiato in blu)</i> con quello del quadrato piccolo a sinistra <i>(cerchiato in rosso)</i>.<br>
                        Quando pensi di aver ottenuto la corrispondenza corretta, clicca sul pulsante <b><i>Conferma e prosegui</i></b> per proseguire nel test.
                    </p>
                    <p>
                        Puoi provare il funzionamento del test in questa schermata, sfruttando quello che vedi a lato.
                    </p>
                    <p>
                        <b>Quando ti senti pronto puoi iniziare il test vero e proprio premendo il pulsante qui sotto:</b>
                    </p>
                    <div align="center">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startTestModal">inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <footer class="footer">
                                <p>
                                    CC BY-NC <a href="http://www.armellinluca.com" target="_blank">Luca Armellin</a> - github: <a href="https://github.com/imwaffe/simultaneous-contrast" target="_blank">@imwaffe</a><br>
                                    <a href="http://www.virtuosoft.eu/code/jquery-colorpickersliders/" target="_blank">jQuery Color Picker Sliders</a>, Apache License Version 2.0 by <a href="https://github.com/istvan-ujjmeszaros" target="_blank">István Ujj-Mészáros</a><br>            
                                    <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, released under <a href="http://www.opensource.org/licenses/mit-license.php" target="_blank">MIT License</a>
                                </p>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="container">
                    <div class="row" style="margin-top:10px">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div align="center">
                                <canvas id="canvas" height="280px" width="700px"></canvas>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <span id="hsl"></span>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6" align="center">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> conferma e prosegui
                            </button>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>

            <!-- Confirmation modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
              <div class="modal-dialog dark-modal" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="confirmModal">ATTENZIONE!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Questa è solo una prova, per iniziare il test vero e proprio premi sul pulsante <b><i>Inizia il test</i></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Indietro</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startTestModal" data-bs-dismiss="modal">inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Start test modal -->
            <div class="modal fade" id="startTestModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="startTestModalLabel" aria-hidden="true">
              <div class="modal-dialog dark-modal">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="startTestModalLabel">ATTENZIONE!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>
                        Premendo su <b><i>Inizia il test</i></b> inizierai effettivamente il test.<br>
                        Il test richiede meno di dieci minuti e non può essere interrotto.
                    </p>
                    <p>
                        <b>Sei sicuro di voler iniziare?</b>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Indietro</button>
                    <div class="dropdown show">
                      <button class="btn btn-success dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>
                      </button>

                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="test.php">Test semplice</a>
                        <a class="dropdown-item" href="test.php?cone_reset_delay=5000&cone_reset_time=3000">Reset coni 5s/3s</a>
                        <a class="dropdown-item" href="test.php?cone_reset_delay=15000&cone_reset_time=5000">Reset coni 15s/5s</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>

    <script type="text/javascript">
        var gap = 100;
        var innerSize = 75;
        var outerSize = 200;
        var csvFile = <?php echo getenv('DEMO_CSV_PATH'); ?>;
    </script>

    <script type="module">
        import {addRewriteChartCallback, canvasDrawer} from "/script/chartsLoader.js";
        canvasDrawer.rewriteSecondBg = false;

        function drawExampleCircles(){
            canvasDrawer.c.lineWidth="5";
            canvasDrawer.c.beginPath();
            canvasDrawer.c.arc(canvasDrawer.getLeftMarginSecondFG(), canvasDrawer.getTopMarginFG(), 60, 0, 2 * Math.PI);
            canvasDrawer.c.strokeStyle="blue";
            canvasDrawer.c.stroke();
            canvasDrawer.c.beginPath();
            canvasDrawer.c.arc(canvasDrawer.getLeftMarginFirstFG(), canvasDrawer.getTopMarginFG(), 60, 0, 2 * Math.PI);
            canvasDrawer.c.strokeStyle="red";
            canvasDrawer.c.stroke();
        }

        $(document).ready(function(){
            addRewriteChartCallback(drawExampleCircles);
            canvasDrawer.onBackgroundLoadCallback.add(drawExampleCircles);
        })
    </script>

<?php include "components/footer.php"; ?>