<?php


require_once("conn.php");



$response = array();
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&& $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
 
 $errors = '';
 if(isset($_POST['email']) && isset($_POST['phone'])&& isset($_POST['cpassword'])&& isset($_POST['password'])&& isset($_POST['fname'])&& isset($_POST['lname']) ){
	 
	 
	
	$fname = free($_POST['fname']);
	$lname = free($_POST['lname']);
	$phn = free($_POST['phone']);
	$email = free($_POST['email']);
	$sex = free($_POST['sex']);
	$pass = sha1(free($_POST['password']));
	$pass2 = sha1(free($_POST['cpassword']));
	 
	
	   //$errors = 'welcome   '.$fname."   ".mysqli_error();;
	  
	 if(strlen($pass)<5){
		 
		$errors .= " <p class='error'> Password must be greater than five characters.  </p> ";
	
	} 
	  
	 if($pass != $pass2){
		 
		$errors .= " <p class='error'> Password and confirm password did not match. </p>";
	
	} 
	 
	 
	 
	 
	 
	 if( (preg_match("/^male$/i",$sex)) || (preg_match("/^female$/i",$sex))  ){
		
	}else{
		
		$errors .="<p class='error'> Select Your Sex </p>" ;
		
	}
	
	if( (preg_match("/[^\s\w]/",$lname)) || (preg_match("/\d/",$lname))  ){
		$errors .="<p class='error'> Last name should contain Alphabets only </p>";
		
	}
	
	
	if( (strlen($lname)==0) || (strlen($lname)<3) ){
		$errors .="<p class='error'>Last name cannot be less than 3 characters</p>";
		
	}
	 if( (preg_match("/[^\s\w]/",$fname)) || (preg_match("/\d/",$fname))  ){
		$errors .="<p class='error'> First name should contain Alphabets only </p>";
		
	}
	
	
	if( (strlen($fname)==0) || (strlen($fname)<3) ){
		$errors .="<p class='error'>First name  cannot be less than 3 characters</p>";
		
	}
	 
	 
	 $phone = $phn;
	 
	   if ( preg_match("/^\+?234/",$phone) ||  preg_match("/^080/",$phone) || preg_match("/^070/",$phone)  || preg_match("/^090/" ,$phone)  ||  preg_match("/^081/",$phone) )
	  {
		  
	  if ( !preg_match("/^\+?(234)([0-9]{10})$/",$phone) &&  !preg_match("/^(080)([0-9]{8})$/",$phone) && !preg_match("/^(070)([0-9]{8})$/",$phone)  && !preg_match("/^(090)([0-9]{8})$/" ,$phone)&& !preg_match("/^(081)([0-9]{8})$/",$phone) )
		  {
			$errors .="<p class='error'>Invalid Phone Number</p>";
		  
			  
			  
		  }
 }
	
	
	
	
	
	
	 if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$email)) {
	 $errors .= "<p class='error'>Your Email Address is invalid</p>";  
  }
  
	if ( strlen($email)>100 ) {
	 $errors .= "<p class='error'>You have exceeded the maximum number of character for Email Address</p>";  
  
	 
	 }
   
	
	
	
	
	
	
	 
	 
	 
	 $check_if_email_already_registered = mysqli_query($db_con,"SELECT email FROM users WHERE email ='".$email."'" );
	 
	 if(mysqli_num_rows($check_if_email_already_registered)>0 ){
		 $errors .= "<p class='error'>This Email has been taken by another user.</p>";  
		 
	 }
	 
	 
	 
	 
	 
	 
	 
	$true = true;
 //$token = bin2hex(openssl_random_pseudo_bytes(64,$true));
 
 $token = sha1($email).time();
	 $funct_name = $fname." ".$lname;
	  
	if(strlen($errors)==0){
	 	 
	 $ins = mysqli_query($db_con,"INSERT INTO  `users` (`firstname`, `lastname`, `email`, `phone_number`, `sex`, `password`, `date_string`, `token`, `status`,`blocked`, `id`) VALUES ('".$fname."', '".$lname."', '".$email."', '".$phn."', '".$sex."', '".$pass."', '".time()."', '".$token."', 'unconfirmed','false', NULL)");
	  
	     
	 if($ins){
		 
		  
			 $response['success']="You have registered successfully. ";
	 $response['email_save']=$email;
	  $response['token_save']=$token;
	 $response['redirect']= "account.html";
	  
		 
		 
		 }
	 else{
		 
		 
		 $response['error']="An error occured ,please register again .";
	 }
	 
	 
	 
	}
	else{
		$response['error'] = $errors;
		
	}
 
 /* 
	
	$check_registered_as_customer = mysqli_query("SELECT email FROM customers WHERE email='".$email."'");
	
	if(mysqli_num_rows($check_registered_as_customer)==0 ){
		
		$insert_customers  = mysqli_query("INSERT INTO `ejecs`.`customers` (`name`, `email`, `phone_numbers`, `office_address`, `city`, `state`, `country`, `blocked`, `id`) VALUES ('', '', '', '', '', '', '', '', NULL)");
	}
	 */
 }
 
 else
{
	 
	 
	 $response['error']="An error occurred please refresh this page..";
	 
	 
 }
 

}

else
{
	 
	 $response['error']="An error occurred please refresh this page..";
	 
 }
 
 
echo json_encode($response);

mysqli_close($db_conn);
?>