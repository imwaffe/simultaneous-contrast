import * as jQuery from "/libraries/jquery-1.9.0.min.js";
import * as Bootstrap from "/libraries/bootstrap/js/bootstrap.min.js";
import {next, getCompletion, addChartLoadedCallback} from "/script/chartsLoader.js";
import DataSaver from "/script/runTest/dataSaver.js";
import SaveUserDetails from "/script/runTest/saveUserDetails.js";

var actualTime = 0;
var lastTimeStamp = Date.now();

$(document).ready(function(){
    var $saveUserDetails = new SaveUserDetails();

    $(".modal").on("hide.bs.modal", function(){
        startTimer();
    })
    $(".modal").on("show.bs.modal", function(){
        pauseTimer();
    })

    $("#goFullScreen").click(function(){
        openFullscreen();
    });
    $("#fullScreenModal").on("hidden.bs.modal", function () {
        exitFullScreenHandler();
    });

    if (document.addEventListener){
        document.addEventListener('fullscreenchange', exitFullScreenHandler, false);
        document.addEventListener('mozfullscreenchange', exitFullScreenHandler, false);
        document.addEventListener('MSFullscreenChange', exitFullScreenHandler, false);
        document.addEventListener('webkitfullscreenchange', exitFullScreenHandler, false);
    }

    window.addEventListener('beforeunload', alertOnLeaving);

    $("#next").click(function(){
        exitFullScreenHandler();
        $(".main-test-container").hide();
        $(".alert-message").show();
        $("#wait-message").show();
        waitMsgAnimate();
        DataSaver.addData(actualTime).done(function(){
            if(!next()){
                window.removeEventListener('beforeunload',alertOnLeaving);
                window.location.replace("thankyou.php");
            } else {
                waitMsgAnimateStop();
                $("#wait-message").hide();
                $(".alert-message").hide();
                $(".main-test-container").show();
                resetTimer();
                $(".progress.test-progress-bar .progress-bar").width((getCompletion()*100)+"%");
            }
        }).fail(function(){
            window.removeEventListener('beforeunload',alertOnLeaving);
            $(".main-test-container").hide();
            $(".alert-message").show();
            waitMsgAnimateStop();
            $("#wait-message").hide();
            $("#connection-error-message").show();
        });
    });

    $("#resetButton").click(function(){
        resetTimer();
    });

    $saveUserDetails.onsave(function(){
        $("#fullScreenModal").modal("show");
    });
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

function waitMsgAnimate() {
    $('#wait-message').fadeTo(2000,0.1,function(){
        $(this).fadeTo(2000,1,function(){
            waitMsgAnimate();
        });
    });
}
function waitMsgAnimateStop(){
    $('#wait-message').stop(true).fadeTo(500,1);
}

function startTimer(){
    lastTimeStamp = Date.now();
}
function pauseTimer(){
    actualTime += (Date.now()-lastTimeStamp);
}
function resetTimer(){
    lastTimeStamp = Date.now();
    actualTime = 0;
}