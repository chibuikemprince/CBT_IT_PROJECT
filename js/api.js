
  
	 var  form_to_submit ;
	  
	  var submitter_url ;
  var	length_for_inner ; 
var	counter_form_children ;
  
  var length_for_success ;
  var counter_form_success;
 function form_submitter(div,event) {
 
   
   
   
 
	  event.preventDefault();
	  
 
 
  
	  form_to_submit = new FormData(document.getElementById("form_getter"));
submitter_url = document.getElementById("form_getter").getAttribute("url");
 	  
$.ajax({
	
	//url: "image_upload.php",
	url: "php/"+submitter_url+".php",
type: "POST",
data: form_to_submit,
 
contentType: false,
cache: false,
processData:false,
beforeSend : function()
{ 
//show preview
	  document.getElementById(div.getAttribute("error")).innerHTML='';
			 /*  document.getElementById("spinner").style.display="block";
 */


hide_elements("spinner");
			  
},
success: function(data)
{
	 

hide_elements("spinner");
		  
			 /*  document.getElementById("spinner").style.display="none";
			 */   data = JSON.parse(data);
			   
			    if(data.hasOwnProperty("redirect")){

setTimeout(function(){ location = data.redirect;},1000);
				   
			   }
			   
			   
				   if(data.hasOwnProperty("fill")){
					   
					   
					   setTimeout(function(){document.getElementById(div.getAttribute("fill")).innerHTML= data.fill;
					   //console.log(data.fill);
					   },1000);
				   }
				   if(data.hasOwnProperty("success")){
					   
					   if(data.hasOwnProperty("clear_model")){
						   
						   setTimeout(function(){
							   
							toggle_model();    
					   },2100); 
					   }
					   
				  
				   if(data.hasOwnProperty("email_save")){
					    localStorage.setItem("email",data.email_save);
				   }
				   
				    
				   
				   if(data.hasOwnProperty("token_save")){
					    localStorage.setItem("pin",data.token_save);
				 
				  }
				   
				   
 
  if(data.hasOwnProperty("email_save_admin")){
					    localStorage.setItem("email_admin",data.email_save_admin);
				   }
				   
				   
				   if(data.hasOwnProperty("token_save_admin")){
					    localStorage.setItem("pin_admin",data.token_save_admin);
				 
				  }
 
 
 
 

				   
				    document.getElementById(div.getAttribute("error")).innerHTML= "<p style='color:green'>"+data.success+"</´p>";
				     document.getElementById(div.getAttribute("error")).scrollIntoView();
			 			/* 
						setTimeout(function(){
					length_for_success = document.getElementsByClassName("success").length;
						counter_form_success = 0;
						
						while( counter_form_success < length_for_success){
						 document.getElementsByClassName("success")[counter_form_success].innerHTML='';
						 	counter_form_success++;
						
						}
						
				   },5000);
				   //end setTimeout
						
						
						 */
						}
			   else if(data.hasOwnProperty("error")){
				   
				   document.getElementById(div.getAttribute("error")).innerHTML=  data.error ;
				    document.getElementById(div.getAttribute("error")).scrollIntoView();
				
				//setTimeout(function(){document.getElementById(div.getAttribute("error")).innerHTML='';},6000);
			  
			  
			  
			  }
			   
			   
			   
			   
},

error: function(e)
{
		   document.getElementById(div.getAttribute("error")).innerHTML="Internet Connection Failed. Pls try again.";
					 
			 /*  document.getElementById("spinner").style.display="none";
		 */
		 

hide_elements("spinner");
		
		document.getElementById(div.getAttribute("error")).scrollIntoView();
							  	 
}	
	
	
	
	
});


   
   
	
	
	
	
	}//submit function


