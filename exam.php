<?php
require_once("php/conn.php");

$no_question_found = "false";

$response = array();
$output = '';
 if(isset($_GET['t']) && isset($_GET['i']) && isset($_GET['cat']) ){
	 
	$errors='';
	 
	 $token = free($_GET['t']) ;
	 $id = free(($_GET['i'])) ;
	 $cat_id = free(($_GET['cat'])) ;
 
 preg_match("/(\d+)/",$cat_id ,$cat_id_ar);
		$cat_id  = $cat_id_ar[1];
	
 
 preg_match("/(\d+)/",$id ,$id_ar);
		$id  = $id_ar[1];
	
 
 
 $check_if_email_already_registered =  mysqli_query($db_con,"SELECT * FROM users WHERE id ='".$id."' && token='".$token."' ORDER BY id DESC LIMIT 1" );
 


if(mysqli_num_rows($check_if_email_already_registered)==1 ){
	
	
$email = mysqli_fetch_assoc($check_if_email_already_registered)['email'];
$current_id = get_current_question_state($email);
if($current_id=="NULL"){
	
	$current_id = 0;
}
$current_id = intval($current_id);
 
/* $sql_all = "SELECT * FROM questions WHERE category_id ='".$cat_id."' LIMIT ".$current_id.",10"; */
$sql_all = "SELECT * FROM questions WHERE category_id ='".$cat_id."'";
$query_all = mysqli_query($db_con,$sql_all);

$total_row_all = mysqli_num_rows($query_all);

if($current_id>=$total_row_all){
	
	$current_id = 0;
	 $sql_u  = "UPDATE  `pre_test` SET `current_stage` = 'NULL' WHERE `email` = '".$email."'";
 		 $query = mysqli_query($db_con,$sql_u); 
		
	
	
}


 $sql  = "SELECT * FROM questions WHERE category_id ='".$cat_id."' LIMIT ".$current_id.",10";  
 
$query  = mysqli_query($db_con,$sql_all);


$total_question = mysqli_num_rows($query);

if(mysqli_num_rows($query)>0){
	
$all_question_array = array();
	$question_counter = 1;
	
	if($total_question<10){
		$total_question = 1;
	}
	while($total_question<=10){
		
		$sql  = "SELECT * FROM questions WHERE category_id ='".$cat_id."'";  
 
$query  = mysqli_query($db_con,$sql_all);

while($each_question = mysqli_fetch_assoc($query) ){
	if($total_question>10){
		break;
	}
	$question_txt = $each_question["question_text"];
	$question_id = $each_question["id"];
	$option = array();
	$option[0] = $each_question["option1"];
	$option[1] = $each_question["option2"];
	$option[2] = $each_question["option3"];
	$option[3] = $each_question["answer"];
  shuffle($option);
	
	
	
	$output ='
	<p style="word-break: break-all">  '.$question_txt.' </p>
	 
	<ul class="list all_question_list">
	<li style="" >
	<a href="#" >
	<input type="radio" name="question_'.$question_counter.'"  num="'.$question_id.'" onclick="on_check(this)"  value="'.$option[0].'"  >A:  '.$option[0].'</a>
	</li>
	<li style=""><a href="#"> 
	<input type="radio"  name="question_'.$question_counter.'"  num="'.$question_id.'" onclick="on_check(this)" value="'.$option[1].'">B:  '.$option[1].' </a>
	</li>  <li style="">
	<a href="#"> <input type="radio" name="question_'.$question_counter.'"  num="'.$question_id.'" onclick="on_check(this)"  value="'.$option[2].'">C:  '.$option[2].' </a>
	</li><li style=""><a href="#">
	<input type="radio"  name="question_'.$question_counter.'"  num="'.$question_id.'" onclick="on_check(this)" value="'.$option[3].'" >D:  '.$option[3].' </a></li>
	</ul>
	 
	 
        		';
				$all_question_array[]=$output;
				$output='';
	//$all_question_array[$question_counter]=$output;
	  $question_counter++ ;
$total_question ++;		
}//loop 2

		  shuffle($all_question_array);
	
	}
	
	
}
else{
	
	$output = " <div class='item'><div class='testi_item exam_question'> <h4>   <p class='success'> No question was found in this category. </br> </br> </br>  <button type='button' success='model_body_div' error='modelError_top' class='btn btn-primary btn-lg' onclick=edith_details(this,'action=takeTest',event)> Change Category </button></p> </h4> </div> </div>";
	$no_question_found = "true";
}



 }
 else{
	 //die("good");
	 
	 header("Location: index.html");
	 
	 
 }
 
 }



 	 

