<?php
    session_start();
    $_SESSION['visited_index'] = false;
    $_SESSION['visited_test'] = false;
    
    require_once "libraries/Mobile_Detect.php";
    $detect = new Mobile_Detect;
    if($detect->isMobile())
        header('Location: ./onlymobile.php');
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
        window.location.replace("./notsupported.php");
</script>

    <body>
        <div class="vertical-center">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="container description">
                    <h1><?php t("global","instructions"); ?></h1>
                    <p>
                        <?php t("instructions","using_sliders") ?> (<b><i><?php t("global","hue") ?></i></b>, <b><i><?php t("global","saturation") ?></i></b>, <b><i><?php t("global","brightness") ?></i></b>) <?php t("instructions","match_squares") ?><br>
                        <?php t("instructions", "when_matched") ?> <b><i><?php t("global", "submit_and_continue") ?></i></b> <?php t("instructions", "to_continue") ?>.
                    </p>
                    <p>
                        <?php t("instructions", "try_demo") ?>
                    </p>
                    <p>
                        <b><?php t("instructions", "when_ready") ?></b>
                    </p>
                    <div align="center">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startTestModal"><?php t("global", "begin_test") ?> <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button>
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
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <?php t("global", "submit_and_continue") ?>
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
                    <h5 class="modal-title" id="confirmModal"><?php t("global", "warning") ?>!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <?php t("modals", "just_demo_to_start_click_on") ?> <b><i><?php t("global", "begin_test") ?></i></b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php t("global", "go_back") ?></button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#startTestModal" data-bs-dismiss="modal"><?php t("global", "begin_test") ?> <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span></button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Start test modal -->
            <div class="modal fade" id="startTestModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="startTestModalLabel" aria-hidden="true">
              <div class="modal-dialog dark-modal">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="startTestModalLabel"><?php t("global", "warning") ?>!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>
                        <?php t("global", "clicking_on") ?> <b><i><?php t("global", "begin_test") ?></i></b> <?php t("instructions", "start_test") ?>.<br>
                        <?php t("modals", "requires_10_minutes_cant_interrupt") ?>
                    </p>
                    <p>
                        <b><?php t("modals", "q_sure_to_start") ?></b>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><?php t("global", "go_back") ?></button>
                    <a class="btn btn-success" href="test.php?cone_reset_delay=5000&cone_reset_time=3000"><?php t("global", "begin_test") ?></a>
                    <!--
                    <div class="dropdown show">
                      <button class="btn btn-success dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        inizia il test <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="test.php">Test semplice</a>
                        <a class="dropdown-item" href="test.php?cone_reset_delay=5000&cone_reset_time=3000">Reset coni 5s/3s</a>
                        <a class="dropdown-item" href="test.php?cone_reset_delay=15000&cone_reset_time=5000">Reset coni 15s/5s</a>
                      </div>
                    -->
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
        import {addRewriteChartCallback, canvasDrawer} from "./script/chartsLoader.js";
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