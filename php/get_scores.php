<?php



require_once("conn.php");



$response = array();

 if(isset($_POST['t']) && isset($_POST['e']) ){
	 
	 
	 $token = free($_POST['t']) ;
	 $email_get = free(($_POST['e'])) ;
  	
  
 if( confirm_admin_login($email_get,$token)  )
 
 { 
	 
	 if(isset($_POST['action']) ){
		 $action = free($_POST['action']);
		 
		 
		 
		 
		 
		 if( $action=="getScores"){
			 
			 $sql = "SELECT * FROM scores WHERE id>0";
			  $s_query = mysqli_query($db_con,$sql)  ;
			 $score_record =  '
			 
			 <div class="table-title">
<h3 align="center"> Users Rating </h3>
</div>
<table class="table-fill table" cellpadding="15px">
<thead>
<tr>
<th class="text-left">Email</th>
<th class="text-left">Date</th>
<th class="text-left">Time</th>
<th class="text-left">Score</th>
<th class="text-left">Time Spent</th>
<th class="text-left">Rate</th> 
</tr>
</thead>
<tbody class="table-hover">		
		
		';
			 
			 while($all_scores = mysqli_fetch_assoc($s_query)){
				 $time = date("H:i");
				 $date = date("D - M - Y");
			 /* $score_record .= " <div class='col-md-2'> ".$dates."</div>";	 
			 $score_record .= " <div class='col-md-2'> ".$time."</div>";	 
			 /* $score_record .= " <div class='col-md-2'> ".$all_scores['email']."</div>";	  */
			 
			   /* $score_record .= " <div class='col-md-2'> ".$all_scores['score']."</div>"	; 
			 $score_record .= " <div class='col-md-2'> ".$all_scores['time_spent']."</div> <hr/>";	 
				 */ 
				 $score_record .='
				 <tr>
<td class="text-left">'.$all_scores['email'].'</td>
<td class="text-left">'.$date.'</td>
<td class="text-left">'.$time.'</td>
<td class="text-left">'.$all_scores['score'].'</td>
<td class="text-left">'.$all_scores['time_spent'].'</td>

 
				 
				 ';
				 
				 
				 
				 $score = $all_scores['score'];
				 $rate='';
				 if($score<5){
					 $rate = "Poor";
					 
				 }
				 else if($score<7){
					 $rate = "Good";
					 
				 }
				 else if($score<9){
					 $rate = " Very Good";
					 
				 }
				 else {
					 $rate = " Excellent ";
					 
				 }
				 
				 /* $score_record .= " <div class='col-md-2'> ".$rate."</div> <hr/>";	  */
			
				 $score_record .='<td class="text-left">'.$rate.'</td>



</tr>
		';
			 }
			 
			 
			  $score_record  .= '</tbody> </table>';
			 
			 $response['success'] = $score_record;
		 }
		 
		 
		 
		 
	 }
	 
	 
	 
	 
	 
	 
	 
	 
	 
	  
 }
 else{
	 
	 $response["error"] =" It seems you have been logged out. <a href='admin_login.html'> Click here to login </a> ";
	 
 }
 }
 
 
 
echo json_encode($response);

mysqli_close($db_conn);
?>