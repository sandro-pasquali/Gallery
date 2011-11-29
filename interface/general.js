function scrollTop()
  {
    var top = 0;
  	if (window.innerHeight)
      {
	    top = window.pageYOffset;
      }
    else if (document.documentElement && document.documentElement.scrollTop)
      {
	    top = document.documentElement.scrollTop;
      }
    else if (document.body)
      {
	    top = document.body.scrollTop;
      }
    return(top);
  }
	  
function scrollLeft()
  {
    var left = 0;
  	if (window.innerWidth)
      {
	    left = window.pageXOffset
      }
    else if (document.documentElement && document.documentElement.scrollLeft)
      {
	    left = document.documentElement.scrollLeft;
      }
    else if (document.body)
      {
	    left = document.body.scrollLeft;
      }
    return(left);
  }
			
function getWindowSize() 
  {
    var w = 0;
    var h = 0;
    
    if(typeof(window.innerWidth)=='number' ) 
      {
        //Non-IE
        w = window.innerWidth;
        h = window.innerHeight;
      } 
    else if(document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight )) 
      {
        //IE 6+ in 'standards compliant mode'
        w = document.documentElement.clientWidth;
        h = document.documentElement.clientHeight;
      }
    else if(document.body && (document.body.clientWidth || document.body.clientHeight )) 
    	{
        //IE 4 compatible
        w = document.body.clientWidth;
        h = document.body.clientHeight;
      }
    return({width:w,height:h}); 
  }
					
function findPosX(obj)
{
	var curleft = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curleft += obj.offsetLeft
			obj = obj.offsetParent;
		}
	}
	else if (obj.x)
		curleft += obj.x;
	return curleft;
}

function findPosY(obj)
{
	var curtop = 0;
	if (obj.offsetParent)
	{
		while (obj.offsetParent)
		{
			curtop += obj.offsetTop
			obj = obj.offsetParent;
		}
	}
	else if (obj.y)
		curtop += obj.y;
	return curtop;
}  

  