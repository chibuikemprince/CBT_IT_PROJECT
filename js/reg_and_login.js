var reg_form = "<form id='form_getter' url='registration'> <p id='reg_error'></p> <input type='text' name='fname' id='fname' placeholder='Enter Your Firstname Here'  class='form-control'  required/><input type='text' name='lname' id='lname' placeholder='Enter Your Lastname Here'  class='form-control'  required/><input type='email' name='email' id='email' placeholder='Enter Your Email Here'   class='form-control'  required/><input type='number' name='phone' id='phone' placeholder='Enter Your Phone Number Here'   class='form-control'  required / ><input type='password' name='password' id='password' placeholder='Enter Your Password Here'   class='form-control'  required/><input type='password' name='cpassword' id='cpassword' placeholder='Confirm Your Password '   class='form-control'  required/> <select class='form-control' id='sex' name='sex' required> <option value=''> Select Your Sex</option> <option value='male'> Male</option>  <option value='female'> Female</option> </select>  <input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='reg_error'  class='form-control'  required> </form>";
 var forget_form_parent = "document.getElementById('model_body_div')";                           

var login_form = "<form id='form_getter' url='login'> <p id='login_error'></p><input type='email' name='e' id='email' placeholder='Enter Your Login Email Here'   class='form-control'  required/><input type='password' name='p' id='password' placeholder='Enter Your Password Here'   class='form-control'  required/> <input  value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='login_error'  class='form-control'  required></form>  <h6 onclick='get_forget_login_form()' align='right' class='forgot_password_link'  id='forgot_details_login_btn_user'> Forgot Password  </h6>";



var login_form_admin = "<form id='form_getter' url='login_admin'> <p id='login_error'></p><input type='email' name='e' id='email' placeholder='Enter Your Login Email Here'   class='form-control'  required/><input type='password' name='p' id='password' placeholder='Enter Your Password Here'   class='form-control'  required/> <input  value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='login_error'  class='form-control'  required></form>";
var forget_login_form = "<form id='form_getter' url='forget_password'> <p id='login_error'></p><input type='email' name='e' id='email' placeholder='Enter Your Login Email Here'   class='form-control'  required/><input value='Submit' type='submit' onclick='form_submitter(this,event)' id='submit_form_getter' error='login_error'  class='form-control'  required></form>";



function get_forget_login_form(){
	//toggle_model();
	document.getElementById('model_body_div').innerHTML =   forget_login_form;
	
	
}


function open_login_admin(div){
	toggle_model();
	div.innerHTML=   login_form_admin ;
	
	
}

function open_login(div){
	toggle_model();
	div.innerHTML=   login_form ;
	
	
}

function open_reg(div){
	toggle_model();
	div.innerHTML=  reg_form;
	
	
}


function resend_recovery(div,arg,event){
	div.setAttribute("url",'forget_password');

	div.setAttribute("error",'login_error');
	div.setAttribute("success",'login_error');
	
	    
	
	request_sender(div,arg,event);
	
	
	
}


function logout(who){
	
show_elements("spinner","block"); 
			 
			 
	
	if(who=="admin"){
		
		localStorage.setItem("email_admin","");
		localStorage.setItem("pin_admin","");
		setTimeout(function(){ location="admin_login.html"; },1000);
	
	}
	else if(who=="user"){
		
		localStorage.setItem("email","");
		localStorage.setItem("pin","");
		setTimeout(function(){ location="index.html"; },1000);
	
	}
	
}



 
