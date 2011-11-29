
/*
 *  All code and content copyright 2000-2001 Sandro Pasquali
 *  sandropasquali@yahoo.com
 */

var $$G = new Object();

var _DOCK = 
  {
		//-------------------------------------- defaults
    minSize: 32,
    maxSize: 96,

    collapseRate: 8,
    scaleFactor: .45,
    padding: 0,
		
		dockScale: 1,
    dockTop: 0,
    dockLeft: 0,
    
    tileRefs: new Array(),
    
    //---------------------------------------- draw
    draw: function()
		  {
		  	var isDock = document.getElementById('DOCKBAR');
		  	
		  	if(isDock)
		  	  {
		  	  	isDock.parentNode.removeChild(isDock);
		  	  }
		  	
		    this.count = 0;
			  var cur = this.first;
				
				var d = document.createElement('DIV');
				
				var dck = document.body.appendChild(d);
				var ds = dck.style;
				
				dck.id = 'DOCKBAR';
	
				ds.position = 'absolute';
				ds.zIndex = 100;
				ds.margin = '0px';
				ds.padding = '0px';
				ds.width = '100%';
				
				
				try // hopefully this 'fork' will eventually become unnecessary
				  {
					  dck.addEventListener("mousemove",this.mouseMove,true); 
					  dck.addEventListener("mouseout",this.mouseOut,true);
					  dck.addEventListener("mouseover",this.mouseOver,true);
					  dck.addEventListener("mousedown",this.mouseDown,true);
					  dck.addEventListener("mouseup",this.mouseUp,true);
					}
				catch(e) 
				  {
				    dck.onmousemove = this.mouseMove;
				    dck.onmouseout = this.mouseOut;
				    dck.onmouseover = this.mouseOver;
				    dck.onmousedown = this.mouseDown;
				    dck.onmouseup = this.mouseUp;
				  }
	
				this.setScale();
	 
	      this.imgPointers = new Array();
	
			  while(cur)
			    {
				    var e = document.createElement('IMG');
					  e.id = 'DCK' + cur;
	          var eS = e.style;
						
					  eS.position = 'absolute';
					  eS.top = (this.maxSize - this.minSize).toString() + 'px'; 
					  eS.left = (this.count*(this.minSize + this.padding)).toString() + 'px';
					  eS.width = this.minSize.toString() + 'px'; 
					  eS.height = this.minSize.toString() + 'px';
						eS.zIndex = 10;
						
				    e.src = this.list[cur].id;			
						this.imgPointers[e.id] = this.list[cur].id.replace('t_','');
						
						this.list[cur].domRef = dck.appendChild(e);	
								
	          ++this.count;
					  cur = this.list[cur].next;
				  }
	
				this.refreshDockSize();
				
				this.onDockDraw();
		},
	
	//-------------------------------------- setMinSize
	setMinSize: function(nv)
	  {
		  this.minSize = Math.max(nv||this.minSize,0) * this.dockScale;
		},
		
	//-------------------------------------- setMaxSize
	setMaxSize: function(nv)
	  {
		  this.maxSize = Math.max(nv||this.maxSize,1) * this.dockScale;
		},
		
	//-------------------------------------- setCollapseRate
	setCollapseRate: function(nv)
	  {
		  this.collapseRate = Math.max(nv||this.collapseRate,1) * this.dockScale;
		},
	
  //-------------------------------------- setScale
	setScale: function(nv)
	  {
		  this.dockScale = nv || this.dockScale;
			this.setMinSize();
			this.setMaxSize();
			this.setCollapseRate();
		},
	
	//-------------------------------------- refreshDockSize
	refreshDockSize: function()
	  {
		  var DS = document.getElementById('DOCKBAR').style
		  DS.width = $$G.DOCKWIDTH = (this.minSize * (this.count-1) + this.maxSize).toString() + 'px';
		  DS.height = $$G.DOCKHEIGHT = (this.maxSize + 2*this.padding).toString() + 'px';
		  DS.top = $$G.DOCKTOP = this.dockTop.toString() + 'px';
		  DS.left = $$G.DOCKLEFT = this.dockLeft.toString() + 'px';		
		},
	
	//-------------------------------------- onDockDraw
	onDockDraw: function()
	  {
	  	
	  },
	
	//-------------------------------------- onChange
	onChange: function(action,id)
	  {
	    this.kill(id);
        return;
	  },
	//-------------------------------------- onUpdate
	onUpdate: function(action,id)
	  {
	    return;
	  },
		

		
  //--------------------------------------- expression
  expr: function(id)
    { 
    	try
     	  {
				  var E = this.list[id].domRef;
	        var ES = E.style;
	        
	        var width = parseInt(ES.width);
	        var height = parseInt(ES.height);
	        var top = parseInt(ES.top);
	        var left = parseInt(ES.left);
	        
	        var PR = Math.abs($$G.X - parseInt($$G.DOCKLEFT) - left - (this.maxSize*.5));
		
					if($$G.ACTIVE)
					  {
	            var SZ = Math.max(Math.ceil(this.maxSize - PR*this.scaleFactor),this.minSize);
	            ES.width = ES.height = SZ.toString() + 'px';
	            ES.zIndex = SZ;
	            ES.top = (parseInt($$G.DOCKHEIGHT) - SZ - 2*this.padding).toString() + 'px';
	          }
	        else // mouse has left dock; collapsing all
					  {
	            ES.width = ES.height = (Math.max(this.minSize, width - this.collapseRate)).toString() + 'px';
		          ES.top = (Math.min(this.maxSize - this.minSize, top + this.collapseRate)).toString() + 'px';
	            ES.zIndex = 10;	
		            
	            return(parseInt(width));
						}
				}
			catch(e) { }
				
	    return;
    },
//------------------------------------------------------- kill
  kill: function(id)
    {
      var cur = this.list[id].next;
      if(document.getElementById('DCK' + id).removeNode(false))
        {
          while(cur)
            {
              document.getElementById('DCK' + cur).style.left -= (this.minSize + this.padding); 
              cur = this.list[cur].next;
		        }
		      $$G.DOCKWIDTH = parseInt($$G.DOCKWIDTH) - (this.minSize + this.padding);
        }
	    return;
    },
			
  create: function(id)
    {
      this.list[id] = new $Link(id);
      return;
    },

  //----------------------------------------- mouseMove
  mouseMove: function(e)
    {
		  $$G.ACTIVE = true;
			  
	    var ev = e || window.event;

	    $$G.SE = (e) ? ev.target : ev.srcElement;
      $$G.SID = $$G.SE.id;
      $$G.X = ev.clientX;
      $$G.Y = ev.clientY;
		    
	    if($$G.SE.tagName == 'IMG')
	      {
			  	var curItem = $$G.SID.substr(3,$$G.SID.length);

	        $DOCK.expr(curItem);
		
	        var lastLeft = lastRight = curItem;
		      var DL = $DOCK.list;
  
	        while(lastLeft = DL[lastLeft].prev)
	          {
	          	$DOCK.expr(lastLeft);
	          }  
	          
	        while(lastRight = DL[lastRight].next)
	          {
	          	$DOCK.expr(lastRight);
	          }  
	      }
    },
			
	mouseOut: function(e)
	  {
	  	var ev = (e) || window.event;
		  	
	  	$$G.ACTIVE = false;
	  	$DOCK.cleanupStart();
		},
			
	mouseOver: function()
	  {	
		  $DOCK.cleanupStop();
		},
			
	mouseDown: function(e)
	  {
	  	var ev = (e) || window.event;
	  	
	  	if(($$G.SID != "DOCKBAR") && top.interfaceStarted)
	  	  {
          /*
           * we'll have current artist info stored
           * in _top.  All we need is imgPosition. so first break
           * the image path by subdirectory, and fetch img name
           *
           */
			  	var cIm = $$G.SID.split('\/');	
			  	var depth = cIm.length;
			  	var imInf = cIm[depth-1];
			  	
			  	imInf = imInf.replace('t_','');
			  	
			  	top.closeMenu();
			  	top.showPic(imInf);
			  	parent.showCurrentPanelInfo(imInf);
	  	  }
		},
			
	mouseUp: function(e)
	  {
	  	var ev = (e) || window.event;
		},
		
	cleanupCycle: null,
	
	cleanupStart: function()
	  {
      this.cleanupCycle = setInterval("$DOCK.cleanupPass()",25);
	  },
		  
	cleanupStop: function()
	  {
	  	clearInterval(this.cleanupCycle);
	  },
		  
	cleanupPass: function()
	  {
	   	var targetMin = this.minSize * this.count;
	   	var currMin = 0;
	    var cur = this.first;
		        
	    while(cur)
	      {
	        currMin += this.expr(cur);
	        cur = this.list[cur].next;
	      }
		        
	    /*
	     * if expr returns minSize on all dock items,
	     * stop the shrinking
	     */
	    if(currMin == targetMin)
	      {
	        this.cleanupStop();	
	      }
	   }
  };

