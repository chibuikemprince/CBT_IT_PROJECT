
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
	
if(isset($_POST['name'])){
	
	$category =  free($_POST['name']);
	
	if(strlen($category)>0 )
	{
		
		
		if(!is_category_exist("name",$category)){
		
		$sql = "INSERT INTO  `categories` (`name`, `creator_email`, `status`, `date_string`, `id`) VALUES ('".$category."', '".$email_get."', 'confirm', '".time()."', NULL)";
		$query = mysqli_query($db_con,$sql);
		
		if($query){
			
			$response['success'] = $category."  category has been created successfully";
		}
		else{
			$response['success'] = $category."<p class='success'> create request failed. please try again. </p>";
	
			
		}
		
	}
	else{
		
		$response['error'] = "<p class='error errors'>".$category." Category Already Exist.</p>";
	}
	
		
	}
	else{
		
		$response["error"]="<p class='error'> Please enter the name your category </p>";
	}
	
	
	
}// isset category name
	
	
 }// confirm login admin
 
 
 else{
	 
	 $response['error']="It seems you have been logged out. <a href='admin_login.html'> Click here to login </a>";
	 
 }
 
 
 }//isset 
 
echo json_encode($response);

mysqli_close($db_conn);


?>