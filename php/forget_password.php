<?php 


require_once("conn.php");



$response = array();

 if(  isset($_POST['e']) ){
	 
	 
	 //$password_get = sha1(free($_POST['p'])) ;
	 $email_get = free(($_POST['e'])) ;
	 $arg =  "'e=".$email_get."'";
	if(strlen($email_get)!=0 )
	{
	 $check_if_email_already_registered =  mysqli_query($db_con,"SELECT email,token FROM users WHERE email ='".$email_get."'   ORDER BY id DESC LIMIT 1" );
	 






 if(mysqli_num_rows($check_if_email_already_registered)==0 ){
		   $response['error'] ="<p class='error'> Hey , we did not recognize this email , please the email on your account </p>";

}

else{

  $password_recovery_word_tomail = strtoupper(bin2hex(openssl_random_pseudo_bytes(16,$true)) );
 
 $onehr = 60*60*1;
 $tday  =  intval(time()) ;
 $expiry_date =  $tday+$onehr;
 
 $sql= "SELECT email FROM password_recovery WHERE email='".$email_get."'";
 $select_if_recovery_exist = mysqli_query($db_con,$sql);
 
 if(mysqli_num_rows($select_if_recovery_exist)==0){
	 //insert
	 $sql = "INSERT INTO  `password_recovery` (`email`, `recovery_token`, `date_string`, `expiry_date`, `id`) VALUES ('".$email_get."', '".$password_recovery_word_tomail."', '".time()."', '".$expiry_date."', NULL)";
 // $response['jj']="SELECT email FROM password_recovery WHERE email='".$email_get."'";

  }
 else{
	//update 
	 
	// check if pin is still valid 
	 $valid_date = intval(time()-(60*60*1));
	 
	 $sql= "SELECT email,expiry_date,recovery_token FROM password_recovery WHERE email='".$email_get."'";
$check_exp_date = mysqli_query($db_con,$sql);
 
 
 
 while($recover_det = mysqli_fetch_assoc($check_exp_date)){
	 
	 $valid_period = $recover_det['expiry_date'];
  $password_recovery_word_tomail = $recover_det['recovery_token'];

	 
 }
   
  
  
  
  
  
  
	 if($valid_period>time() ){
		 //$sql = "UPDATE  `password_recovery` SET `recovery_token` = '".$password_recovery_word_tomail."', `expiry_date` = 'j' WHERE `password_recovery`.`id` = 1;"
		 $sql = "UPDATE  `password_recovery` SET  `date_string` = '".time()."', `expiry_date` = '".$expiry_date."'  WHERE  `email` = '".$email_get."'";
		 
	 }
	 else{
		 $password_recovery_word_tomail = strtoupper(bin2hex(openssl_random_pseudo_bytes(16,$true)) );
 
	$sql = "UPDATE  `password_recovery` SET `date_string` = '".time()."' , `recovery_token` = '".$password_recovery_word_tomail."' , `expiry_date` = '".$expiry_date."' WHERE  `email` = '".$email_get."'";
			 
	 }
	 
	 
	 
 }
 

 
    $insert_pin = mysqli_query($db_con,$sql);

	

 if( $insert_pin){
		  //send mail
		  $to = $email_get;
		  $subject = "RECOVERY PASSWORD";
		  
		  
		  
		  $txt = " <h4 align='center'>HELLO!  </h4>" ;
		  
		  $txt .="<h5> We have recieved your password recovery request. </h5>";
		  $txt .="<h5> <a href='change_password.php?t=".$password_recovery_word_tomail."&e=".strrev($email_get)."' > Please click here to change your password.</h5>";
		  $txt .="<h5> If you never requested for this , <a href='cancel_change_password.php?t=".$password_recovery_word_tomail."&e=".strrev($email_get)."' > Please click here to cancel the request.</h5>";
		 
		 $mail = @mail("fff@mail.com",$subject,$txt,$mailheaders);
							 
							 if( $mail ){
									 $response['success'] =" <p class='success'> We sent a link to your email. please click on the link to change your password. <br/> <b class='error forgot_password_link' onclick=resend_recovery(this,".$arg.",event)> resend link</b>  </p>";


								  }
								 else{
									 //$response['error'] =" <p class='error'> Email sending failed ,  </p>";

									 
		 $response['error'] =" <p class='success'>  Email sending failed , please click <br> <b class='error forgot_password_link' onclick=resend_recovery(this,".$arg.",event)>resend</b> or refresh this page.</p>";

								 }
								 
		  
	  }
	  
	 else{
		 
		 
		 $response['error'] =" <p class='error'>  Password recovery failed , please click <br> <b class='error forgot_password_link' onclick=resend_recovery(this,".$arg.",event)>resend</b> or refresh this page.</p>";

	 } 
	  
	 
  
  
  
  

}

 }
 
 else{
	$response['error']=" <p class='error'>Please enter your email </p>"; 
	 
	 
 }






}

echo json_encode($response);




        
mysqli_close($db_con);



?>