mysqli_close($db_conn);
?>
 
 

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test</title>
       

<link href="soesit_lib/css/soesit_boot_core.css" rel="stylesheet"/>

<link href="css/soesit_spinner.css" rel="stylesheet"/>
<link href="css/soesit_style_api.css" rel="stylesheet"/>
<link href="css/basic.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"/>
 
<script src="soesit_lib/js/soesit_jcore.js"> </script>
<script src="soesit_lib/js/soesit_boot_core.js"> </script>
<script src="js/api.js"> </script> 
<script src="js/edith_details.js"> </script>
<script src="js/reg_and_login.js"> </script>





	   <link type="text/css" href="css/exam_page_theme.css" rel="stylesheet">
             
			 
			 <style>
			 ul,ol{
			 padding:0px;
			 margin:0 0 10px 25px;
			width:300px;
			 }
			 .widget-menu>li+li {
    border-top: 1px solid #555;
    
}


.all_question_list > li{
	margin-top:16px;
	
}


.all_question ul{
	
	margin-left:30%;
	
}





a.list-a-admin{
padding:30px;
    font-size: 1.3em;
    font-family: cursive;
}

.item{border: 1px solid black;
    outline: 1px dotted black;
	margin-left:170px;
	}
.testi_item{
padding:20px;
}

li{

list-style:none;}


.notanswered{
	text-align:center;
	background-color:#ccc;
	box-shadow:1px 1px 1px black;
	color:black;
	margin-right:2px;
	
}
	
.answered{
	margin-right:2px;
	text-align:center;
	background-color:#248aaf;
	box-shadow:1px 1px 1px black;
	color:white;
	
}
			 </style>
    </head>
    <body> 

	
	  
<div id="spinner" >

<div class="sk-three-bounce"  style=" ">
<h2 id="ready_question_counter" style="font-family:cursive;"> TEST LOADING ...</h2>
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
      </div>
</div>

	
	<div class="wrapper">
            <div class="container">
                <div class="row">
				
				
                    <div class="col-md-3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active">
								
								<a href="account.html" class="list-a-admin ">
								
								
								
								<button type="button"  class="btn btn-primary btn-lg"   > Dashboard </button>
  
								
								
                                </a>
								
								
								</li>
                                <?php
                                
								
				if($no_question_found != "true")
				{
					
								echo '<li><a class="list-a-admin" id="submit_or_start_new">
								 
								<button type="button"  success="model_body_div" error="modelError_top"  class="btn btn-primary btn-lg"   onclick="submit_by_yourself()"  > Submit  </button>
   
									
									</a>
									</li>
									<li >
								<a href="#" class="list-a-admin" style="height:200px;margin:0px;">
								 Time Left <br/><br/><br/>
								<button type="button"  id="test_min"   class="btn btn-primary btn-lg"     > 9 </button>Mins
								<button type="button"  id="test_sec"    class="btn btn-primary btn-lg"     > 60 </button>Secs
   
									</a></li>
									';
									
									}
                                ?>
								
								 
									
									
									
									
									
									
									
                            </ul>
                            <!--/.widget-nav-->
                            
                             
						</div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->
                    
					<!-- s -->
					<div class='col-md-8'>
					
				   <section class="">
        	<div class="container">
        		<div class="testi_slider owl-carousel exam_question_slide" id="all_ques_body">
        			 
				<?php
				$question_numbers_i = '';
				$total_question_in_array = count($all_question_array);
				  foreach($all_question_array as $quesvalue => $myques){
					$quesvalue_index_num = intval($quesvalue)+1;
					
					echo '<div class="item exam_question"><div class="testi_item">
	<h4>'.$quesvalue_index_num.' of '.$total_question_in_array.'</h4>'.$myques."</div> </div>";
				
				$question_numbers_i .= '<div id="question_bottom_index_'.$quesvalue.'" class="col-md-1 notanswered"  style="cursor:pointer;margin-top:5px;" onclick=slide_exam('.$quesvalue.')>'.$quesvalue_index_num.'</div>';
				
				}
				
				if($no_question_found == "true")
				{
					
					
					echo $output ;
				
					
					
				}
				  
				?>
				
				
				<?php
				
				if($no_question_found != "true")
				{
					
				echo '<div class="item" >
				<i class="fa fa-backward" style="margin-left:59px;padding:16px;font-size:22px;"  onclick="backward_question()" id="back_question"></i>
				
				<i class="fa fa-forward" style="    margin-left: 70px; padding:16px;font-size:22px;"  onclick="forward_question()"  id="forward_question" ></i>
				</div>
				 <br/>
				 <br/>
				 <br/>
				 <div class="row" style="margin-left:170px;">
				  '.$question_numbers_i.'
				 </div>
				
				';
				 
				
				
					
				}else{
					 
					
				}
				
				?>
				
				
				
				
				</div>
        	</div>
			
        </section>
     
					
					 
					
					</div>
					<!-- span 9 -->
                </div>
            </div>
            <!--/.container-->
        </div>
        
		
		
		
		<button type="button" style="display:none;" id="modelshow" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" ></button>
  
