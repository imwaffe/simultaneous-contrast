export default class Rectangles{
    restoreColor = {};
    timeouts = [];
    intervals = [];
    animateTiming = {
        "color": 5000,
        "white": 3000
    }
    setBackground = false;

    constructor(outerSize, innerSize, gap, canvas, colorPicker){
        this.whiteNoiseImg = null;
        this.onBackgroundLoadCallback = $.Callbacks();
        this.rewriteSecondBg = true;
        this.c = canvas.getContext("2d");
        this.colorPicker = colorPicker;

        this.canvas = canvas;
        this.outerSize = outerSize;
        this.gap = gap;

        this.setSizes(innerSize);
    }

    setSizes(innerSize){
        this.innerSize = innerSize;
        this.leftOuterMargin = (this.canvas.width-(this.outerSize*2+this.gap))/2;
        this.leftInnerMargin = this.leftOuterMargin+this.outerSize/2-this.innerSize/2;
        this.topOuterMargin = (this.canvas.height-this.outerSize)/2;
        this.topInnerMargin = this.canvas.height/2-this.innerSize/2;
    }

    init(colors){
        if(colors.inner_size>=0)
            this.setSizes(colors.inner_size);
        if(this.setBackground)
            this.colorPicker.trigger("colorpickersliders.updateColor", colors.second_background);
        else
            this.colorPicker.trigger("colorpickersliders.updateColor", colors.second_foreground);
        this.setFirstBGColor(colors.background_color);
        this.setSecondBGColor(colors.second_background);
        this.onBackgroundLoadCallback.add((function(){
            this.setSecondFGColor(colors.second_foreground);
            this.setFirstFGColor(colors.first_foreground);
        }).bind(this));
        this.setFirstFGColor(colors.first_foreground);
        this.setSecondFGColor(colors.second_foreground);
    }

    turnWhite(cond){
        if(cond){
            $("#whole-test-container").css("pointer-events","none");
            $("#whole-test-container").find("button").prop("disabled",true);
            $(".cp-container").hide();
            $("body").css("cursor","wait");
            this.rewriteSecondBg = false;
            var tmpRestoreColor = {};
            Object.assign(tmpRestoreColor, this.restoreColor);
            this.setFirstBGColor("#ffffff");
            this.setFirstFGColor("#ffffff");
            this.setSecondBGrgbColor("#ffffff");
            this.setSecondFGColor("#ffffff");
            this.restoreColor = tmpRestoreColor;
        } else {
            $("#whole-test-container").css("pointer-events","all");
            $("#whole-test-container").find("button").prop("disabled",false);
            $(".cp-container").show();
            $("body").css("cursor","auto");
            this.rewriteSecondBg = true;
            this.init(this.restoreColor);
        }
    }

    setFirstBGColor(color){
        this.restoreColor["background_color"] = color;
        if(color !== "wn"){
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

    setSecondBGrgbColor(color){
        this.c.fillStyle = color;
        this.c.fillRect(this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin,this.outerSize,this.outerSize);
    }

    setSecondBGColor(color){
        this.restoreColor["second_background"] = color;
        this.setBackground = false;
        if (color !== 'wn'){
            this.setBackground = true;
            return this.setSecondBGrgbColor(color);
        }
        if(this.whiteNoiseImg==null){
            this.whiteNoiseImg = new Image();
            this.whiteNoiseImg.src = whiteNoiseFile;
            this.whiteNoiseImg.onload = (function(){
                this.c.drawImage(this.whiteNoiseImg, this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin,this.outerSize,this.outerSize);
                this.onBackgroundLoadCallback.fire();
            }).bind(this);
        }
        else
            this.c.drawImage(this.whiteNoiseImg, this.leftOuterMargin+this.outerSize+this.gap, this.topOuterMargin,this.outerSize,this.outerSize);
    }

    setFirstFGColor(color){
        this.restoreColor["first_foreground"] = color;
        this.c.fillStyle = color;
        this.c.fillRect(this.leftInnerMargin, this.topInnerMargin, this.innerSize, this.innerSize);
    }

    setSecondFGColor(color){
        this.restoreColor["second_foreground"] = color;
        if(this.rewriteSecondBg)
            this.setSecondBGColor(this.restoreColor["second_background"]);
        if(color !== 'wn'){
            this.c.fillStyle = color;
            this.c.fillRect(this.leftInnerMargin+this.outerSize+this.gap, this.topInnerMargin, this.innerSize, this.innerSize);
        } else {
            if (this.whiteNoiseImg == null) {
                this.whiteNoiseImg = new Image();
                this.whiteNoiseImg.src = whiteNoiseFile;
                this.whiteNoiseImg.onload = (function () {
                    this.c.drawImage(this.whiteNoiseImg, this.leftInnerMargin + this.outerSize + this.gap, this.topInnerMargin, this.innerSize, this.innerSize);
                    this.onBackgroundLoadCallback.fire();
                }).bind(this);
            } else
                this.c.drawImage(this.whiteNoiseImg, this.leftInnerMargin + this.outerSize + this.gap, this.topInnerMargin, this.innerSize, this.innerSize);
        }
    }

    setUserColor(color){
        if(this.setBackground) {
            this.setSecondBGColor(color);
            this.setSecondFGColor(this.restoreColor["second_foreground"]);
        }
        else
            this.setSecondFGColor(color);
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

    turnWhiteAnimate() {
        this.timeouts.push(window.setTimeout(function(){
            this.turnWhite(true);
        }.bind(this),this.animateTiming["color"]));

        this.intervals.push(window.setInterval(function(){
            this.turnWhite(false);
        }.bind(this),this.animateTiming["color"]+this.animateTiming["white"]));

        this.timeouts.push(window.setTimeout(function(){
            this.intervals.push(window.setInterval(function(){
                this.turnWhite(true);
            }.bind(this),this.animateTiming["color"]+this.animateTiming["white"]));
        }.bind(this),this.animateTiming["color"]));
    }
    animateStart(color, white){
        this.animateTiming["color"] = color;
        this.animateTiming["white"] = white;
        this.turnWhiteAnimate();
    }
    animateStop(){
        for(var key in this.timeouts){
            window.clearTimeout(this.timeouts[key]);
        }
        for(var key in this.intervals){
            window.clearInterval(this.intervals[key]);
        }
        $("#whole-test-container").css("pointer-events","all");
        $("#whole-test-container").find("button").prop("disabled",false);
        $(".cp-container").show();
        $("body").css("cursor","auto");
        this.init(this.restoreColor);
    }
}