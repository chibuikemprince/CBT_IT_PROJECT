 
 
 var user_email = get_user_email();
var user_token = get_user_pin();


function edith_details(div,args,event){
user_email = get_user_email();
user_token = get_user_pin();

toggle_model();
args = "e="+user_email+"&t="+user_token+"&"+args;
form_getter(div,args,event);

}

 
function get_details(div,args,event){
	
user_email = get_user_email();
user_token = get_user_pin();

toggle_model();
args = "e="+user_email+"&t="+user_token+"&"+args;
request_sender(div,args,event);

}





