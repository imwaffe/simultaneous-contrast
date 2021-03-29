<?php
    session_start();
    $_SESSION['visited_index'] = true;
?>

<?php include "components/header.php"; ?>

    <body>
        <div class="vertical-center">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="container description">
                    <h1>Istruzioni</h1>
                    <p>
                        Utilizzando il selettore <b><i>Luminosità</i></b> devi cercare di far coincidere il colore del quadrato piccolo a destra <i>(cerchiato in blu)</i> con quello del quadrato piccolo a sinistra <i>(cerchiato in rosso)</i>.<br>
                        Quando pensi di aver ottenuto la corrispondenza corretta, clicca sul pulsante <b><i>Conferma e prosegui</i></b> per proseguire nel test.
                    </p>
                    <p>
                        Puoi provare il funzionamento del test in questa schermata, sfruttando quello che vedi a lato.
                    </p>
                    <p>
                        <b>Quando ti senti pronto puoi iniziare il test vero e proprio premendo il pulsante qui sotto:</b>
                    </p>
                    <div align="center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#startTestModal">inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <footer class="footer">
                                <p>
                                    CC BY-NC Luca Armellin - github: <a href="https://github.com/imwaffe/" target="_blank">@imwaffe</a><br>
                                    <a href="http://www.virtuosoft.eu/code/jquery-colorpickersliders/" target="_blank">jQuery Color Picker Sliders</a>, Apache License Version 2.0 by <a href="https://github.com/istvan-ujjmeszaros" target="_blank">István Ujj-Mészáros</a>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Questa è solo una prova, per iniziare il test vero e proprio premi sul pulsante <b><i>Inizia il test</i></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Indietro</button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#startTestModal">inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Start test modal -->
            <div class="modal fade" id="startTestModal" tabindex="-1" role="dialog" aria-labelledby="startTestModal" aria-hidden="true">
              <div class="modal-dialog dark-modal" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="startTestModal">ATTENZIONE!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>
                        Premendo su <b><i>Inizia il test</i></b> inizierai effettivamente il test.<br>
                        Il test richiede meno di cinque minuti e non può essere interrotto.
                    </p>
                    <p>
                        <b>Sei sicuro di voler iniziare?</b>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Indietro</button>
                    <a class="btn btn-success" href="test.php">inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></a>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>

    <script src="jquery-colorpickersliders/jquery.colorpickersliders.js"></script>
    <script src="script/runTest.js"></script>
    <script src="script/colourContrast.js"></script>

    <script>
        function drawExampleCircles(){
            this.c.lineWidth="5";
            this.c.beginPath();
            this.c.arc(canvasDrawer.getLeftMarginSecondFG(), canvasDrawer.getTopMarginFG(), 60, 0, 2 * Math.PI);
            this.c.strokeStyle="blue";
            this.c.stroke();
            this.c.beginPath();
            this.c.arc(canvasDrawer.getLeftMarginFirstFG(), canvasDrawer.getTopMarginFG(), 60, 0, 2 * Math.PI);
            this.c.strokeStyle="red";
            this.c.stroke();
        }

        $(document).ready(function(){
            setTimeout(drawExampleCircles,1000);
        })
    </script>

<?php include "components/footer.php"; ?>