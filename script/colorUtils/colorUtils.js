export default class ColorUtils{
	constructor(color1, color2){
		this.color1 = tinycolor(color1);
		this.color2 = tinycolor(color2);
	}

	getRGBEuclidDist(){
	    return Math.sqrt(Math.pow((this.color1.toRgb().r-this.color2.toRgb().r),2)+Math.pow((this.color1.toRgb().g-this.color2.toRgb().g),2)+Math.pow((this.color1.toRgb().b-this.color2.toRgb().b),2));
	}

	getHSLEuclidDist(){
	    return Math.sqrt(Math.pow(this.getHueDelta(),2)+Math.pow(this.getSatDelta(),2)+Math.pow(this.getLumaDelta(),2));
	}

	getHueDelta(){
		return this.color2.toHsl().h - this.color1.toHsl().h;
	}
	getHueDist(){
	    var raw_dist = Math.abs(this.getHueDelta());
	    return Math.min(raw_dist, 360-raw_dist);
	}

	getSatDelta(){
		return (this.color2.toHsl().s-this.color1.toHsl().s)*100;
	}
	getSatDist(){
		return Math.abs(this.getSatDelta());
	}

	getLumaDelta(){
		return (this.color2.toHsl().l-this.color1.toHsl().l)*100;
	}
	getLumaDist(){
		return Math.abs(this.getLumaDelta());
	}
}