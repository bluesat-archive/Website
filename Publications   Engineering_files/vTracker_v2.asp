
//resetProactive=False, lastwebsite=c1_0_4376
    //alert('lastchat_cookie=');
    

var embed_departmentid = '5150';

// JS functions needed.

function URLEncode(plaintext)	
{
	// The Javascript escape and unescape functions do not correspond
	// with what browsers actually do...
	var SAFECHARS = "0123456789" +					// Numeric
					"ABCDEFGHIJKLMNOPQRSTUVWXYZ" +	// Alphabetic
					"abcdefghijklmnopqrstuvwxyz" +
					"-_.!~*'()%";					// RFC2396 Mark characters
                    								//6-1-2013 edit by dustin - added %, filters it out to prevent error, fix later
	var HEX = "0123456789ABCDEF";

	//var plaintext = document.URLForm.F1.value;
	var encoded = "";
	for (var i = 0; i < plaintext.length; i++ ) {
		var ch = plaintext.charAt(i);
	    if (ch == " ") {
		    encoded += "%20";				// x-www-urlencoded, rather than %20
		} else if (SAFECHARS.indexOf(ch) != -1) {
		    encoded += ch;
		} else {
		    var charCode = ch.charCodeAt(0);
			if (charCode > 255) {
				encoded += "%20";
			} else {
				encoded += "%";
				encoded += HEX.charAt((charCode >> 4) & 0xF);
				encoded += HEX.charAt(charCode & 0xF);
			}
		}
	} // for

	//document.URLForm.F2.value = encoded;
	plaintext = encoded;
	return plaintext;
};





//----------------------------------------------------------------
// keep on page


function callServer(url) {

	var sRn=Math.random();

	var wsa_head_obj = document.getElementsByTagName('head').item(0);
	var old  = document.getElementById('vtracker');
	if (old){
		if (old.readyState=="loading"){	//let the old script complete
			return;
		}
		wsa_head_obj.removeChild(old);
	}
	try{

		var s	= document.createElement('script');
		url		= url + '&random=' + sRn;
		
		s.src	= url;
		s.type	= 'text/javascript';
		s.defer = true;
		s.id	= 'vtracker';
		void(wsa_head_obj.appendChild(s));
		
	}catch(e){
		
	return;
	}
}


// keep on page
function pollVisitor()
{	

	var url = document.location.protocol + "//tracking.websitealive.com/vTrackerSrc_v2.asp?action=poll&objectref=c1&groupid=4376&websiteid=0&departmentid=0&sessionid_=127926752&grouponline=N&online_acd=N&autoproactiveenabled=N&timeonthispage=5%2F5%2F2015+9%3A00%3A02+PM" + urlstr;
    
	callServer(url);
       
}		



//This function gets the sessiontimeout set by admin. If visitor has left page open longer then sessiontimeout, then they will stop pinging the server.
// keep on page
function checkProcess(landingTime)
{
	
	var sessiontimeout = 1800;
	
	var newTime = new Date();
	var tDiff = (newTime - landingTime) / 1000; // diff in seconds
	
	//alert(tDiff);
	if ((sessiontimeout == 0) || (sessiontimeout > tDiff))	//if no timeout or still active
	{
		pollVisitor();	//keep processing;
	}else{
		//do nothing		
	}	
	
}

function hideProactivePopUp(){
	
    if (document.getElementById('wsa_div')){
    
        var obj = document.getElementById('wsa_div');
        
        obj.style.display 		= 'none';
        obj.style.visibility 	= 'hidden';	
        
    }

}

var embed_open = 'N';



