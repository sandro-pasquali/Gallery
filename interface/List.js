
// ---------------------------------------------------------------------------- $Link constructor

function $Link(id)
  { 
    this.id = id || null;
	  this.next = null;
	  this.prev = null;
	  return;
  }
 
function $List(listDef)
  {
    this.count = 0; // contains total link count
    this.listDef = listDef || new Object();
	  for(p in this.listDef)
	    {
	      eval("this." + p + " = this.listDef." + p);
	    }
    this.list = new Array();
    this.first = null;
	  this.last = null;
	  return;
  }

//----------------------------------------------------------------------------- initialize customizable methods

$List.prototype.draw  = function(){;};
$List.prototype.onChange  = function(){;};
$List.prototype.onUpdate  = function(){;};

//----------------------------------------------------------------------------- create

$List.prototype.create = function(id)
  {
    this.list[id] = new $Link(id);
    return;
  }
	
//----------------------------------------------------------------------------- push

$List.prototype.push = function(id)
  {
    if(!this.list[id])
      {
	      this.create(id); 
        this.list[id].next = this.first; 
		    this.list[id].prev = null; 
	      this.first = id; 
		    this.last = (this.list[id].next == null) ? id : this.last; 
		    ++this.count;
	    }		
    return;
  }
	
//----------------------------------------------------------------------------- append

$List.prototype.append = function(id)
  { 
	  if(!this.list[id])
	    {
	      if(this.first == null) { this.push(id); } 
		    else
		      {
	          this.create(id); 
			      this.list[id].prev = this.last; 
			      this.list[id].next = null; 
		        this.list[this.last].next = id; 
			      this.last = id; 
			      ++this.count;
		      }
	    }
	  return;
  }
	
//----------------------------------------------------------------------------- insert

$List.prototype.insert = function(id,next)
  {
	  if(!this.list[id] && this.list[next])
	    {
	      if(next == this.first) { this.push(id); }
	      else 
	        {
			      this.create(id); 
	          this.list[this.list[next].prev].next = id;
			      this.list[id].prev = this.list[next].prev;
			      this.list[next].prev = id;
			      this.list[id].next = next;
			      ++this.count;
		      }
	    }
	  return;
  }
	
//----------------------------------------------------------------------------- move

$List.prototype.move = function(id,targ,before)
  {
    if(this.list[id] && this.list[targ] && (id != targ))
	    {
	      var _I = this.list[id];
		    var _T = this.list[targ];
	      var I_N = _I.next;
		    var I_P = _I.prev;
		    var T_N = _T.next;
		    var T_P = _T.prev;
	      
		    // unlink id
		    if(this.last == id)
		      {
		        this.list[I_P].next = null;
			      this.last = I_P;
		      }
		    else if(this.first == id)
		      {
		        this.list[I_N].prev = null;
			      this.first = I_N;
		      }
		    else
		      {
		        this.list[I_P].next = I_N;
			      this.list[I_N].prev = I_P;
		      }
					
		    // now re-link
		    if(before)
		      {
		        if(T_P != id)
			        {
		            _I.next = targ;
			          _I.prev = T_P;
		            _T.prev = id;
								
			          if(T_P) { this.list[T_P].next = id; }
			          else { this.first = id; }
			       }
		      }
		    else
		      {
		        if(T_N != id)
			        {
		            _I.next = _T.next;
			          _I.prev = targ;
			          _T. next = id;
			          if(T_N) { this.list[T_N].prev = id; }
			          else { this.last = id; }
			        }
		      }
	    }
	  return;
  }
	
//----------------------------------------------------------------------------- remove

$List.prototype.remove = function(id)
  {
    if(this.list[id])
	    {
	      if(this.first == id) 
		      { 
		        this.first = this.list[id].next;
			      if(this.first) { this.list[this.first].prev = null; } 
		      }
        else if(this.last == id) 
		      { 
		        this.last = this.list[id].prev;
			      if(this.last) { this.list[this.last].next = null; }
		      }
		    else
		      {
		        this.list[this.list[id].prev].next = this.list[id].next;
			      this.list[this.list[id].next].prev = this.list[id].prev;
		      }
		   delete(this.list[id]);
		   --this.count;
	   }
	  return;
   }
	 







