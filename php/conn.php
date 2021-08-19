<?php
 	
/* if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])&& $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest'){
}
else{
	
	exit;
}
 */
  

ini_set("error_reporting","E_ALL");

$host = 'localhost';

$db = 'exam_project';

$db_uname='noteloft';

$db_pass = 'thenoteloft_noteloft_forall';



//$con = mysqli_connect("localhost","my_user","my_password","my_db")
$db_con = mysqli_connect($host,$db_uname,$db_pass,$db) ;//or die("contact admim,-error code = 66934496A");
  
  
  
 
  
 





	 function free($strings_to_free){
	 
	 return htmlspecialchars(mysql_real_escape_string( ltrim(   rtrim($strings_to_free)   )   ) );
	 
	 
 }
 
	


		
 $alpha = array('a','b','c','d','e','f','g','h','i','j','k','l','z','w','y','u','time');

$str_alph = $alpha[rand(0,16)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)];
$str_alph .= $alpha[rand(0,15)].$alpha[rand(0,16)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)];

$str_alph2 = $alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)];
$str_alph2 .=  $alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)];
$str_alph2 .=  $alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)];
	$str_alph .=  $alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)].$alpha[rand(0,15)];
	 
	
	

	
	
function user_details($email,$type,$type_value){
global $db_con;
if($type=="password"){
 $check_if_email_already_registered =  mysqli_query($db_con,"SELECT * FROM users WHERE email ='".$email."' && password='".$type_value."'  ORDER BY id DESC LIMIT 1" );
	

}
else
{
 $check_if_email_already_registered =  mysqli_query($db_con,"SELECT * FROM users WHERE email ='".$email."' && token='".$type_value."' ORDER BY id DESC LIMIT 1" );
	 

}




if(mysqli_num_rows($check_if_email_already_registered)==0 ){


return false;
}





while($details = mysqli_fetch_assoc($check_if_email_already_registered ) ){



return $details;



}



}

 
								 
			
		  $mailheaders = "MIME-Version: 1.0" . "\n";
$mailheaders .= "Content-type:text/html;charset=UTF-8" . "\n";

// More headers
$mailheaders .= 'From: <changepassword@mydomain.com>' . "\n";



	
	
	$headers =   $mailheaders ;
	
	
	
	
	function get_current_question_state($email){
		global $db_con;
	$sql="SELECT * FROM pre_test WHERE email ='".$email."' LIMIT 1";
$query = mysqli_query($db_con,$sql);	

if(mysqli_num_rows($query)==1 ){
	return mysqli_fetch_assoc($query)['current_stage'];
	
}else{
	return false;
}

		
	}
	
	
	
	function get_category_name($id){
		global $db_con;
		global $str_alph,$str_alph2;
		$sql = "SELECT name,id FROM `categories` WHERE id='".$id."' LIMIT 1";
		$query = mysqli_query($db_con,$sql);
		 while($categories = mysqli_fetch_assoc($query) ){
			
			$all_category_name =  $categories['name'];
			return $all_category_name;
		
			}
		
		if( mysqli_num_rows($query)==0  ){
			
			return false;
		}
		
	}
	
	
	
	
	
	function get_categories(){
		global $db_con;
		global $str_alph,$str_alph2;
		$sql = "SELECT name,id FROM `categories` WHERE id>0 ORDER BY name ASC";
		$query = mysqli_query($db_con,$sql);
		$all_category = '<option> Select Test Category </option>';
		
		while($categories = mysqli_fetch_assoc($query) ){
			
			$all_category .="<option value = '".$str_alph.$str_alph2.$categories['id'].$str_alph.$str_alph2."'>".$categories['name']."</option>";
		}
		
		
		return $all_category;
		//return mysqli_num_rows($query);
		
	}
	
	
	function get_categories_select_one($id){
		global $db_con;
		global $str_alph,$str_alph2;
		$sql = "SELECT name,id FROM `categories` WHERE id>0 ORDER BY name ASC";
		$query = mysqli_query($db_con,$sql);
		$all_category = '<option> Select Test Category </option>';
		
		while($categories = mysqli_fetch_assoc($query) ){
			if($id==$categories['id']){
				
			$all_category .="<option selected value = '".$str_alph.$str_alph2.$categories['id'].$str_alph.$str_alph2."'>".$categories['name']."</option>";
		
			}
			else{
				
			$all_category .="<option value = '".$str_alph.$str_alph2.$categories['id'].$str_alph.$str_alph2."'>".$categories['name']."</option>";
		
			}
			
			
			}
		
		
		return $all_category;
		//return mysqli_num_rows($query);
		
	}
	
	
	
	
	
	
	function is_admin_confirmed($email){
		global $db_con;
		$sql ="SELECT name FROM admin WHERE email='".$email."' && status !='blocked' LIMIT 1";
		$query = mysqli_query($db_con,$sql);
		
		if( mysqli_num_rows($query)==0  ){
			
			return false;
		}
		else{
			
			return true;
		}
		
		
		
	}
	
	
	
	function confirm_admin_login($email,$pin){
		global $db_con;
		$sql ="SELECT name FROM admin WHERE email='".$email."' && password='".$pin."' && status !='blocked'  LIMIT 1";
		$query = mysqli_query($db_con,$sql);
		
		if( mysqli_num_rows($query)==0  ){
			
			return false;
		}
		else{
			
			return true;
		}
		
		
		
	}
	
	
	
	
	function  is_category_exist($type,$type_value){
		global $db_con;
		if($type=="name"){
			
		
		$sql ="SELECT name FROM categories WHERE name = '".$type_value."' LIMIT 1";
		}
		else if($type=="id"){
			
		
		$sql ="SELECT name FROM categories WHERE id = '".$type_value."' LIMIT 1";
		}
		$query = mysqli_query($db_con,$sql);
		
			if( mysqli_num_rows($query)==0  ){
			
			return false;
		}
		else{
			
			return true;
		}
	
		
	}
	


?>