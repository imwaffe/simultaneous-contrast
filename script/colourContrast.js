/* Canvas ID */
const CANVAS_ID = "canvas";

/* Init black empty canvas and sets context variables */
var c = document.getElementById(CANVAS_ID).getContext("2d");
var width = document.getElementById(CANVAS_ID).width;
var height = document.getElementById(CANVAS_ID).height;
c.beginPath();
c.fillStyle = "#000000";
c.fillRect(0, 0, width, height);


/* Generate a random sequence, so that everytime the page is loaded the charts are displayed in different order */
var selectedColor = 0;  //Index used with randomSequence array to get the actual chart number
var randomSequence = [];    //Used as a map to get a pseudorandom index for inputColors objects array
var inputColors;    //Contains the colors 

$.get( "colors.csv", function(CSVdata) {
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
            inputColors[randomSequence[selectedColor]].second_foreground = color.tiny.toHexString();
        }
    });

    reset();
    setText();
});


var actualTime = 0;
var lastTimeStamp = Date.now();

/* Action when next button is pressed */
$("#next").click(function(){
    console.log(selectedColor);
    addData();
    actualTime = 0;
    selectedColor++;
    if(selectedColor>=inputColors.length){
        window.removeEventListener('beforeunload',alertOnLeaving);
        window.location.replace("thankyou.php");
    }
    canvasDrawer.init(inputColors[randomSequence[selectedColor]]);
    showColorsSlider(inputColors[randomSequence[selectedColor]].color);
    setText();
});

/* Action when reset button is pressed */
$("#reset").click(function(){
    reset();
})

/* Write text in top right corner indicating the chart number */
function setText(){
    var text = "Tavola "+(inputColors[randomSequence[selectedColor]].chart_id);
    c.font = "12px Arial";
    c.fillStyle = "#000000";
    c.fillRect(9,4,c.measureText(text).width+100,13);
    c.fillStyle = "#808080";
    c.fillText(text,10,15);
}

/* Reset the current chart (also used for initializing the first one) */
function reset(){
    $.get( "colors.csv", function(CSVdata) {
      inputColors = $.csv.toObjects(CSVdata);
    }).done(function(){
        actualTime = 0;
        canvasDrawer.init(inputColors[randomSequence[selectedColor]]);
        showColorsSlider(inputColors[randomSequence[selectedColor]].color);
        setText();
    });
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
    return inputColors[randomSequence[selectedColor]].second_foreground;
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

function addData(){
    $.post("functions/saveResults.php?action=add",{
        chart_id: getChartID(),
        bg_color: getCurrentBgColor(),
        actual_color: getCurrentActualColor(),
        picked_color: getCurrentPickedColor(),
        euclid_dist: getEuclidDist(getCurrentActualColor(),getCurrentPickedColor()),
        time: actualTime
    });
    saveImage();
}
function saveImage(){
    var canvas = document.getElementById(CANVAS_ID);
    $.post("functions/saveResults.php?action=image",{
        chart_id: getChartID(),
        img_base64: canvas.toDataURL("image/png")
    });
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