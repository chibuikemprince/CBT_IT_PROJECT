<?php
 
require_once("conn.php");



$response = array();

 if(isset($_POST['t']) && isset($_POST['e']) ){
 
 
 
 
 if(isset($_POST['min']) && isset($_POST['sec']) ){
	 $min = free($_POST['min']);
	 $sec = free($_POST['sec']);
	 if($min=="start"){
		 $min = 10;
	 } else{
		 $min = $min+1;
	 }
	 
	 
	 if($sec=="start"){
		 $sec = 60;
	 }
	 
	 
	 $min_spent = 10-intval($min);
	 $sec_spent = 60-intval($sec);
	 
	  if($sec_spent==60){
		 $sec_spent = 0;
		 $min_spent  = $min_spent+1;
	 }
	
	 $total_time_spent = $min_spent." mins ".$sec_spent." secs ";
	 
	 
 }
 
 
 
	 
	 $token = free($_POST['t']) ;
	 $email_get = free(($_POST['e'])) ;
 
 $user_details_store = user_details($email_get,"token",$token);
 
	// $response['ssss']=$user_details_store;
	
 if($user_details_store!=false){
	 
	 $email = $user_details_store['email'];
	 $phone = $user_details_store['phone_number'];
	 $firstname = $user_details_store['firstname'];
	 $lastname = $user_details_store['lastname'];
	 $sex = $user_details_store['sex'];
	  $firstphone  =  $phone ;
	  $firstsex  =  $sex ;
	 
	 if(isset($_POST['action'])   ){
		 $score = 0;
		 $answers = free($_POST['action']);
		 $answers = json_decode($_POST['action']);
		 $total = count($answers);
		 foreach($answers as $answers_id => $answers_value){
			$dcorrect_answer =$answers-> $answers_id;			
		 	
				preg_match("/\((\d+)\)/",$answers_id,$answers_id_ar);
		$answers_id = $answers_id_ar[1];
			

		
	 $sql = "SELECT answer,category_id FROM questions WHERE id='".$answers_id."' && answer='".$dcorrect_answer."' LIMIT 1";
			
			
			$query= mysqli_query($db_con,$sql);
			 
			 if(mysqli_num_rows($query)==1 ){
				 $category_id = mysqli_fetch_assoc($query)['category_id'];
				 $score++;
			 }
			 
			 
		 }
		 
		 $msg = "";
		 
		 if($score<5)
		 
		 {
			 
			 $msg = "Read more , your score is too poor";
		 }
		 
		 else if($score<7)
		 
		 {
			 
			 $msg = "Nice score , but more effort is need";
		 }
		 else if($score<9)
		 
		 {
			 
			 $msg = "Very good ";
		 }
		 
		 else 
		 
		 {
			 
			 $msg = "Excellent Score";
		 }
		 
		  $last_state=get_current_question_state($email);
		 if(get_current_question_state($email)=="NULL"){
			 $last_state = 0;
			 
		 } 
		 
		 if(get_current_question_state($email)== false){
			// $sql=" INSERT INTO  `pre_test` (`email`, `current_stage`, `date_string`, `id`) VALUES('".$email_get."','NULL','".time()."',NULL)";	
		//$query = mysqli_query($db_con,$sql); 
		 } 
		 
		 
		 $last_state = intval($last_state)+10 ;
		 
		 
		 $sql  = "UPDATE  `pre_test` SET `current_stage` = '".$last_state."' WHERE `email` = '".$email."'";
 		 $query = mysqli_query($db_con,$sql); 
		
		  
		 
		 
		 
		 
		 
		 
		 $sql = "INSERT INTO  `scores` (`email`, `category_id`, `score`, `total_question`, `status`, `time_spent`, `date_string`, `id`) VALUES ('".$email."', '".$category_id."', '".$score."', '10', '', '". $total_time_spent."', '".time()."', NULL)";
		 $query = mysqli_query($db_con,$sql); 
		
		  $response['success']="<p class='success' style='font-size:22px;font-family:fantasy;'>".$msg." </p><h4 align='center'>  You Scored <br/> <b style='font-size:22px;font-family:fantasy;'>".$score." / 10 </b><br/> <p style='font-size:12px;font-family:monospace;'>Time Spent: ". $total_time_spent." </p></h4>";
		 //$response['success']=  json_encode($answers);
		 //print_r($answers);
	 }
	 
	 
	 
 }//user is confirmed
	else{
	 
	 $response['error']="It seems you have been logged out. <a href='index.html'> Click here to login </a>";
	 
 }	 
		 
 }//isset
		 
		 
	else{
	 
	 $response['error']="It seems you have been logged out. <a href='index.html'> Click here to login </a>";
	 
 }	 
		 
		 
		 
		 
		 
		 
		 
 
echo json_encode($response);

mysqli_close($db_conn);


/* 

$prince = new stdclass();
 
 //print_r ($prince);

$prince->name="prince";
$prince->age="20+";
$prince->school="unn";
$prince->faculty="phy sci";
$prince->dept="comp sci";

echo $prince->name;

 foreach($prince as $name => $o){
	
 	echo "  <br/>".$name." is ". $o;
  }
 */
?>