var  form_getter_xHR;
var form_getter_xHR_data;
 
 function form_getter(div,args,event) {
 
   
   /* 

sample

<div error='error_div' success='suc_div'>
   */
   
 document.getElementById(div.getAttribute("error")).innerHTML='';
 document.getElementById(div.getAttribute("success")).innerHTML='';
	
show_elements("spinner","block"); 
			 
			 
	  event.preventDefault();
	  
 
 
 
 
 if(window.XMLHttpRequest)
	{ 


	 form_getter_xHR = new XMLHttpRequest();
form_getter_xHR.open("POST","php/form_getter.php",true);
		//form_getter_xHR.setRequestHeader('Access-Control-Allow-Origin','*');
		 form_getter_xHR.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		 form_getter_xHR.setRequestHeader('X-Requested-with','XMLHttpRequest');
		
		 form_getter_xHR.onreadystatechange=function(){
		
		 if(form_getter_xHR.readyState==2 ){
			 

document.getElementById(div.getAttribute("error")).innerHTML='';
			  

			 
			   }
			 else if(form_getter_xHR.readyState==4 && form_getter_xHR.status!=200)
			 {


		   document.getElementById(div.getAttribute("error")).innerHTML="Internet Connection Failed. Pls try again.";
			


hide_elements("spinner");			
			 /*  document.getElementById("spinner").style.display="none";
		 */
		document.getElementById(div.getAttribute("error")).scrollIntoView();
			




		 }
			 
			  else{
				 if(form_getter_xHR.readyState==4 && form_getter_xHR.status==200)
				 {
					 
					 
hide_elements("spinner");


 form_getter_xHR_data = form_getter_xHR.responseText;


			    form_getter_xHR_data = JSON.parse(form_getter_xHR_data);
					 
					 
			    if(form_getter_xHR_data.hasOwnProperty("redirect")){

setTimeout(function(){ location = form_getter_xHR_data['redirect'];},1000);
	


			   }
			   
			   
				   if(form_getter_xHR_data.hasOwnProperty("success")){
					   
					 



				   
				    document.getElementById(div.getAttribute("success")).innerHTML= form_getter_xHR_data['success'];
				     document.getElementById(div.getAttribute("success")).scrollIntoView();
			 			
						
						}
			   else if(form_getter_xHR_data.hasOwnProperty("error")){
				   
				   document.getElementById(div.getAttribute("error")).innerHTML=  form_getter_xHR_data['error'] ;
				    document.getElementById(div.getAttribute("error")).scrollIntoView();
					
			  }
			   
			   
					 
					 
					 
				 }
				 // if readyState=4 && status ==200
				 
			  }// else if no error
			 
			 
			 
			
		
		
		
		
		
		
		 }//onreadystatechange
		
		
		form_getter_xHR.overrideMimeType("text/plain; charset=utf-8");
	//new_chat_xHR.overrideMimeType("application/json; charset=utf-8");//used to define a definit header for the returned result..read ajax.txt
	form_getter_xHR.send(args);
	
		
		

	}//windows
 
 
 
 
 
 
	
	
	
	}//submit function
 


 
 function request_sender(div,args,event) {
 
   
   /* 

sample

<div url='error_div' error='error_div' success='suc_div'>
   */
   
   if(document.getElementById(div.getAttribute("error"))!=null){
					 document.getElementById(div.getAttribute("error")).innerHTML='';
			 
					 
				 }
				 
				 
   
   
  /* 
 document.getElementById(div.getAttribute("error")).innerHTML='';
 document.getElementById(div.getAttribute("success")).innerHTML='';
 */
	  event.preventDefault();
	  
  
 if(window.XMLHttpRequest)
	{ 


	 request_getter_xHR = new XMLHttpRequest();
request_getter_xHR.open("POST","php/"+div.getAttribute("url")+".php",true);
		//request_getter_xHR.setRequestHeader('Access-Control-Allow-Origin','*');
		 request_getter_xHR.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		 request_getter_xHR.setRequestHeader('X-Requested-with','XMLHttpRequest');
		
		 request_getter_xHR.onreadystatechange=function(){
		
		 if(request_getter_xHR.readyState==2 ){
			 /* 
			 if(document.getElementById(div.getAttribute("error"))!=null ){
				 
console.log(div.getAttribute("error"));

			 }

 */ 
				 
				 if(document.getElementById(div.getAttribute("error"))!=null){
					 document.getElementById(div.getAttribute("error")).innerHTML='';
			 
					 
				 }
				 
				  
			 
			 
			  

show_elements("spinner","block"); 
			 
			 
			 
			   }
			 else if(request_getter_xHR.readyState==4 && request_getter_xHR.status!=200)
			 {
if(document.getElementById(div.getAttribute("error"))!=null){
					  document.getElementById(div.getAttribute("error")).innerHTML="Internet Connection Failed. Pls try again.";
		
					 
				 }
				 

		  	


hide_elements("spinner");			
			 /*  document.getElementById("spinner").style.display="none";
		 */
		document.getElementById(div.getAttribute("error")).scrollIntoView();
			




		 }
			 
			  else{
				 if(request_getter_xHR.readyState==4 && request_getter_xHR.status==200)
				 {
					 
					 
hide_elements("spinner");

request_getter_xHR_data = request_getter_xHR.responseText;

			    request_getter_xHR_data = JSON.parse(request_getter_xHR_data);
					 
					 
			    if(request_getter_xHR_data.hasOwnProperty("redirect")){

setTimeout(function(){ location = request_getter_xHR_data['redirect'];},1000);
	


			   }
			   
			   
				   if(request_getter_xHR_data.hasOwnProperty("success")){
					   
					 



				   if( request_getter_xHR_data.hasOwnProperty("more")  )
				   {
					
					if(document.getElementById(div.getAttribute("success"))!=null){
					   document.getElementById(div.getAttribute("success")).innerHTML += request_getter_xHR_data['success'];
				   
					 
				 }



					
				   }
				   else{
					

if(document.getElementById(div.getAttribute("success"))!=null){
					    
				    document.getElementById(div.getAttribute("success")).innerHTML= request_getter_xHR_data['success'];
				     document.getElementById(div.getAttribute("success")).scrollIntoView();
			 		 
					 
				 }



					
					
				   }	
						
						
						
						
						
						}
			   else if(request_getter_xHR_data.hasOwnProperty("error")){
				   
				   if(document.getElementById(div.getAttribute("success"))!=null){
					    
					document.getElementById(div.getAttribute("error")).innerHTML=  request_getter_xHR_data['error'] ;
				    document.getElementById(div.getAttribute("error")).scrollIntoView();
				 
				 }

	
			  
			  
			  
			  
			  }
			   
			   
					 
					 
					 
				 }
				 // if readyState=4 && status ==200
				 
			  }// else if no error
			 
			 
			 
			
		
		
		
		
		
		
		 }//onreadystatechange
		
		
	
		request_getter_xHR.overrideMimeType("text/plain; charset=utf-8");
	//new_chat_xHR.overrideMimeType("application/json; charset=utf-8");//used to define a definit header for the returned result..read ajax.txt
	request_getter_xHR.send(args);
		
		
		

	}//windows
 
 
 
	
	
	
	}//submit function
 