function fireUpProactive(websiteid,departmentid,sessionid_,proactive_parameters,inviteURL){

   	if (embed_open == 'N'){	//startproactive. only if the lastaction is blank. do not want to open proactive if embed is already open.
     
  		//check if proactive pop up is there already.
        var obj = document.getElementById('wsa_div');
        
        if (obj == null){
        
            var sRn=Math.random();
            
            var wsa_head_obj = document.getElementsByTagName("head")[0];         
            var jsNode = document.createElement('script');
            jsNode.type	= 'text/javascript';
            jsNode.defer = true;
            
            
            jsNode.src = document.location.protocol + '//tracking.websitealive.com/vTracker_JS.asp?action=startproactive&objectref=c1&groupid=4376&websiteid=' + websiteid + '&departmentid='+departmentid+'&sessionid_=' + sessionid_ + '&websiteid_x='+websiteid+'&departmentid_x='+departmentid + proactive_parameters+'&random=' + sRn;
            
            jsNode.id	= 'proactive_js';
            
            
            wsa_head_obj.appendChild(jsNode);
    	}    //end if
        
        
        
	}
	
}


//called when you open embedded chat with invite URL ONLY

function wsa_open_chat_invite(websiteid,departmentid,inviteURL){

	var sRn=Math.random();
	
	var wsa_head_obj = document.getElementsByTagName("head")[0];         
	var jsNode = document.createElement('script');
	jsNode.type	= 'text/javascript';
	jsNode.defer = true;
    
	embed_open = 'Y';
    
    
    jsNode.src = document.location.protocol + '//tracking.websitealive.com/vTracker_JS.asp?action=wsa_open_chat&objectref=c1&groupid=4376&websiteid=0&inviteURL='+URLEncode(inviteURL)+'&random=' + sRn;
    
    jsNode.id	= 'embed_js';
    wsa_head_obj.appendChild(jsNode);  
    
    setTimeout("hideProactivePopUp();",500);
}

function clicktrack(button_tag)
{	
	var url = document.location.protocol + '//tracking.websitealive.com/vTrackerSrc_v2.asp?action=clicktrack&button_tag=' + button_tag;
	callServer(url);
}


function detect_mobile() { 
 if( navigator.userAgent.match(/Android/i)
 || navigator.userAgent.match(/webOS/i)
 || navigator.userAgent.match(/iPhone/i)
 || navigator.userAgent.match(/iPad/i)
 || navigator.userAgent.match(/iPod/i)
 || navigator.userAgent.match(/BlackBerry/i)
 || navigator.userAgent.match(/Windows Phone/i)
 ){
    return true;
  }
 else {
    return false;
  }
}



function wsa_open_chat(websiteid, departmentid, button_tag, code_id){

	var sRn=Math.random();
	
	var wsa_head_obj = document.getElementsByTagName("head")[0];         
	var jsNode = document.createElement('script');
	jsNode.type	= 'text/javascript';
	jsNode.defer = true;
    
	embed_open = 'Y';

	//if no code_id is passed, make sure its empty string.
	if (!(code_id)){
    	code_id = '';
    }
   
    if (detect_mobile()){
    	
        var url_chatstart = '';
        
		if (url_chatstart == '' ){	//if regular call
       
        	url_chatstart = document.location.protocol + '//c1.websitealive.com/4376/rRouter.asp?groupid=4376&departmentid='+embed_departmentid+'&websiteid=0&loginname=&loginquestion=&code_id=' + code_id;
            
            
        }
        
        window.open(url_chatstart);
            
            
            
            
            
    }else{
        
        jsNode.src = document.location.protocol + '//tracking.websitealive.com/vTracker_JS.asp?action=wsa_open_chat&objectref=c1&groupid=4376&websiteid=0&departmentid=' + departmentid + '&sessionid_=127926752&embeddedTriggered=False&code_id=' + code_id + '&random=' + sRn;
        
        jsNode.id	= 'embed_js';
        wsa_head_obj.appendChild(jsNode);  
        
    }
       
    
    setTimeout("hideProactivePopUp();",500);
    
    if (!(button_tag)){
    	button_tag = '0';
    }

    clicktrack(button_tag);	
	
}

