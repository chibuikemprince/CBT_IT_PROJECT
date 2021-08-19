<?php
require_once("conn.php");



$response = array();

 if(isset($_POST['t']) && isset($_POST['e']) ){
	 
	$errors='';
	 
	 $token = free($_POST['t']) ;
	 $email_get = free(($_POST['e'])) ;
 
 $user_details_store = user_details($email_get,"token",$token);
 
 	 //$response['ssss']=$user_details_store;
	
 if($user_details_store!=false){
	 $id = $user_details_store['id'];
$wraped_id = $str_alph.$id.$str_alph2.$str_alph ;
	 
	 
	 
if(isset($_POST['category'])){
	$category =  free($_POST['category']);
	
	
	if(strlen($category)==0 )
	{ 
$errors .="<p class='error'> Please select your question category </p>";
	
	}
	else{
		
		
		preg_match("/(\d+)/",$category,$category_ar);
		$category = $category_ar[1];
	
		
		
		
	}
	
	if(!get_category_name($category)){
		
		$errors .="<p class='error'> Select a valid category. </p>";

	}
	
	
	if(strlen($errors)==0 ){
		 $myquest_stage = get_current_question_state($email_get);
	  	 if($myquest_stage==false){
			
		$sql=" INSERT INTO  `pre_test` (`email`, `current_stage`, `date_string`, `id`) VALUES('".$email_get."','NULL','".time()."',NULL)";	
		$query = mysqli_query($db_con,$sql);	
		}
		else{
			 
			
		}
		
		$cat_query = $str_alph.$str_alph.$category.$str_alph2;
		 $response['redirect']= "exam.php?cat=".$cat_query."&i=".$wraped_id."&t=".$token;
		
		//"exam.php?cat="+cat_of_edith_ques+"&e="+get_user_email+"&t="+get_user_pin;
	 
		
	}
	else{
		$response['error'] = $errors;
		
	}
	
	
	
	
	
}//isset category
	 
	 
	 
	 
	 
	 
	 
	 
	 
 }//user confirmed
 
 else{
	 
	 $response['error']=" <p class='error'>It seems you have been logged out. <a href='index.html'> Click here to login </a> </p>";
	 
 }
 
 }//isset
 
 
 else{
	 
	 $response['error']=" <p class='error'>It seems you have been logged out. <a href='index.html'> Click here to login </a> </p>";
	 
 }
 
 		
echo json_encode($response);

mysqli_close($db_conn);
?>