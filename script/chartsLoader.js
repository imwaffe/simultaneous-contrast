import * as jQuery from "../libraries/jquery-1.9.0.min.js";
import * as jQueryCsv from "../libraries/jquery.csv.min.js";
import * as ColorPicker from "../libraries/jquery-colorpickersliders/jquery.colorpickersliders.js";
import Rectangles from "../script/canvasDrawer.js";

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
var totalCharts = 0;
var randomSequence = [];    //Used as a map to get a pseudorandom index for inputColors objects array
var inputColors;    //Contains the colors 

export function getCompletion(){
    return (selectedColor/totalCharts);
}

var $chartLoadedCallbacks = $.Callbacks();
$.get( ((typeof csvFile==='undefined')?"colors.csv":csvFile), function(CSVdata) {
      inputColors = $.csv.toObjects(CSVdata);
}).done(function(){
    var usedNumbers = [];
    totalCharts = inputColors.length;
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
            hslhue: "",
            hslsaturation: "",
            hsllightness: "",
        },
        onchange: function(container, color){
            canvasDrawer.setSecondFGColor(color.tiny.toHexString());
            inputColors[randomSequence[selectedColor]].picked_color = color.tiny.toHexString();
        }
    });
}

export function next(){
    selectedColor++;
    if(selectedColor>=inputColors.length){
        return false;
    }
    displayChart(randomSequence[selectedColor]);
    return true;
}

function displayChart(index){
    canvasDrawer.init(inputColors[index]);
    showColorsSlider(inputColors[index].color);
    setText("chart "+inputColors[index].chart_id);
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
    displayChart(randomSequence[selectedColor]);
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

export function addChartLoadedCallback(callback){
    $chartLoadedCallbacks.add(callback);
}
export function addRewriteChartCallback(callback){
    $rewriteChartCallback.add(callback);
}
export function addNextChartCallback(callback){
    $nextChartCallback.add(callback);
}