function wsa_open_tab(websiteid,departmentid){

	

	var sRn=Math.random();
	
	var wsa_head_obj = document.getElementsByTagName("head")[0];         
	var jsNode = document.createElement('script');
	jsNode.type	= 'text/javascript';
	jsNode.defer = true;
    
	embed_open = 'Y';
        
    jsNode.src = document.location.protocol + '//tracking.websitealive.com/vTracker_JS.asp?action=wsa_open_tab&objectref=c1&groupid=4376&websiteid=0&embeddedTriggered=False&random=' + sRn;
    

    
    jsNode.id	= 'embed_js';
    wsa_head_obj.appendChild(jsNode);  
    
   
		
    //setTimeout("hideProactivePopUp();",500);	
	
}



// asp code free - ON PAGE ON PAGE, loads if there is a div_embed id, calls the createWsaEmbedDiv() function
// this fires up only if you have a button there.

var wsa_embed_html = '';
var wsa_embed_x;
var wsa_embed_y;
var wsa_embed_position;
var wsa_embed_zIndex;

function start_embed(){

	var wsa_embed_obj = document.getElementById('wsa_embed');
	
   
    
	if (wsa_embed_obj){
		
        //if there is element on page by user, dont do nothing. save the text in variable wsa_embed_html
        wsa_embed_html = wsa_embed_obj.innerHTML;
        
        wsa_embed_position 	= wsa_embed_obj.style.position;
        wsa_embed_x 		= wsa_embed_obj.style.left;
        wsa_embed_y 		= wsa_embed_obj.style.top;
        wsa_embed_zIndex	= wsa_embed_obj.style.zIndex;
       	wsa_embed_zIndex = '100000';
		 
	}else{
	
		//creatediv if none there
		createWsaEmbedDiv('wsa_embed');
		document.getElementById('wsa_embed').className = 'wsa_box plustransparentborder';
        
        var wsa_embed_obj = document.getElementById('wsa_embed');
		
	}
    

	//alert('go!');
}




// ON PAGE, loads if there is a div_embed id
function createWsaEmbedDiv(divid){

	
    
	var W3CDOM = (document.createElement && document.getElementsByTagName);
	if (W3CDOM)
	{
		var wsa_embed_obj = document.createElement("DIV");
		wsa_embed_obj.id = divid;
		
		
        if (window.ActiveXObject)
		{
			wsa_embed_obj.style.overflowX = 'hidden';
			wsa_embed_obj.style.overflowY = 'hidden';
		}
		else
		{
			wsa_embed_obj.style.overflow = 'hidden';
		}

		wsa_embed_obj.style.zIndex = '10000';

		var ee_body = document.getElementsByTagName("BODY")[0];
		ee_body.insertBefore(wsa_embed_obj,null);
	}
		
}

//cookie functions
function getCookie(c_name)
    {
    
    c_name = c_name + '_4376';
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i < ARRcookies.length;i++)
    {
      x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
      y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
      x=x.replace(/^\s+|\s+$/g,"");
      
      
      if (x == c_name)
        {
        return unescape(y);
        }
      }
    }
        
function setCookie(c_name,value,exdays)
    {
    	//alert('setcookie');
        
        var exdate=new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
        document.cookie=c_name + "_4376=" + c_value;
    }







// Main()

// Initial page info
var rf = document.referrer.toString();
var dl = document.location.toString();
var dt = document.title.toString();

//dl = "�,�,�,�,�,�,�,�,�,�,�,�,�,�";
//dt = "�,�,�,�,�,�,�,�,�,�,�,�,�,�";

var urlstr = "&dt=" + URLEncode(dt) + "&dl=" + URLEncode(dl) + "&rf=" + URLEncode(rf) + "&wsa_custom_str=" + "^^^^";

// Global vars for tracker and timer
var writeHTMLBool = false;
var timerIDWSA;






// Global object to hold drag information.
var browser;
var dragObj;
	
var globalMouseDown = false;
var global_embed_X = 0;
var global_embed_Y = 0;

//only one interval at a time.
var applyfloatInterval;





start_embed();


                wsa_open_tab(0,embed_departmentid);
				