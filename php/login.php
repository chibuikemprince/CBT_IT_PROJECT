<?php 


require_once("conn.php");



$response = array();

 if(isset($_POST['p']) && isset($_POST['e']) ){
	 
	 
	 $password_get = sha1(free($_POST['p'])) ;
	 $email_get = free(($_POST['e'])) ;
	 
	

	 $check_if_email_already_registered =  mysqli_query($db_con,"SELECT email,token FROM users WHERE email ='".$email_get."' && password='".$password_get."' && status!='blocked' ORDER BY id DESC LIMIT 1" );
	 






 if(mysqli_num_rows($check_if_email_already_registered)==0 ){
		   $response['error'] ="<p class='error'> it seems your login details are not correct or You may have been blocked from using this webpage </p>";

}

else{


while($details = mysqli_fetch_assoc($check_if_email_already_registered ) ){


 $response['success'] =" <p class='success'>validation completed , please wait </p>";



$response['email_save']=$details['email'];
	  $response['token_save']= $details['token'];
	 


} 

$response['redirect']= "account.html";
	 




}

}

echo json_encode($response);





mysqli_close($db_con);

?>