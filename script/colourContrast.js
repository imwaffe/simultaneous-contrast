import * as jQuery from "/libraries/jquery-1.9.0.min.js";
import * as jQueryCsv from "/libraries/jquery.csv.min.js";
import * as ColorPicker from "/libraries/jquery-colorpickersliders/jquery.colorpickersliders.js";
import {Rectangles} from "/script/canvasDrawer.js";

export var canvasDrawer = new Rectangles(outerSize, innerSize, gap, document.getElementById("canvas"), $("#hsl"));

/* Canvas ID */
export const CANVAS_ID = "canvas";

/* Init black empty canvas and sets context variables */
var c = document.getElementById(CANVAS_ID).getContext("2d");
var width = document.getElementById(CANVAS_ID).width;
var height = document.getElementById(CANVAS_ID).height;
c.beginPath();
c.fillStyle = "#000000";
c.fillRect(0, 0, width, height);

var $rewriteChartCallback = $.Callbacks();
var $nextChartCallback = $.Callbacks();

/* Generate a random sequence, so that everytime the page is loaded the charts are displayed in different order */
var selectedColor = 0;  //Index used with randomSequence array to get the actual chart number
var randomSequence = [];    //Used as a map to get a pseudorandom index for inputColors objects array
var inputColors;    //Contains the colors 

var $chartLoadedCallbacks = $.Callbacks();
$.get( ((typeof csvFile==='undefined')?"colors.csv":csvFile), function(CSVdata) {
      inputColors = $.csv.toObjects(CSVdata);
}).done(function(){
    var usedNumbers = [];
    for(var i=0; i<inputColors.length; i++)
        usedNumbers[i] = false;
    var index = 0;
    while(index < inputColors.length){
        var value = Math.floor(Math.random()*inputColors.length);
        if(usedNumbers[value] == false){
            randomSequence[index] = value;
            index++;
            usedNumbers[value] = true;
        } 
    }
    $chartLoadedCallbacks.fire();
    reset();
});

/*
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
*/

/*
function addData(){
    var colors = new ColorUtils(getCurrentPickedColor(), getCurrentActualColor());
    return $.post("functions/saveResults.php?action=add",{
        chart_id: getChartID(),
        bg_color: getCurrentBgColor().toHexString(),
        actual_color: getCurrentActualColor().toHexString(),
        picked_color: getCurrentPickedColor().toHexString(),
        euclid_dist: colors.getRGBEuclidDist(),
        hue_dist: colors.getHueDist(),
        saturation_dist: colors.getSatDist(),
        luma_dist: colors.getLumaDist(),
        hue_delta: colors.getHueDelta(),
        saturation_delta: colors.getSatDelta(),
        luma_delta: colors.getLumaDelta(),
        time: actualTime
    }).done(saveImage());
}
function saveImage(){
    var canvas = document.getElementById(CANVAS_ID);
    return $.post("functions/saveResults.php?action=image",{
        chart_id: getChartID(),
        img_base64: canvas.toDataURL("image/png")
    });
}
*/

function initColorPicker(){
    /* Init color picker */
    $("#hsl").ColorPickerSliders({
        flat: true,
        //customswatches: "default-swatches",
        swatches: false,
        previewformat: 'rgb',
        order: {
            hsl: 1
        },
        labels: {
            hslhue: "Tinta",
            hslsaturation: "Saturazione",
            hsllightness: "Luminosità",
            rgbred: "Rosso",
            rgbgreen: "Verde",
            rgbblue: "Blu"
        },
        onchange: function(container, color){
            canvasDrawer.setSecondFGColor(color.tiny.toHexString());
            inputColors[randomSequence[selectedColor]].picked_color = color.tiny.toHexString();
        }
    });
}
/*
export var actualTime = 0;
var lastTimeStamp = Date.now();
*/
export function next(){
    selectedColor++;
    if(selectedColor>=inputColors.length){
        return false;
    }
    /*lastTimeStamp = Date.now();
    actualTime = 0;*/
    displayChart(randomSequence[selectedColor]);
    return true;
}

/* Action when next button is pressed */
/*
$("#next").click(function(){
    $("#test-container").hide();
    $("#wait-message").show();
    waitMsgAnimate();
    DataSaver.addData().done(function(){
        selectedColor++;
        if(selectedColor>=inputColors.length){
            window.removeEventListener('beforeunload',alertOnLeaving);
            window.location.replace("thankyou.php");
        }
        $("#test-container").show();
        waitMsgAnimateStop();
        $("#wait-message").hide();
        lastTimeStamp = Date.now();
        actualTime = 0;
        displayChart(randomSequence[selectedColor]);
    }).fail(function(){
        window.removeEventListener('beforeunload',alertOnLeaving);
        $("#test-container").hide();
        waitMsgAnimateStop();
        $("#wait-message").hide();
        $("#connection-error-message").show();
    });
});
*/

function displayChart(index){
    canvasDrawer.init(inputColors[index]);
    showColorsSlider(inputColors[index].color);
    setText("Tavola "+inputColors[index].chart_id);
    $rewriteChartCallback.fire();
}

/* Write text in top right corner indicating the chart number */
function setText(text){
    c.font = "12px Arial";
    c.fillStyle = "#000000";
    c.fillRect(9,4,c.measureText(text).width+100,13);
    c.fillStyle = "#808080";
    c.fillText(text,10,15);
}

/* Reset the current chart (also used for initializing the first one) */
function reset(){
    /*lastTimeStamp = Date.now();
    actualTime = 0;*/
    displayChart(randomSequence[selectedColor]);
}

/* Function to download canvas as PNG image */
function download(filename) {
    var link = document.createElement('a');
    var canvas = document.getElementById(CANVAS_ID);
    link.download = filename;
    link.href = canvas.toDataURL("image/png");
    if (document.createEvent) {
        e = document.createEvent("MouseEvents");
        e.initMouseEvent("click", true, true, window,
                         0, 0, 0, 0, 0, false, false, false,
                         false, 0, null);

        link.dispatchEvent(e);
    } else if (link.fireEvent) {
        link.fireEvent("onclick");
    }
}

export function getCurrentActualColor(){
    return tinycolor(inputColors[randomSequence[selectedColor]].first_foreground);
}
export function getCurrentPickedColor(){
    return tinycolor(inputColors[randomSequence[selectedColor]].picked_color);
}
export function getCurrentBgColor(){
    return tinycolor(inputColors[randomSequence[selectedColor]].background_color);
}
export function getChartID(){
    return inputColors[randomSequence[selectedColor]].chart_id;
}

function showColorsSlider(condition){
    if(condition==="true"){
        $(".cp-hslhue").show();
        $(".cp-hslsaturation").show();
    }
    else if(condition==="false"){
        $(".cp-hslhue").hide();
        $(".cp-hslsaturation").hide();
    }
}

$(document).ready(function(){
    $chartLoadedCallbacks.add(initColorPicker);
    $("#resetButton").click(function(){
        reset();
    })
});

export function addRewriteChartCallback(callback){
    $rewriteChartCallback.add(callback);
}
export function addNextChartCallback(callback){
    $nextChartCallback.add(callback);
}
/*
export function startTimer(){
    lastTimeStamp = Date.now();
}
export function pauseTimer(){
    actualTime += (Date.now()-lastTimeStamp);
}*/