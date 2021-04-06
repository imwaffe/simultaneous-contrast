/* Canvas ID */
const CANVAS_ID = "canvas";

/* Init black empty canvas and sets context variables */
var c = document.getElementById(CANVAS_ID).getContext("2d");
var width = document.getElementById(CANVAS_ID).width;
var height = document.getElementById(CANVAS_ID).height;
c.beginPath();
c.fillStyle = "#000000";
c.fillRect(0, 0, width, height);

var bgColorPicker;
var fgColorPicker;

var bgColor=tinycolor();
var fgColor=tinycolor();

function initColorPicker(){
    canvasDrawer.setSecondBGColor();
    bgColorPicker = $("#hsl_bg").ColorPickerSliders({
        flat: true,
        //customswatches: "default-swatches",
        swatches: false,
        previewformat: 'hex',
        connectedinput: "#hsl-bg-input",
        order: {
            hsl: 1,
            preview: 2
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
            bgColor=color.tiny.toHexString();
            displayChart(bgColor,fgColor);
            /*displayChart(bgColor,complColor(color.tiny));
            if(fgColorPicker!=undefined)
                fgColorPicker.trigger("colorpickersliders.updateColor", complColor(color.tiny));*/
        }
    });

    fgColorPicker = $("#hsl_fg").ColorPickerSliders({
        flat: true,
        //customswatches: "default-swatches",
        swatches: false,
        previewformat: 'hex',
        connectedinput: "#hsl-fg-input",
        order: {
            hsl: 1,
            preview: 2
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
            fgColor=color.tiny.toHexString();
            displayChart(bgColor,fgColor);
        }
    });
}

function setColor(bgColor, fgColor){
    if(bgColorPicker!=undefined)
        bgColorPicker.trigger("colorpickersliders.updateColor", bgColor);
    if(fgColorPicker!=undefined)
        fgColorPicker.trigger("colorpickersliders.updateColor", fgColor);
}

function setBg(bgColor){
    if(bgColorPicker!=undefined)
        bgColorPicker.trigger("colorpickersliders.updateColor", bgColor);
}
function setFg(fgColor){
    if(fgColorPicker!=undefined)
        fgColorPicker.trigger("colorpickersliders.updateColor", fgColor);
}

$rewriteChartCallback = $.Callbacks();
function displayChart(bgColor,fgColor){
    canvasDrawer.setFirstBGColor(bgColor);
    canvasDrawer.setFirstFGColor(fgColor);
    canvasDrawer.setSecondFGColor(fgColor);
    showColorsSlider(true);
    $rewriteChartCallback.fire();
}

/* Reset the current chart (also used for initializing the first one) */
function reset(){
    initColorPicker();
    setColor(getRandomColor(),getRandomColor());
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

function getCurrentActualColor(){
    return inputColors[randomSequence[selectedColor]].first_foreground;
}
function getCurrentPickedColor(){
    return inputColors[randomSequence[selectedColor]].picked_color;
}
function getCurrentBgColor(){
    return inputColors[randomSequence[selectedColor]].background_color;
}
function getChartID(){
    return inputColors[randomSequence[selectedColor]].chart_id;
}

function getEuclidDist(color1, color2){
    color1 = tinycolor(color1).toRgb();
    color2 = tinycolor(color2).toRgb();
    return Math.sqrt(Math.pow((color1.r-color2.r),2)+Math.pow((color1.g-color2.g),2)+Math.pow((color1.b-color2.b),2));
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
    reset();
    $("#new-color-button").click(function(e){
        var color=getRandomColor();
        setColor(color,complColor(color));
    });
    $("#new-bg-button").click(function(e){
        setBg(getRandomColor());
    });
    $("#new-fg-button").click(function(e){
        setFg(getRandomColor());
    });
});

function getRandomColor(){
    return tinycolor("rgb("+Math.floor(Math.random()*255)+","+Math.floor(Math.random()*255)+","+Math.floor(Math.random()*255)+")");
}
function complColor(color){
    return tinycolor("rgb("+(255-color.toRgb().r)+","+(255-color.toRgb().g)+","+(255-color.toRgb().b)+")");
}