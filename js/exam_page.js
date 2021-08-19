var total_exam_num ;
var quest_counter = 0;
var current_question_displayed = 0;
function slide_exam(num){
	//console.log(num);
	total_exam_num = document.getElementsByClassName("exam_question").length;
	quest_counter = 0;
	
	while(quest_counter <total_exam_num){
		
		document.getElementsByClassName("exam_question")[quest_counter].style.display="none";
	
	quest_counter++;
	}
	 
		 document.getElementsByClassName("exam_question")[num].style.display="block";
 
	
	
	current_question_displayed = num;
	return true;
	
}

slide_exam(0);
var current_number = 0;
function  forward_question( ){
	total_exam_num = document.getElementsByClassName("exam_question").length;
	current_number = Number(current_number)+1;
	document.getElementById("back_question").style.display="inline";
	if(current_number < 0){
		current_number = 0;
		
	}
	else if(current_number >= total_exam_num ){
		current_number = Number(total_exam_num)-1;
		
	document.getElementById("forward_question").style.display="none";
	}
	
	
	if(current_number < 0){
		current_number = 0;
		
	}
		if(total_exam_num !=0){
	slide_exam(current_number);
}
}


function  backward_question(){
	total_exam_num = document.getElementsByClassName("exam_question").length;
	
	document.getElementById("forward_question").style.display="inline";
	current_number = Number(current_number)-1;
	
	if(current_number < 0){
		current_number = 0;
		
	document.getElementById("back_question").style.display="none";
	}
	else if(current_number >= total_exam_num ){
		current_number =  total_exam_num ;
		
	}
	if(total_exam_num !=0){
		
	slide_exam(current_number);
	}
}



var answers_store = {};
var answer_index;
var answer_value;
var answer_name;
function  on_check(div){
	document.getElementById("question_bottom_index_"+current_question_displayed).setAttribute("class","col-md-1 answered");
	answer_index = div.getAttribute("num");
	answer_value = div.getAttribute("value");
	answer_name = div.getAttribute("name");
	answers_store[answer_name+"_("+answer_index+")"] = answer_value;
	
}


var seconds_time= "start";
var min_time= "start";
var self_submit="false";

function timing(min,sec,min_div,sec_div){
	//for the first call of the function 
	//seconds_time = sec-1;
	//for the subsequent call of the function 
	//seconds_time = seconds_time-1;
	
	
	if(seconds_time=="start"){
		
		seconds_time = sec-1;
	
	}else{
		seconds_time = seconds_time-1;
	
		
	}
	
	
	
	// subtract one from mins once secods is zero
	if(seconds_time==0){
		  if(min_time=="start"){
		
		min_time = min-1;
	
	}
	
	else{
		min_time = min_time-1;
	 	
	}
	
	
	if(min_time<0){
		
		min_time = 0;
	
	}
	
	document.getElementById(min_div).innerHTML=min_time;
		
	}
	
	
	
	
	if(seconds_time<0){
		  
		seconds_time = 59;
		  if(min_time=="start"){
		
		min_time = min-1;
	
	}
	else{
		min_time = min_time-1;
	 	
	}
	
		
		
	}
	
	
	
	
		
		if(min_time<0){
		
		min_time = 0;
	
	}
		
		
		/* 
	setTimeout(function(){
		document.getElementById(min_div).innerHTML=min_time;
		
		
		}, 60000 ); */
	
	
	if( self_submit=="true" ){
	//if((seconds_time==0 && min_time==0) || ( self_submit=="true")){
		 document.getElementById("hidden_submit").click();
		 document.getElementById("all_ques_body").innerHTML="<h3 align='center'    style='margin-top: calc(30% - 30px);margin-left: calc(50% - 30px);' >Test Ended </h3>";
		 document.getElementById("submit_or_start_new").innerHTML= '<button type="button"  success="model_body_div" error="modelError_top"  class="btn btn-primary btn-lg"   onclick=edith_details(this,"action=takeTest",event)  > Take Another Test </button>';
		 
	}
	else if((seconds_time==0 && min_time==0) ){
		
		setTimeout(function(){timing(min,sec,min_div,sec_div);},1000);
		
	setTimeout(function(){
		self_submit = "true" ;
		
		}, 60000 );
		
	}
	
	
	else if(seconds_time==0 ){
		setTimeout(function(){timing(min,sec,min_div,sec_div);},1000);
		seconds_time = 60;
	}else {
		setTimeout(function(){timing(min,sec,min_div,sec_div);},1000);
	}
	document.getElementById(sec_div).innerHTML=seconds_time;
	
}


var sureSubmit;
function submit_by_yourself(){
	
	sureSubmit = confirm("Your about to submit this test.");
	if(sureSubmit){
	
self_submit="true"	;  
//document.getElementById("hidden_submit").click();
		 //document.getElementById("all_ques_body").innerHTML="<h3 align='center'  style='margin-top: calc(50% - 30px);margin-left: calc(50% - 30px);' >Test Ended </h3>";
		 //document.getElementById("submit_or_start_new").innerHTML= '<button type="button"  success="model_body_div" error="modelError_top"  class="btn btn-primary btn-lg"   onclick=edith_details(this,"action=takeTest",event)  > Take Another Test </button>';
		 
	}
	
	
}