function hide_elements(elem){
	
    if ($('#'+elem).length) {
      $('#'+elem).delay(300).fadeOut('slow', function () {
        //$(this).remove();
		document.getElementById(elem).style.display="none";
		
      });
    }
  

 
	
	
};




function show_elements(elem,disp){
	
	// spinner 
    if ($('#'+elem).length) {
      $('#'+elem).delay(100).fadeIn('slow', function () {
        //$(this).remove();
		document.getElementById(elem).style.display=disp;
		
      });
    }
   

 
	
	
};


 
 
 function toggle_model(){
	 
	 document.getElementById("modelshow").click();
	 
	 
	 
 }





function get_user_email(){
	return localStorage.getItem("email");
	
}


function get_user_pin(){
	return localStorage.getItem("pin");
	
}




function get_admin_email(){
	return localStorage.getItem("email_admin");
	
}


function get_admin_pin(){
	return localStorage.getItem("pin_admin");
	
}








function recover_onload(){
	if(location.search.match(/recover=recover/)){
		
		document.getElementById("login_btn_user").click();
		
		setTimeout(function(){
			document.getElementById("forgot_details_login_btn_user").click();
			
		},500);
		
		
	}
	
}





function take_text_form_submit(event){
	
	event.preventDefault();
	
	cat_of_edith_ques = document.getElementById("category_ques_edith").value;
	
	location = "exam.php?cat="+cat_of_edith_ques+"&e="+get_user_email+"&t="+get_user_pin;
	 
	
}





