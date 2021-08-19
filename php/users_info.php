
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
		 
		 $action = free($_POST['action']);
		 
		 
		 if($action=="userinfo"){
			
		$all_users =  mysqli_query($db_con,"SELECT * FROM users WHERE  id>0 ORDER BY id DESC LIMIT ".$start.",5" );
	
	
	 if( mysqli_num_rows($all_users)>0 ){
		 
		 
		 $output = "<h4 align='center' id='all_user_error'> </h4><div class='row'>";
		 while($all_user_array = mysqli_fetch_assoc($all_users) ){
			 $uid = $all_user_array['id'];
			 $uid_plus = $str_alph.$str_alph2.$uid.$uid_plus.$str_alph2;
			 $username  = $all_user_array['firstname']."  ".$all_user_array['lastname'];
			 
			 
			$output .=" <div class='col-md-10 each_user_div'   id='user_each_".$uid."'> ";
			
			$output .= "<h3 align='center'>".$username." </h3>";
$output .= "<h4 align='center'> ".$all_user_array['email']." </h4>";
$output .= "<h4 align='center'> ".$all_user_array['phone_number']."</h4>";
if($all_user_array['status']=="blocked")
{

$output .= "<h6 align='right' onclick=admin_block_or_unblock_request(this,'action=".$uid_plus."',event,'user_each_".$uid."') url='unblock_user' id='user_".$uid."' error='all_user_error' success='user_each_".$uid."'> unblock </h4>";

	
}
else{

$output .= "<h6 align='right' onclick=admin_block_or_unblock_request(this,'action=".$uid_plus."',event,'user_each_".$uid."') url='block_user' id='user_".$uid."' error='all_user_error' success='user_each_".$uid."'> block </h4>";


}
			$output .= "</div>"; 
			 
			 
		 }
		 $start = intval($start+5);
		 $response['success'] = $output."<div class='col-md-12'> <h6 align='right'> <h6 id='uload_more_error' > </h6>     <button  onclick=admin_all_users_request(this,'action=userinfo&start=".$start."',event); url='users_info' success ='model_body_div'   error ='uload_more_error' type='button' class='btn btn-default' > Load More </button> </h6> </div></div>" ;
			  
	 }
		else{
			$response['success']="<p class='success'> No Registered User Found </p>";
			
		}	 
			   
			 
			 
			 
			 
			 
			 
		 }
		 
		 
	 }
	 
	 
	 
	 
	 
		
 }// confirm login admin
 
 
 
 else{
	 
	 $response['error']="It seems you have been logged out. <a href='admin_login.html'> Click here to login </a>";
	 
 }
 
 
 
 
 }//isset 
 
 
 
echo json_encode($response);

mysqli_close($db_conn);


?>





