
			
	var embed_appearauto, embed_openortab, embed_tabimageurl, embed_position, embed_icon_position_top, embed_icon_position_leftright, embed_position_top, embed_position_leftright, embed_dropshadow, style_body_transparent, embed_slideout, embed_wborder_thickness;
	var window_width, window_height, window_posX, window_posY;
    
	
    
     
    embed_appearauto 			= 'X';
    embed_openortab				= 'tab';
    embed_tabimageurl 			= 'https://images.websitealive.com/images/hosted/upload/72669.png';
    embed_tabimageurl_newmsg 	= 'https://images.websitealive.com/images/hosted/default/tabs/set1/orange/br_alert.png';
    embed_position				= 'right';
    embed_icon_position_top				= '5';
    embed_icon_position_leftright		= '5';
    embed_position_top			= '0';
    embed_position_leftright	= '0';
    embed_tab_top 				= 0;
    embed_tab_leftright 		= 0;
    embed_dropshadow 			= 'N';
    style_body_transparent 		= 'N';
    embed_slideout 				= 'Y';
	embed_wborder_thickness		= '6';
	
	window_width 				= 450;
	window_height 				= 400;
    window_posX 				= 100;
	window_posY 				= 100;
	embed_departmentid 			= 5150;
    embed_slideout = 'N'; //disable for ALL 10/30/14

	//javascript functions
    
    function setCookie(c_name,value,exdays)
		{
        	//alert('setcookie: ' + c_name + '_4376=' + value);
            
			var exdate=new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
			document.cookie = c_name + "_4376=" + c_value;
		}

	function insertCSS(){
	
    	var rnd = Math.random();
    
		var wsa_head_obj = document.getElementsByTagName("head")[0];         
		var cssNode = document.createElement('link');
		cssNode.type = 'text/css';
		cssNode.rel = 'stylesheet';
		cssNode.href = document.location.protocol + '//tracking.websitealive.com/CSS/dragdiv.css?random=' + rnd;
		cssNode.media = 'screen';
		wsa_head_obj.appendChild(cssNode);
        


	}
		
	insertCSS();

	function slideout_func_go(finalposition, embed_position_leftright, pos_leftorright){
        
    	if (finalposition != embed_position_leftright){	
        
        	
        	
            //0 <> -500
            if (embed_position_leftright < 0){
            	embed_position_leftright = embed_position_leftright + 50;
            }else{
            	embed_position_leftright = embed_position_leftright - 50;
            }
            
            if (pos_leftorright == 'left'){
	    		document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
            }else{
            	document.getElementById("wsa_embed").style.right = embed_position_leftright + 'px';
            }
            
            
            
            setTimeout("slideout_func_go("+finalposition+", " + embed_position_leftright + ",'" + pos_leftorright + "')", 50);
            
       }else{
       		//no need to slide, make sure position is right.
            
            if (pos_leftorright == 'left'){
	    		document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
            }else{
            	document.getElementById("wsa_embed").style.right = embed_position_leftright + 'px';
            }
       
       }
         
         
        
    }
    
   
	function slideout_func(embed_position_leftright, pos_leftorright){
    
    
  		
        if (window.jQuery && 'c1' != 'strayerchat' && false) {
        	
            if (pos_leftorright == 'left'){
	    		document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
            }else{
            	document.getElementById("wsa_embed").style.right = embed_position_leftright + 'px';
            }
            
           jQuery('#wsa_embed').hide().toggle('slide');
    		 		
             
        }else{
        
        	//no jquery slideout
            
            var finalposition = embed_position_leftright; 
            
            if (embed_position_leftright == 0){
                embed_position_leftright = -500;
            }

            slideout_func_go(finalposition, embed_position_leftright, pos_leftorright);
            
        }
        
        
        
        
    }	
    
	function open_embedded_chatwindowJS(reloadiframe, inviteURL){
        
        embed_open = 'Y';
      
        switch(embed_position) {
        
        	case 'left':
            	
                if (embed_slideout == 'Y'){
                	slideout_func(embed_position_leftright,'left');
                }else{
	                document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
                }
                
                //document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
                document.getElementById("wsa_embed").style.bottom = embed_position_top + 'px';
                
                break;
                
            case 'uleft':
            	
                if (embed_slideout == 'Y'){
                	slideout_func(embed_position_leftright,'left');
                }else{
	                document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
                }
                
                
                //document.getElementById("wsa_embed").style.left = embed_position_leftright + 'px';
                document.getElementById("wsa_embed").style.top = embed_position_top + 'px';
                
                break;
                
			case 'right':
      
      			if (embed_slideout == 'Y'){
                	slideout_func(embed_position_leftright,'right');
                }else{
	                document.getElementById("wsa_embed").style.right = embed_position_leftright + 'px';
                }
                
                
                //document.getElementById("wsa_embed").style.right = embed_position_leftright + 'px';
                document.getElementById("wsa_embed").style.bottom = embed_position_top + 'px';
                
                break;
                
            case 'uright':
      			
                if (embed_slideout == 'Y'){
                	slideout_func(embed_position_leftright,'right');
                }else{
	                document.getElementById("wsa_embed").style.right = embed_position_leftright + 'px';
                }
                
                document.getElementById("wsa_embed").style.top = embed_position_top + 'px';
                
                break;

        }
        
        
        
         
        document.getElementById('wsa_embed').cssText = '';
        document.getElementById('wsa_embed').style.backgroundImage = '';
        
      	if (embed_dropshadow == 'Y'){
	        document.getElementById('wsa_embed').className = 'wsa_box wsa_shadow plustransparentborder';
     	}else{
        
        	document.getElementById('wsa_embed').className = 'wsa_box plustransparentborder';
            
        } 

		/*
		document.getElementById("wsa_embed").style.visibility = 'visible';
        document.getElementById("wsa_embed").style.display = 'block';
   		*/
        
        
        
        document.getElementById("wsa_embed").style.position = 'fixed';
        
        
        document.getElementById("wsa_embed").style.width = window_width + 'px';
        document.getElementById("wsa_embed").style.height = window_height + 'px';
        
        
       
        
        
        document.getElementById("wsa_embed").style.border = embed_wborder_thickness + 'px solid rgba(214,214,214,0.6)';
		
        
		if (reloadiframe == true){
         //only call this if you are running for first time, not during maximize
        
        	//loads the iframe and some divs, but NO css
			loadChatWindowIframe(inviteURL);
	
		
        }
        
       
        
	}
	
	
	function loadChatWindowIframe(inviteURL){
		
        var url_chatstart
        
        if (inviteURL != ''){
        	url_chatstart = inviteURL
        }else{
        	if ('false' == 'true'){
	        	url_chatstart = '';
            }else{
            	url_chatstart = '';
            }
        }
         
        //alert('url_chatstart=' + url_chatstart);
        
		if (url_chatstart == '' ){	//if regular call
       
        	if ('' != '0'){	//if there is a departmentid in the parameter, always use that one.
            	embed_departmentid = '';
            	//drawback, user might want 0, but there is a embed_departmentid set. so, not sure what to do.
            }
            
			url_chatstart = document.location.protocol + '//c1.websitealive.com/4376/rRouter.asp?iniframe=embedded&groupid=4376&departmentid='+embed_departmentid+'&websiteid=0&loginname=&loginquestion=&code_id=';

		
        }
		
        //alert('url_chatstart=' + url_chatstart);
        
        createOpenChatDivsHTML();	

		
		document.getElementById("wsa_embed_iframe").src = url_chatstart;
		
       
        
	}
    
    function alertimage(){	//if new chat content, this will toggle the embedded icon to animate
    
       	var alertimg_url = embed_tabimageurl_newmsg;
        
        var newImg = new Image();
        newImg.src = alertimg_url;
        
        
        newImg.onload = function()  { 
			
		
        	var iheight = newImg.height;
			var iwidth 	= newImg.width;
            
            document.getElementById('wsa_embed').style.width 			= iwidth + 'px'; 
            document.getElementById('wsa_embed').style.height 			= iheight + 'px'; 
            document.getElementById('wsa_embed').style.backgroundImage 	= 'url('+alertimg_url+')';
            
       	
        }
			
        
    }
    
    //create wsa_embed_closeimg, wsa_embed_iframe, and wsa_embed_minimize_div elements. this is used when you open a chat window (initially), or tab.
    
    function createOpenChatDivsHTML(){
    		
            var embed_innerhtml = '';
            
            embed_innerhtml = '<img id="wsa_embed_closeimg" src="' + document.location.protocol + '//tracking.websitealive.com/images/icon_close_bw.png" onmouseover="this.src=\'' + document.location.protocol + '//tracking.websitealive.com/images/icon_close_embed_red.png\'" onmouseout="this.src=\'' + document.location.protocol + '//tracking.websitealive.com/images/icon_close_bw.png\'" onClick="closeEmbedFuncs()" style="border:0px; margin:0px; padding:0px; background-color: transparent; position:absolute; z-index:2; right:'+ embed_tab_leftright +'px; top:'+embed_tab_top+'px;  cursor:pointer;">';
    
    
           	//embed_innerhtml = embed_innerhtml + '<div style="border:1px solid black ">';
         
            
            embed_innerhtml = embed_innerhtml + '<iframe id="wsa_embed_iframe" style="width:'+window_width+'px; height:'+ window_height +'px; background-color:#FFFFFF;" allowtransparency="true" frameborder="0" scrolling="no" src="' + document.location.protocol + '//tracking.websitealive.com/dummy.htm"></iframe>';
            
           // embed_innerhtml = embed_innerhtml + '</div>';
            
      
            //wsa_embed_minimize_div container for new minimize button later.
            embed_innerhtml = embed_innerhtml + '<div id="wsa_embed_minimize_div"></div>';
            
            document.getElementById('wsa_embed').innerHTML = embed_innerhtml;
    
    }
	
    
    function wsa_close_embed(){
    
    	var wsa_embed_obj = document.getElementById('wsa_embed');
        
        if (wsa_embed_html != ''){
                   
        	wsa_embed_obj.innerHTML 		= wsa_embed_html;
            
            wsa_embed_obj.style.display 	= 'block';
			wsa_embed_obj.style.visibility 	= 'visible'; 
             
            wsa_embed_obj.style.left 		= wsa_embed_x;
            wsa_embed_obj.style.top 		= wsa_embed_y;
            wsa_embed_obj.style.position	= wsa_embed_position;
            wsa_embed_obj.style.zIndex		= wsa_embed_zIndex;       
            
            wsa_embed_obj.className 		= '';   
            
            clearInterval(applyfloatInterval);        
        
        }else{
        
        	wsa_embed_obj.innerHTML = '';
        	wsa_embed_obj.style.display 	= 'none';
			wsa_embed_obj.style.visibility 	= 'hidden'; 
        
        }
        
        embed_open = 'N';
        
    }
    
    function closeEmbedFuncs(){
    	
       
        //setCookie('tab_status','minimized',1);
        
    	setTimeout("wsa_close_server();",100);
        wsa_decline_cw_request();
            
    }
    
    function wsa_close_server(){	// when you click on close button, checks server and see if there is a session. if still chatting, it will minimize.
    	//minimize_embed();
        
        var url = document.location.protocol + '//tracking.websitealive.com/vTracker_Server.asp?action=closeembedwin&objectref=c1&groupid=4376&websiteid=0&embed_appearauto=' + embed_appearauto;
        callServer(url);
        
        
    }
    
    function wsa_decline_cw_request(){
    
    
    	if ('' != ''){
        
        	//only if this is proactive request, there should be a sessionid_

	    	var url = document.location.protocol + '//tracking.websitealive.com/vTrackerSrc_v2.asp?action=decline_cw&objectref=c1&groupid=4376&sessionid_=';
    	    callServer(url);
        }
    }
    
    
    
    
	function minimize_embed(){
    
    	//set the cookie know the state of the button
        
        
        //alert('chrome');
        
		     
        embed_open = 'N';
       
        // create minimize button
		//var img_close_tab_url = embed_tabimageurl + '?rand=' + new Date().getTime();
        
        var img_close_tab_url = embed_tabimageurl;
        var newImg = new Image();
        newImg.src = img_close_tab_url;
        
        
        newImg.onload = function()  { 
			

					
			var iheight = newImg.height;
			var iwidth 	= newImg.width;

            // ============= SET UP WSA_EMBED =======================
            
            document.getElementById('wsa_embed').className = 'wsa_box plustransparentborder';
            
            document.getElementById('wsa_embed').style.display = 'block';
            document.getElementById('wsa_embed').style.visibility = 'visible';

            switch(embed_position) {
        
                case 'left':
                    
                    document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; bottom:' + embed_icon_position_top + 'px; left:' + embed_icon_position_leftright + 'px; border:0px solid red; background-image:url('+img_close_tab_url+');';
                    
                    //update, 0 padding for icon. need new variable to allow adjustment to icon padding. default 0
                    
                    //document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; bottom:0px; left:0px; border:0px solid red; background-image:url('+img_close_tab_url+');';
                    
                    break;
                    
                case 'uleft':
                    
                    document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; top:'+ embed_icon_position_top +'px; left: ' + embed_icon_position_leftright + 'px; border:0px solid red; background-image:url('+img_close_tab_url+');';
                    
                    //document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; top:0px; left:0px; border:0px solid red; background-image:url('+img_close_tab_url+');';
                    
                    break;
                    
                case 'right':
          
                    document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; bottom:' + embed_icon_position_top + 'px; right: ' + embed_icon_position_leftright + 'px; border:0px solid red; background-image:url('+img_close_tab_url+'); z-index:100000';
                    
                    //document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; bottom:0px; right:0px; border:0px solid red; background-image:url('+img_close_tab_url+'); z-index:100000';
                    
                    
                    break;
                
                case 'uright':
          
                    document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; top:'+ embed_icon_position_top +'px; right:' + embed_icon_position_leftright +'px; border:0px solid red; background-image:url('+img_close_tab_url+'); z-index:100000';
                    
                    //document.getElementById('wsa_embed').style.cssText = 'cursor:pointer; width:' + iwidth + 'px; height:' + iheight + 'px; position: fixed; top:0px; right:0px; border:0px solid red; background-image:url('+img_close_tab_url+'); z-index:100000';
                    
                    break;
                    
                
                    
             }
             
             
             
            
            if (! document.getElementById('wsa_embed_closeimg')){	//only do this if icon appears initially. create the divs, but dont src the iframe for chat router
            
            	createOpenChatDivsHTML();
                
            }
            //close button hide
            
            document.getElementById('wsa_embed_closeimg').style.display = 'none';
            document.getElementById('wsa_embed_closeimg').style.visibility = 'hidden';
            
            //chat iframe hide
            document.getElementById('wsa_embed_iframe').style.display = 'none';
            document.getElementById('wsa_embed_iframe').style.visibility = 'hidden';

            //show bottom div with icon
            var minimize_div_html = '<div onclick="maximize_embed();" style="border:0px solid white;width:'+iwidth+'px; height:'+iheight+'px;"></div>';
            
            document.getElementById('wsa_embed_minimize_div').innerHTML = minimize_div_html;
            
            document.getElementById('wsa_embed_minimize_div').style.display = 'block';
            document.getElementById('wsa_embed_minimize_div').style.visibility = 'visible';
                    
            
            
            
        
        }// end onload
			

        
        
        
       
	}
	
    
	function maximize_embed(){
        
        var url_chatstart;
        
        
        
    	//setCookie('tab_status',undefined,0);
    	
        var url = document.location.protocol + '//tracking.websitealive.com/vTracker_Server.asp?action=deletetabstatus&objectref=c1&groupid=4376&websiteid=0';
        callServer(url);
        
        
        //if you max after initial tab is shown on page. it loads the chat.
        
        if (document.getElementById('wsa_embed_iframe').src == '' || document.getElementById('wsa_embed_iframe').src == document.location.protocol + '//tracking.websitealive.com/dummy.htm'){
        
        	if ('false' == 'true'){
	        	url_chatstart = '';
            }else{
            	url_chatstart = '';
            }
            
            
            
            if (url_chatstart == ''){
	        	url_chatstart = document.location.protocol + '//c1.websitealive.com/4376/rRouter.asp?iniframe=embedded&groupid=4376&departmentid='+embed_departmentid+'&websiteid=0&loginname=&loginquestion=&code_id=';

            }
        
            document.getElementById('wsa_embed_iframe').src = url_chatstart;
        
        	
        }
        
        
    	
        
        
        
        
        
        
        document.getElementById("wsa_embed").style.cssText = '';
        document.getElementById('wsa_embed_iframe').style.display = 'block';
        document.getElementById('wsa_embed_iframe').style.visibility = 'visible';
        
        document.getElementById('wsa_embed_minimize_div').style.display = 'none';
        document.getElementById('wsa_embed_minimize_div').style.visibility = 'hidden';
        
        document.getElementById('wsa_embed_closeimg').style.display = 'block';
        document.getElementById('wsa_embed_closeimg').style.visibility = 'visible';
        
        
        
        
        
        
        
        open_embedded_chatwindowJS(false, '');
                
      	
	}
	

        minimize_embed();
		