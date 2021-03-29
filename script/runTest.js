class Rectangles{
    constructor(outerSize, innerSize, gap, canvas, colorPicker){
        this.c = canvas.getContext("2d");
        this.colorPicker = colorPicker;

        var width = canvas.width;
        var height = canvas.height;

        this.outerSize = outerSize;
        this.innerSize = innerSize;
        this.gap = gap;
        this.leftOuterMargin = (width-(outerSize*2+gap))/2;
        this.leftInnerMargin = this.leftOuterMargin+this.outerSize/2-this.innerSize/2;
        this.topOuterMargin = (height-outerSize)/2;
        this.topInnerMargin = height/2-innerSize/2;
    }

    init(colors){
        $(".cp-hslhue").hide();
        $(".cp-hslsaturation").hide();

        this.colorPicker.trigger("colorpickersliders.updateColor", colors.second_foreground);

        this.setFirstBGColor(colors.background_color);
        this.setSecondBGColor();
        this.setFirstFGColor(colors.first_foreground);
        this.setSecondFGColor(colors.second_foreground);
    }


    setFirstBGColor(color){
        this.c.fillStyle = color;
        this.c.fillRect(this.leftOuterMargin, this.topOuterMargin, this.outerSize, this.outerSize);
    }

    setSecondBGColor(){/*
        this.c.fillStyle = color;
        this.c.fillRect(this.leftOuterMargin, this.topOuterMargin+this.outerSize+this.gap, this.outerSize, this.outerSize);*/
        var imageData = this.c.createImageData(this.outerSize,this.outerSize);
        for(var i=0; i<imageData.data.length; i+=4){
            var dot=Math.floor(Math.random()*255);
            imageData.data[i] = dot;
            imageData.data[i+1] = dot;
            imageData.data[i+2] = dot;
            imageData.data[i+3] = 255;
        }
        this.c.putImageData(imageData, this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin);
    }

    setFirstFGColor(color){
        this.c.fillStyle = color;
        this.c.fillRect(this.leftInnerMargin, this.topInnerMargin, this.innerSize, this.innerSize);
    }

    setSecondFGColor(color){
        this.c.fillStyle = color;
        this.c.fillRect(this.leftInnerMargin+this.outerSize+this.gap, this.topInnerMargin, this.innerSize, this.innerSize);
    }

    setFGColor(color){
        this.setFirstFGColor(color);
        this.setSecondFGColor(color);
    }

    getLeftMarginSecondFG(){
        return this.leftInnerMargin+this.outerSize+this.gap+this.innerSize/2;
    }
    getLeftMarginFirstFG(){
        return this.leftInnerMargin+this.innerSize/2;
    }
    getTopMarginFG(){
        return this.topInnerMargin+this.innerSize/2;
    }
}

var canvasDrawer;
canvasDrawer = new Rectangles(200, 75, 100, document.getElementById("canvas"), $("#hsl"));