<?php

//admin_add_category
//upload_question

require_once("conn.php");



$response = array();

 if(isset($_POST['t']) && isset($_POST['e']) ){
	 
	 
	 $token = free($_POST['t']) ;
	 $email_get = free(($_POST['e'])) ;
 
 $user_details_store = user_details($email_get,"token",$token);
 
	 //$response['ssss']=$user_details_store;
	
 if($user_details_store!=false || confirm_admin_login($email_get,$token)){
	 
	 $email = $user_details_store['email'];
	 $phone = $user_details_store['phone_number'];
	 $fname = $user_details_store['firstname'];
	 $lname = $user_details_store['lastname'];
	 $sex = $user_details_store['sex'];
	  
	 if($sex=='male'){
		 $sex_options = "<option value='male' selected> Male</option> 

			  <option value='female'> Female</option>
";
	 }
	 else{
		 $sex_options = "<option value='male' > Male</option> 

			  <option value='female' selected> Female</option>
";
	 
		 
	 }
	 
	 
	 if(isset($_POST['action']) ){
		 $action = free($_POST['action']);
		   
		 if( $action=="changeSex"){
			 
			 $response["success"] = "<form id='form_getter' url='edith_details'>
			 <p id='edith_error' ></p>
			 
			  <select class='form-control' id='sex' name='sex' required> <option value=''> Select Your Sex</option> 
			  
			  ".$sex_options."
			  </select> 
			 
			 <input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			
			 <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		 
		if( $action=="changeName"){
			 
			 $response["success"] = "<form id='form_getter' url='edith_details'>
			 <p id='edith_error' ></p>
			 <input type='text' name='fname'    placeholder='Enter Your New firstame Here'   class='form-control edith_form_inputs'  value='". $fname."' required/>
			 <input type='text' name='lname'    placeholder='Enter Your New lastname Here'   class='form-control edith_form_inputs' value='". $lname."' required/>
			 <input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			
			 <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		 
		 
		 
		 else if( $action=="changePass"){
			 
			 $response["success"] = "<form id='form_getter' url='edith_details'>
			 <p id='edith_error' ></p>
			 <input type='pássword' name='old_pass'    placeholder='Enter Your Old Password Here'   class='form-control edith_form_inputs'   required/>
			 <input type='pássword' name='new1_pass'    placeholder='Enter Your New Password Here'   class='form-control edith_form_inputs'  required/>
			 <input type='pássword' name='new2_pass'    placeholder='Enter Your New Password Here'   class='form-control edith_form_inputs'  required/>
			 <input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			
			 <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		 
		 
		  
		 else if( $action=="changePhone"){
			 
			 $response["success"] = "<form id='form_getter' url='edith_details'>
			 <p id='edith_error' ></p>
<input type='text' name='phone'    placeholder='Enter Your New Phone Number Here'   class='form-control edith_form_inputs'  value='".$phone."' required/>
			 			<input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			

			<input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		 
		   
		 else if( $action=="takeTest"){
			 
			 $response["success"] = "<form id='form_getter' url='pre_text'>
			 <p id='edith_error' ></p>
<select name='category'     class='form-control edith_form_inputs'/>
".get_categories()."
</select>
				
<input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			
			<input type='submit' value='Start Test' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		   
		 //for admin use only
		 
		 
		 else if( $action=="admin_add_category"){
			 
			 $response["success"] = "<form id='form_getter' url='add_category'>
			 <p id='edith_error' ></p>
			 <input type='text' name='name'    placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			   <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		  else if( $action=="start_edith_question_form"){
			 
			 $response["success"] = "<form id='form_getter' url='add_category'>
			 <p id='edith_error' ></p>
			  
<select name='category'     class='form-control edith_form_inputs' id='category_ques_edith'/>
".get_categories()."
</select>
			

			  <input value='Submit' type='submit' onclick='edith_question(event)' id='submit_form_getter' error='edith_error'  class='form-control'  required></form>";;
			 
		 }
		 
		 else if( $action=="upload_questions"){
			 
			 $response["success"] = "<form id='form_getter' url='upload_questions'>
			 <p id='edith_error' ></p>
			<textarea name='ques_txt'   placeholder='Enter Your Question Here'   class='form-control edith_form_inputs'  required  /></textarea>
			 
			 
			 <select name='category'     class='form-control edith_form_inputs'/>
".get_categories()."
</select>

			 <input type='text' name='option1'    placeholder='Enter The Option 1 Here'   class='form-control edith_form_inputs'  required/>
			 <input type='text' name='option2'    placeholder='Enter The Option 2 Here'   class='form-control edith_form_inputs'  required/>
			 <input type='text' name='option3'    placeholder='Enter The Option 3 Here'   class='form-control edith_form_inputs'  required/>
			 <input type='text' name='answer'    placeholder='Enter Your The Correct Answer Here'   class='form-control edith_form_inputs'  required/>
			 <input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 
			 <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  class='form-control'  required>
			 <input value='Clear Form' type='reset' style='width:auto;height:auto;border: 1px solid #242e38;background-color:white;border-radius:10px;padding:5px;float:right;font-size:10px;'> 
			
			 
			 </form>
			 
			 ";
			 
		 }
		 
		 else if( $action=="edith_questions"){
			 
			 if(isset($_POST['qid'])){
				 $qid = free($_POST['qid']);
			 }
			 
			 
	$sql="SELECT * FROM questions WHERE `id` ='".$qid."' LIMIT 1";
	$get_question = mysqli_query($db_con,$sql);
			 
			 
		if(mysqli_num_rows($get_question)==1 ){
			
			while($ques_ar = mysqli_fetch_assoc($get_question) ){
			$txt =  $ques_ar['question_text'] ;
			$opt1 = $ques_ar['option1'];
			$opt2 = $ques_ar['option2'];
			$opt3 = $ques_ar['option3'];
			$ans = $ques_ar['answer'];
			$qid = $ques_ar['id'];
			$cat_id = $ques_ar['category_id'];
			
			 $response["success"] = "<form id='form_getter' url='update_questions'>
			 <p id='edith_error' ></p>
			<textarea name='ques_txt'   placeholder='Enter Your Question Here'   class='form-control edith_form_inputs'  required  />".$txt."</textarea>
			 
			 
			 <select name='category'     class='form-control edith_form_inputs'/>
".get_categories_select_one($cat_id)."
</select>

			 <input value='".$opt1."' type='text' name='option1'    placeholder='Enter The Option 1 Here'   class='form-control edith_form_inputs'  required/>
			 <input value='".$opt2."' type='text' name='option2'    placeholder='Enter The Option 2 Here'   class='form-control edith_form_inputs'  required/>
			 <input value='".$opt3."' type='text' name='option3'    placeholder='Enter The Option 3 Here'   class='form-control edith_form_inputs'  required/>
			 <input value='".$ans."' type='text' name='answer'    placeholder='Enter Your The Correct Answer Here'   class='form-control edith_form_inputs'  required/>
			 <input type='hidden' name='qid'  value='".$qid."'      class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='e'  value='".$email_get."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 <input type='hidden' name='t'  value='".$token."'  placeholder='Enter Category Name Here'   class='form-control edith_form_inputs'   required/>
			 
			 <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='edith_error'  fill='quet_".$qid."' class='form-control'  required>
			 <input value='Clear Form' type='reset' style='width:auto;height:auto;border: 1px solid #242e38;background-color:white;border-radius:10px;padding:5px;float:right;font-size:10px;'> 
			
			 
			 </form>
			 
			 ";
		}//loop
		 }//question not exist
			 
			 else{
				 $response['error']="<p class='error'> This question does not exist here or has been removed </p>";
				 
			 }
		 }
		 
		 
		 
		 
		 
		 
		 
		 
	 }//action isset
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
 }//user is registered
 
 
 
 else{
	 
	 $response['error']="It seems you have been logged out. <a href='index.html'> Click here to login </a>";
	 
 }
 
 
 
 }

 
  

echo json_encode($response);

mysqli_close($db_conn);
?>