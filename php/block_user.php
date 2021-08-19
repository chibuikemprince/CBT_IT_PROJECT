
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
	 }else{
		 $start = 0;
	 }
	 if(isset($_POST['action'])  ){
		 
		 $uid = free($_POST['action']);
		 
		 
		 
		preg_match("/(\d+)/",$uid ,$uid_ar);
		$uid  = $uid_ar[1];
	
		 
		  $check_if_email_already_registered =  mysqli_query($db_con,"SELECT * FROM users WHERE id ='".$uid."'  ORDER BY id DESC LIMIT 1" );

if(mysqli_num_rows($check_if_email_already_registered)==1 ){
	
	
	
	$sql="UPDATE  `users` SET `status` = 'blocked' WHERE  `id` ='".$uid."'";
	$update = mysqli_query($db_con,$sql);
	if($update){
		$response['success'] = "User has been blocked successfully.";
		
	}
}
		 
		 
	 }//action
	 
	 
	 
	 
 }//admin is confirmed
 
 
 }//isset
 
 else{
	 
	 $response['error']="It seems you have been logged out. <a href='admin_login.html'> Click here to login </a>";
	 
 }
 
 
 
echo json_encode($response);

mysqli_close($db_conn);


 