class RandomColor{
	static getRandomColor(){
	    return tinycolor("rgb("+Math.floor(Math.random()*255)+","+Math.floor(Math.random()*255)+","+Math.floor(Math.random()*255)+")");
	}

	static complColor(color){
	    return tinycolor("rgb("+(255-color.toRgb().r)+","+(255-color.toRgb().g)+","+(255-color.toRgb().b)+")");
	}

	static randomIntRange(range,min){
		var rand = 0;
		while(Math.abs(rand) < min)
			rand = Math.floor(Math.random()*(range*2))-range;
		return rand;
	}
	static randomFloatRange(range,min){
		var rand = 0;
		while(Math.abs(rand) < min)
			rand = (Math.random()*(range*2))-range;
		return rand;
	}

	static nearlyRandomColor(color){
		var hslColor = color.toHsl();
		var h = hslColor.h+this.randomIntRange((360*0.2), (360*0.15));
		if(h>360)
			h-=360;
		else if(h<0)
			h+=360;

		var s = hslColor.s+this.randomFloatRange((0.3), (0.3*0.15));
		if(s>1)
			s=1;
		else if(s<0)
			s=0;

		/*var l = hslColor.l+this.randomFloatRange(0.2);
		if(l>1)
			l=1;
		else if(l<0)
			l=0;*/

		return tinycolor("hsl("+h+","+s+","+hslColor.l+")");
	}
}