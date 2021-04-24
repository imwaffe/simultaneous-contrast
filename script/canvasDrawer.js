export default class Rectangles{
    constructor(outerSize, innerSize, gap, canvas, colorPicker){
        this.whiteNoiseImg = null;
        this.onBackgroundLoadCallback = $.Callbacks();
        this.rewriteSecondBg = true;
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
        this.colorPicker.trigger("colorpickersliders.updateColor", colors.second_foreground);

        this.setFirstBGColor(colors.background_color);
        this.setSecondBGColor();
        this.onBackgroundLoadCallback.add((function(){
            this.setSecondFGColor(colors.second_foreground);
            this.setFirstFGColor(colors.first_foreground);
        }).bind(this));

        //var nearlyRandomColor = RandomColor.nearlyRandomColor(tinycolor(colors.second_foreground));
        //this.setSecondFGColor(nearlyRandomColor.toHexString());
        this.setFirstFGColor(colors.first_foreground);
        this.setSecondFGColor(colors.second_foreground);
    }


    setFirstBGColor(color){
        if(color != "wn"){
            this.c.fillStyle = color;
            this.c.fillRect(this.leftOuterMargin, this.topOuterMargin, this.outerSize, this.outerSize);
        } else {
            this.onBackgroundLoadCallback.add((function(){
                this.c.drawImage(this.whiteNoiseImg,this.leftOuterMargin, this.topOuterMargin, this.outerSize, this.outerSize);
            }).bind(this));
            if(this.whiteNoiseImg!=null){
                this.c.drawImage(this.whiteNoiseImg,this.leftOuterMargin, this.topOuterMargin, this.outerSize, this.outerSize);
            }
        }
    }

    setSecondBGColor(){
        /*var tmpCanvas = document.createElement('canvas');
        tmpCanvas.setAttribute("width","150%");
        tmpCanvas.setAttribute("height","150%");
        var tmpCtx = tmpCanvas.getContext('2d');
        var imageData = tmpCtx.createImageData(300,300);
        for(var i=0; i<imageData.data.length; i+=4){
            var dot=Math.floor(Math.random()*255);
            imageData.data[i] = dot;
            imageData.data[i+1] = dot;
            imageData.data[i+2] = dot;
            imageData.data[i+3] = 255;
        }
        tmpCtx.putImageData(imageData,0,0);
        this.c.drawImage(tmpCanvas,this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin,this.outerSize,this.outerSize);*/
        if(this.whiteNoiseImg==null){
            this.whiteNoiseImg = new Image();
            this.whiteNoiseImg.src = whiteNoiseFile;
            this.whiteNoiseImg.onload = (function(){
                this.c.drawImage(this.whiteNoiseImg,this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin,this.outerSize,this.outerSize);
                //$rewriteChartCallback.fire();
                this.onBackgroundLoadCallback.fire();
            }).bind(this);
        }
        else
            this.c.drawImage(this.whiteNoiseImg,this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin,this.outerSize,this.outerSize);
    }

    setFirstFGColor(color){
        this.c.fillStyle = color;
        this.c.fillRect(this.leftInnerMargin, this.topInnerMargin, this.innerSize, this.innerSize);
    }

    setSecondFGColor(color){
        if(this.rewriteSecondBg)
            this.setSecondBGColor();
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