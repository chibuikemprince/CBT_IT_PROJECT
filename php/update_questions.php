
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
	
if(isset($_POST['ques_txt'])  &&  isset($_POST['qid'])&&  isset($_POST['category']) &&  isset($_POST['category'])&&  isset($_POST['option1'])&&  isset($_POST['option2'])&&  isset($_POST['option3'])&&  isset($_POST['answer']) ){
	
	$category =  free($_POST['category']);
	$option1 =  free($_POST['option1']);
	$option2 =  free($_POST['option2']);
	$option3 =  free($_POST['option3']);
	$answer =  free($_POST['answer']);
	$question =  free($_POST['ques_txt']);
	$qid =  free($_POST['qid']);
	$cat_id_original = $category;
	$error = '';
	  if(strlen($question)==0 )
	{ 
$error="<p class='error'> Please enter your question </p>";
	
	}
	 
	
	if(strlen($category)==0 )
	{ 
$error .="<p class='error'> Please select your question category </p>";
	
	}
	else{
		
		
		preg_match("/(\d+)/",$category,$category_ar);
		$category = $category_ar[1];
	
		$cat_id_original = $category;
		
		
	}
	
	
	if(!get_category_name($category)){
		
		$error .="<p class='error'> Select a valid category. </p>";

	}
	
	
	 if(strlen($option1)==0 )
	{ 
$error .="<p class='error'> Please enter option 1 </p>";
	
	}
	 if(strlen($option2)==0 )
	{ 
$error .="<p class='error'> Please enter option 2 </p>";
	
	}
	 if(strlen($option3)==0 )
	{ 
$error .="<p class='error'> Please enter option 3 </p>";
	
	}
	 if(strlen($answer)==0 )
	{ 
$error .="<p class='error'> Please enter answers to this question </p>";
	
	}
	
	$sql="SELECT * FROM questions WHERE `id` ='".$qid."' LIMIT 1";
	$get_question = mysqli_query($db_con,$sql);
	
	if(mysqli_num_rows($get_question)==1 ){
		
	
	
	if( strlen($error)==0){
      $sql="UPDATE  `questions` SET `question_text` =  '".$question."', option1='".$option1."',  option2='".$option2."',  option3='".$option3."', answer='".$answer."', category_id='".$category."' WHERE `questions`.`id` = '".$qid."'";
		$query = mysqli_query($db_con,$sql);
		
		//get_info_from_question after update
		$sql="SELECT * FROM questions WHERE `id` ='".$qid."' LIMIT 1";
	$get_question = mysqli_query($db_con,$sql);
	
		
		
		
		if($query){
			while($ques_ar = mysqli_fetch_assoc($get_question) ){
			$txt =  $ques_ar['question_text'] ;
			$opt1 = $ques_ar['option1'];
			$opt2 = $ques_ar['option2'];
			$opt3 = $ques_ar['option3'];
			$ans = $ques_ar['answer'];
			$qid = $ques_ar['id'];
			$cat_id_current = $ques_ar['category_id'];
			}
			
			
			
			
			$output='';
			
			$output .=" <h4 align='center'> ".$txt."</h4>"; 
			$output .=" <h4 align='center'>Option 1: ".$opt1."</h4>"; 
			$output .=" <h4 align='center'>Option 2: ".$opt2."</h4>"; 
			$output .=" <h4 align='center'>Option 3: ".$opt3."</h4>"; 
			$output .=" <h4 align='center'>Answer:   ".$ans."</h4> "; 
			 
			$output .="<h4 align='center' id='quet_p_".$qid."'> </h4>";
			$output .="<h4 align='center'> ";
			
		$output .="<span style=' font-size:12px;' url='delete_questions' success='quet_".$qid."' error='quet_p_".$qid."'  class='btn btn-primary btn-lg'   onclick=admin_request(this,'action=".$qid."',event)>Delete</span> ";
		$output .="<span style='margin-left:15px;font-size:12px;' url='edith_questions'  success='model_body_div' error='modelError_top'  class='btn btn-primary btn-lg'   onclick=admin_get_form(this,'action=edith_questions&qid=".$qid."',event) >Edith</span>  </h4>  ";
		
			
			if($cat_id_original == $cat_id_current){
				
			$response['fill']  = $output;
				
			}
			else{
				
				
				$response['fill']  = "<h4 class='success'>Question has been moved to ".get_category_name($cat_id_current)." category</h4>";
			
				
			}
			
			$response['clear_model']  = "";
		$response['success']  = "<p class='success'> Question updataed successfully. </p>";	
		}
		else {
		$response['success'] = " <p class='error'> Question update failed.</p> ".$sql;	
		}
		
		
	}
	else{
		
		$response['error'] = $error;
	}
	
	}//question_isset
	else{
		
		
	$response['error'] = "<p class='error'> This question does not exit or has been removed . </p>";	
	}
	
	
	
}// isset category name
	
	
 }// confirm login admin
 
 
 
 
 
 }//isset 
 
 else{
	 
	 $response['error']="It seems you have been logged out. <a href='admin_login.html'> Click here to login </a>";
	 
 }
 
echo json_encode($response);

mysqli_close($db_conn);


?>