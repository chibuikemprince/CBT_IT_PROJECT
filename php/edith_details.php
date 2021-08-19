<?php
 
require_once("conn.php");



$response = array();

 if(isset($_POST['t']) && isset($_POST['e']) ){
	 
	 
	 $token = free($_POST['t']) ;
	 $email_get = free(($_POST['e'])) ;
 
 $user_details_store = user_details($email_get,"token",$token);
 
	 //$response['ssss']=$user_details_store;
	
 if($user_details_store!=false){
	 
	 $email = $user_details_store['email'];
	 $phone = $user_details_store['phone_number'];
	 $firstname = $user_details_store['firstname'];
	 $lastname = $user_details_store['lastname'];
	 $sex = $user_details_store['sex'];
	  $firstphone  =  $phone ;
	  $firstsex  =  $sex ;
	 
	 if(isset($_POST['lname']) && isset($_POST['fname']) ){
		 $lname = free($_POST['lname']);
		 $fname = free($_POST['fname']);
		 
		$errors =""; 
		 	
	if( (strlen($lname)==0) || (strlen($lname)<3) ){
		$errors ="<p class='error'>Lastname cannot be less than 3 characters</p>";
		
	}
	
	if( (strlen($fname)==0) || (strlen($fname)<3) ){
		$errors ="<p class='error'>Firstname cannot be less than 3 characters</p>";
		
	}
	 if( (preg_match("/[^\s\w]/",$fname)) || (preg_match("/\d/",$fname))  ){
		$errors .="<p class='error'> Firstname should contain alphabets only </p>";
		
	}
	
	
	 if( (preg_match("/[^\s\w]/",$lname)) || (preg_match("/\d/",$lname))  ){
		$errors .="<p class='error'> Lastname should contain alphabets only </p>";
		
	}
	
		 
		if(strlen($errors)==0 ){
			
		 if($firstname!=$fname || $lastname !=$lname)
		 {
		 $sql="UPDATE  `users` SET `firstname` =  '".$fname."', lastname='".$lname."'  WHERE `email` = '".$email."' LIMIT 1";
		$query = mysqli_query($db_con,$sql);
		
		if($query){
			$response['success']="<p class='success'>changes saved successfully. </p>";
			}
			else{
				
			$response['error']="<p class='success'>Your new change was saved. </p>";
				
			}
		
	 }
		else{
			$response['success'] ="<p class='success'>No change was made. </p>";
			
		} 
	 
	 
	 
	 	 
		} 
		 
		 else{
		
		
		
		$response['error']=$errors;
		
		 }//no error
	 
	 
	 
	 }
	 
	 
	else  if(isset($_POST['phone'])   ){
		 $phone = free($_POST['phone']);
		 
		$errors =""; 
	 if(strlen($phone)>0 ){
		 
if ( preg_match("/^\+?234/",$phone) ||  preg_match("/^080/",$phone) || preg_match("/^070/",$phone)  || preg_match("/^090/" ,$phone)  ||  preg_match("/^081/",$phone) )
	  {
		  
	  if ( !preg_match("/^\+?(234)([0-9]{10})$/",$phone) &&  !preg_match("/^(080)([0-9]{8})$/",$phone) && !preg_match("/^(070)([0-9]{8})$/",$phone)  && !preg_match("/^(090)([0-9]{8})$/" ,$phone)&& !preg_match("/^(081)([0-9]{8})$/",$phone) )
		  {
			$errors .="<p class='error'>Invalid Phone Number</p>";
		  
			  
			  
		  }
 }else{
	 
$errors .="<p class='error'>Invalid Phone Number</p>";
		  	 
 }
	
	

	 }
	 else{
		 $errors .= "<p class='error'>Enter your new phone number </p>";
	 }

	 
		if(strlen($errors)==0 ){
			
		 if($firstphone!=$phone )
		 {
		 $sql="UPDATE  `users` SET `phone_number` =  '".$phone."'   WHERE `email` = '".$email."' LIMIT 1";
		$query = mysqli_query($db_con,$sql);
		
		if($query){
			$response['success']="<p class='success'>changes saved successfully. </p>";
			}
			else{
				
			$response['error']="<p class='success'>Your new change was saved. </p>";
				
			}
		
	 }
		else{
			$response['success'] ="<p class='success'>No change was made. </p>";
			
		} 
	 
	 
	 
	 	 
		} 
		 
		 else{
		
		
		
		$response['error']=$errors;
		
		 }//no error
	 
	 
	 
	 }
	 
	 
	else  if(isset($_POST['sex'])   ){
		 $sex = free($_POST['sex']);
		 
		$errors =""; 
	 if(strlen($sex)>0 ){
	 if( $sex!='male'&& $sex !='female'  ){
		 
		  $errors .= "<p class='error'>Select a valid sex </p>";
	
	 }

	 }
	 else{
		 $errors .= "<p class='error'>Select your new sex </p>";
	 }

	 
		if(strlen($errors)==0 ){
			
		 if($firstsex!=$sex )
		 {
		 $sql="UPDATE  `users` SET `sex` =  '".$sex."'   WHERE `email` = '".$email."' LIMIT 1";
		$query = mysqli_query($db_con,$sql);
		
		if($query){
			$response['success']="<p class='success'>changes saved successfully. </p>";
			}
			else{
				
			$response['error']="<p class='success'>Your new change was saved. </p>";
				
			}
		
	 }
		else{
			$response['success'] ="<p class='success'>No change was made. </p>";
			
		} 
	 
	 
	 
	 	 
		} 
		 
		 else{
		
		
		
		$response['error']=$errors;
		
		 }//no error
	 
	 
	 
	 }
	 
	 
	 
	else if(isset($_POST['old_pass']) && isset($_POST['new1_pass'])&& isset($_POST['new2_pass']) ){
		  
		   
		  $old_pass = free($_POST['old_pass']);
		  $new1_pass = free($_POST['new1_pass']);
		  $new2_pass = free($_POST['new2_pass']);
		   
		   
		   $response['ee'] = sha1($old_pass);
		   $pass = $new1_pass;
		   $pass2 = $new2_pass;
		  
		    $errors = '';
	 if(strlen($pass)<5){
		 
		$errors .= " <p class='error'> New password must be greater than five characters.  </p> ";
	
	} 
	  
	 if($pass != $pass2){
		 
		$errors .= " <p class='error'> New password and confirm password did not match. </p>";
	
	} else if($old_pass == $pass){
		$errors .= " <p class='error'> New password cannot be same with old password </p>";
	
		
	}
	 
	 
	    if(strlen($errors)==0){
			 
			 
			  $check_if_email_already_registered =  mysqli_query($db_con,"SELECT email,token FROM users WHERE email ='".$email_get."' && password='".sha1($old_pass)."' && status!='blocked' ORDER BY id DESC LIMIT 1" );
	 






 if(mysqli_num_rows($check_if_email_already_registered)==1 ){
	
			   $token = sha1($email).time();
			   
			    $sql="UPDATE  `users` SET `password` =  '".sha1($pass)."'  , `token` =  '".$token."'  WHERE `email` = '".$email."' LIMIT 1";
		
		$query = mysqli_query($db_con,$sql);
		$query = '';
		if($query){
			$response['success']="<p class='success'>changes saved successfully. </p>";
			
			
$response['email_save']=$email_get;
	  $response['token_save']= $token;
	 
			
			}
			else{
				
			$response['error']="<p class='success'>Your new change was saved. </p>";
				
			}
			   
			   
		   }
		   else{
			   $response['error'] = "<p class='error'> Invalid old password  <a href='index.html?recover=recover'>To recover your password </a></p>";
		
			   
		   }
		  
		  
	  }
	 else{
		 $response['error']=$errors;
	 }
	 
	    
		   }// pass set
		  
	 
	 
	  
 }//confirm user
 
 } //isset
 
 
 
echo json_encode($response);

mysqli_close($db_conn);
?>