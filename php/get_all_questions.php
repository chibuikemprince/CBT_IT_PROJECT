
 <?php

//admin_add_category
//upload_question

require_once("conn.php");



$response = array();

 if(isset($_POST['t']) && isset($_POST['e']) ){
	 
	 
	 $token = free($_POST['t']) ;
	 $email_get = free(($_POST['e'])) ;
 
 $user_details_store = user_details($email_get,"token",$token);
  
  
 if( confirm_admin_login($email_get,$token)  )
 
 {
	 
	 if(isset($_POST['start'])  ){
		 $start = free($_POST['start']);
		 $response['more']='';
	 }
	 else{
		 $start = 0;
	 }
	 
	 
	 
	 
	 
	 if(isset($_POST['action'])  ){
		 
		 $uid = free($_POST['action']);
		 
		 
		 
		preg_match("/(\d+)/",$uid ,$uid_ar);
		$uid  = $uid_ar[1];
	
		 
		 /*  $check_if_email_already_registered =  mysqli_query($db_con,"SELECT * FROM users WHERE id ='".$uid."'  ORDER BY id DESC LIMIT 1" );

if(mysqli_num_rows($check_if_email_already_registered)==1 ){
	
	 */
	
	$sql="SELECT * FROM questions WHERE `category_id` ='".$uid."'";
	$get_question = mysqli_query($db_con,$sql);
	if($get_question){
		
		$total_ques = mysqli_num_rows($get_question);
		$output = "<div class='rows'>";
		if($start==0){
		$output .= "<div class='col-md-12 each_user_div_title'><h2 align='center' class='success' >Category: ".get_category_name($uid)." ( ".$total_ques." )</h2> </div>";	
		}
		
		
		if(mysqli_num_rows($get_question)>0 ){
		while($ques_ar = mysqli_fetch_assoc($get_question) ){
			$txt =  $ques_ar['question_text'] ;
			$opt1 = $ques_ar['option1'];
			$opt2 = $ques_ar['option2'];
			$opt3 = $ques_ar['option3'];
			$ans = $ques_ar['answer'];
			$qid = $ques_ar['id'];
			
			
			$output .="<div class='cols-md-8 each_user_div' id='quet_".$qid."'> <h4 align='center'> ".$txt."</h4>"; 
			$output .=" <h4 align='center'>Option 1: ".$opt1."</h4>"; 
			$output .=" <h4 align='center'>Option 2: ".$opt2."</h4>"; 
			$output .=" <h4 align='center'>Option 3: ".$opt3."</h4>"; 
			$output .=" <h4 align='center'>Answer:   ".$ans."</h4> "; 
			/* $output .=" </div>";  */
			$output .="<h4 align='center' id='quet_p_".$qid."'> </h4>";
			$output .="<h4 align='center'> ";
			
		$output .="<button style=' font-size:12px;' url='delete_questions' success='quet_".$qid."' error='quet_p_".$qid."'  class='btn btn-primary btn-lg'   onclick=admin_delete_ques_request(this,'action=".$qid."',event)>Delete</button> ";
		$output .="<button style='margin-left:15px;font-size:12px;' url='edith_questions'  success='model_body_div' error='modelError_top'  class='btn btn-primary btn-lg'   onclick=admin_get_form(this,'action=edith_questions&qid=".$qid."',event) >Edith</button>  </h4> </div>";
		
		
			}
		
		$output .="</div>";
		
		}
		else{
		$output = " <p class='success'>No question was found in this category <a href='admin_page.html'> Click here to upload questions </a> </p>";	
			
		}
		
		
		
		
		
		
		
		
		$response['success'] =  $output;
	}
 	 
		 
	 }//action
	 
	 
	 
	 
 }//admin is confirmed
 
 
 }//isset
 
 
 else{
	 
	 $response['error']="It seems you have been logged out. <a href='admin_login.html'> Click here to login </a>";
	 
 }
 
 
 
echo json_encode($response);

mysqli_close($db_conn);


 