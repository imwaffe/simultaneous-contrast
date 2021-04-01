<?php
    session_start();
    $_SESSION['visited_index'] = false;
    $_SESSION['visited_test'] = false;
    
    $useragent=$_SERVER['HTTP_USER_AGENT'];

    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            header('Location: onlymobile.php');
    else
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
                        Utilizzando i selettori (<b><i>Luminosità</i></b>, <b><i>Tinta</i></b>, <b><i>Saturazione</i></b>) devi cercare di far coincidere il colore del quadrato piccolo a destra <i>(cerchiato in blu)</i> con quello del quadrato piccolo a sinistra <i>(cerchiato in rosso)</i>.<br>
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

    <script type="text/javascript">
        var gap = 100;
        var innerSize = 75;
        var outerSize = 200;
    </script>
    <script src="jquery-colorpickersliders/jquery.colorpickersliders.js"></script>
    <script src="script/runTest.js"></script>
    <script src="script/colourContrast.js"></script>

    <script>
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
            $rewriteChartCallback.add(drawExampleCircles);
        })
    </script>

<?php include "components/footer.php"; ?>