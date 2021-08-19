



 var admin_email = get_admin_email();
var admin_token = get_admin_pin();





function admin_get_form(div,args,event){
admin_email = get_admin_email();
admin_token = get_admin_pin();

toggle_model();
args = "e="+admin_email+"&t="+admin_token+"&"+args;
form_getter(div,args,event);

}

 

 
function admin_request(div,args,event){
	
admin_email = get_admin_email();
admin_token = get_admin_pin();

toggle_model();
args = "e="+admin_email+"&t="+admin_token+"&"+args;
request_sender(div,args,event);

}


function admin_all_users_request(div,arg,event){
	toggle_model();
	
	setTimeout(function(){
		admin_request(div,arg,event);
		
		div.style.display = "none";
		div.setAttribute("onclick",'');
		
	},1000);
	
	setTimeout(function(){
	document.getElementById("uload_more_error").scrollIntoView();
	},3000);
	
}


function admin_delete_ques_request(div,arg,event,div2){
	confirm_del_question = confirm("Do you really want to delete this question parmanently ?.");
	if(confirm_del_question){
		
	toggle_model();
	document.getElementById("model_body_div").innerHTML="";
	document.getElementById("modelError_top").innerHTML="";
	setTimeout(function(){
		admin_request(div,arg,event);
		 
		
	},1000);
	}
	 
}


function admin_block_or_unblock_request(div,arg,event,div2){
	toggle_model();
	
	setTimeout(function(){
		admin_request(div,arg,event);
		
		div.style.display = "none";
		div.setAttribute("onclick",'');
		
	},1000);
	
	setTimeout(function(){
	document.getElementById(div2).scrollIntoView();
	},3000);
	
}




var cat_of_edith_ques='';
function edith_question(event){
	
	event.preventDefault();
	
	cat_of_edith_ques = document.getElementById("category_ques_edith").value;
	
	location = "all_questions.html?cat="+cat_of_edith_ques;
	localStorage.setItem("current_category_edith",cat_of_edith_ques);
	
	
}

function get_current_category(){
	//return localStorage.getItem("current_category_edith");
	return  location.search.match(/cat=(\w+)&{0,}/)[1];
	 
}