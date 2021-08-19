
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
	
if(isset($_POST['ques_txt'])  &&  isset($_POST['category']) &&  isset($_POST['category'])&&  isset($_POST['option1'])&&  isset($_POST['option2'])&&  isset($_POST['option3'])&&  isset($_POST['answer']) ){
	
	$category =  free($_POST['category']);
	$option1 =  free($_POST['option1']);
	$option2 =  free($_POST['option2']);
	$option3 =  free($_POST['option3']);
	$answer =  free($_POST['answer']);
	$question =  free($_POST['ques_txt']);
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
	
	
	
	
	
	if( strlen($error)==0){
		$sql="INSERT INTO  `questions` (`creator_email`, `question_text`, `status`, `option1`, `option2`, `option3`, `answer`, `category_id`, `date_string`, `id`) VALUES ('".$email_get."', '".$question."', 'confirm', '".$option1."', '".$option2."', '".$option3."', '".$answer."', '".$category."', '".time()."', NULL)";
		$query = mysqli_query($db_con,$sql);
		
		if($query){
		$response['success'] = "<p class='success'> Question uploaded successfully. </p>";	
		}
		else {
		$response['success'] = " <p class='error'> Question upload failed.</p> ";	
		}
		
		
	}
	else{
		
		$response['error'] = $error;
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