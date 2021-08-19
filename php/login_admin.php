<?php 


require_once("conn.php");



$response = array();

 if(isset($_POST['p']) && isset($_POST['e']) ){
	 
	 
	 $password_get = sha1(free($_POST['p'])) ;
	 $email_get = free(($_POST['e'])) ;
	 
	 
	 if( confirm_admin_login($email_get,$password_get) )
	 {
		  
$response['success']= "Validation Completed . Please Wait...";
$response['redirect']= "admin_page.html";
	
$response['email_save_admin']= $email_get;
	  $response['token_save_admin']= $password_get;
	

		 
	 }
	else{
		
		$response["error"]="<p class='error errors'> Invalid Login Data </p>";
		
	}


 
}

echo json_encode($response);





mysqli_close($db_con);

?>