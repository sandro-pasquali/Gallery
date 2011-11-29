var ScreenControl =
  {
	  interval: null,
	  screenX: 0,
		screenY: 0,
		
    moveTo: function(x,y,dur,type,termFunc)
	    {
			  try
				  {
					  this.stop();
						
						this.time = 0;
						this.xStart = this.screenX;
						this.yStart = this.screenY;
						
						this.xFinish = x || 0;
						this.yFinish = y || 0;
						this.duration = dur || 100;
						this.type = type || "inout";
						this.terminalFunction = termFunc || function() {;}
						
            this.xChange = this.xFinish - this.xStart;
						this.yChange = this.yFinish - this.yStart;

						this.setEasing(this.type);
						
						this.start();
					}
				catch(e) {;} 
			},
					
    setEasing: function(ease)
		  {
			  this.type = ease;
			  switch(this.type.toLowerCase())
				  {
					  case "in":
					  this.step = function()
						  {
					      this.screenX = this.xChange*Math.pow(this.time/this.duration,3)+this.xStart;
						    this.screenY = this.yChange*Math.pow(this.time/this.duration,3)+this.yStart;
						  }
            break;
									
  				  case "out":
					  this.step = function()
						  {
					      this.screenX = this.xChange*(Math.pow(this.time/this.duration-1,3)+1)+this.xStart;
						    this.screenY = this.yChange*(Math.pow(this.time/this.duration-1,3)+1)+this.yStart;
						  }
	          break;
									
					  case "inout":
						  this.step = function()
							  {
								  time = this.time;
						      this.screenX = ((time/=this.duration/2)<1)
									                ? this.xChange/2 * Math.pow(time,3) + this.xStart
																	: this.xChange/2 * (Math.pow(time-2,3)+2) + this.xStart;
											
									time = this.time;
						      this.screenY = ((time/=this.duration/2)<1)
									                ? this.yChange/2 * Math.pow(time,3) + this.yStart
																	: this.yChange/2 * (Math.pow(time-2,3)+2) + this.yStart;
							  }
	          break;
											
						default:
						break;
			   }					
			},
		
		stop: function()
		  {
			  clearInterval(this.interval);
			},
			
		start: function()
		  {
			  this.interval = setInterval("ScreenControl.main()",1);
			},
					
		main: function()
		  {
        this.step();
				window.scrollTo(Math.round(this.screenX),Math.round(this.screenY));
				++this.time;
				if(this.time>this.duration)
				  {
					  this.stop();
						this.terminalFunction();
					}
			}
	}
	