<!-- Modal -->
<div  style="top: 0px; background:#eee;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content"   style="background:url(images/bg.jpg);background-size:cover;background-repeat:no-repeat;">
	
      <div class="modal-header" style="padding-bottom:2px;border:none;background-color:#ffffffb5;"">
	   
	  
	    
	   <button type="button" class="close" data-dismiss="modal" aria-label="Close" align="right" style="display:block;">
	   <span aria-hidden="true" style="font-weight:900;text-shadow:2px 2px 2px black;" id="close_conversation_portal">&times;</span></button>
      
	 
	  
	  
         
	   
	  
	  </div>
	  
          
      <div class="modal-body" style="    background-color:#ffffffdb;" >
	   
   <h5 align="center" style="text-align:center;" id="modelError_top"> </h6>
	 	
		
		 <p class="mt-4 pr-lg-5" style="padding-button:40px;font-size:1.2em;background:#ffffffe6;display:block;padding: 100px;" id="model_body_div" > 
		    
					 
		 
		 
					</p>
		
		 <div   style="padding:10px; background:#ffffffe6;display:none; " id="img_model" > 
		 		
					 	 
 
					
					
		</div>
		
		
		
		
		
		
		
		<!--  </div> -->
      </div>
	  <p id="top_textarea_error_p" style="color:red;margin-right:60px;margin-left:60px;"></p>
	 
	  <div class="modal-footer" id="modelfooter">
	  
	   
		<button type="button" class="btn btn-default" id="send_chat_btn" onclick="document.getElementById('modelshow').click();" >Close</button> 
 <!--      
<a href="#gallery_model_top" class="back-to-top" onclick="document.getElementById('gallery_model_top').scrollIntoView();" style="display: none;"><i class="fa fa-chevron-up"></i></a>
-->

	       </div>
    </div>
  </div>

 
 
<button type="button" style="display:none" id="hidden_submit" success="model_body_div" error="modelError_top" url="examiner" class="btn btn-primary btn-lg" onclick="get_details(this,'action='+JSON.stringify(answers_store)+'&min='+min_time+'&sec='+seconds_time,event)"></button>


<script>
	// spinner
  $(window).on('load', function () {

 //
  setTimeout(function(){
	  document.getElementById("ready_question_counter").innerHTML="Get Ready  ";
  },1000);
 
 setTimeout(function(){
	  document.getElementById("ready_question_counter").innerHTML="3";
  },2000);
 
  
setTimeout(function(){
	  document.getElementById("ready_question_counter").innerHTML="2";
  },3000);
 
  
  
setTimeout(function(){
	  document.getElementById("ready_question_counter").innerHTML="1";
  },3600);
 
  
  
  
  
  
  
setTimeout(function(){
hide_elements("spinner");

if(document.getElementById("test_min")!=null ){
	document.getElementById("ready_question_counter").innerHTML="";
  
	
timing(9,60,"test_min","test_sec");

}

  },4000);
 
 
});


</script>

<script src="js/exam_page.js"> </script>
    </body>
