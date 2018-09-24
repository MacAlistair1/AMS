<?php
session_start();
include('processing.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="facebook.com/misview">
        <meta name="author" content="MIS Community">

         <link rel="stylesheet" href="css/bootstrap.css">
        

        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>

        <title>Sign Up Now</title>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand2" href="index.php">Author Management System</a>
                </div>
            </div>
        </div>
        
        
        
<div class="centering1">
	<table align="center" width="70%" id="cen1">
		<caption> Register Now</caption>
		<form action="" method="post">
			<tr>
				<td>First Name</td>
			</tr>
			<tr>
				<td><input type="text" name="fname" class="input-prepend" id="fname" placeholder="Enter First Name" required>
				</td>
			</tr>
			<tr>
				<td>Last Name</td>
			</tr>
			<tr>
				<td><input type="text" name="lname" class="input-prepend" id="lname" placeholder="Enter Last Name" required>
				</td>
			</tr>
			

			<tr>
				<td>E-mail</td>
			</tr>
			<tr>
				<td><input type="email" name="email" class="input-prepend" id="email" placeholder="Your E-mail" required>
				</td>
			</tr>
			<tr>
				<td>Phone</td>
			</tr>
			<tr>
				<td><input type="tel" name="phone" id="phone" class="input-prepend" placeholder="Enter Phone Number" required>
				</td>
			</tr>
			<tr>
				<td>Password</td>
			</tr>
			<tr>
				<td><input type="password" name="password" class="input-prepend" id="password" placeholder="Your Password" required>
				</td>
			</tr>
			<tr>
				<td>Confirm Password</td>
			</tr>
			<tr>
				<td><input type="password" name="cpassword" class="input-prepend" id="cpassword" placeholder="Re-enter Password" required>
				</td>
			</tr>
		
			<tr align="right">
				<td><button onClick="next(this.id)" onMouseOver="checkin(this.form)" class="btn-toolbar btn-large badge-inverse">Next</button>
				</td>
			</tr>
	</table>
	<table align="center" width="70%" class="sectable" id="cen2">
		<caption id="cap">Now, Enter your Other Information</caption>
		<tr>
				<td>Address</td>
			</tr>
			<tr>
				<td><input type="text" name="address" class="input-prepend" id="address" placeholder="Your Address" required>
				</td>
			</tr>
			<tr>
				<td>Occupation</td>
			</tr>
			<tr>
				<td><input type="text" name="occ" class="input-prepend" id="occ" placeholder="Your Occupation" required>
				</td>
			</tr>
		
			<tr>
				<td>Date oF Birth</td>
			</tr>
			<tr>
				<td><input type="date" name="dob" class="input-prepend" placeholder="29/07/1999" required>
				</td>
			</tr>
			<tr>
			<td>Gender:</td>
			<tr align="right">
				<td><input type="radio" name="gender" class="radio" value="Male"><b style="color:powderblue">Male</b>
				
					<input type="radio" name="gender" class="radio" value="Female"><b style="color:powderblue">Female</b>
				</td>
			</tr>
			<tr>
			<td>Signup As:</td>
			<tr align="right">
				<td><input type="radio" name="type" class="radio" value="Visitor"><b style="color: aqua">Visitor</b>
				</td></tr>
				<tr align="right"><td><input type="radio" name="type" class="radio" value="Author"><b style="color: aqua">Author</b></td></tr>	
			<tr align="center">
				<td><button type="submit" name="signup" id="btnSignup" class="btn btn-toolbar btn-large btn-info">Register</button>
				</td>
			</tr>
			</form>
			<td>
				<b id="error">
					<?php
					if ( isset( $_SESSION[ 'ers' ] ) == NULL ) {
						echo '';
					} else {
						echo $_SESSION[ 'ers' ];
						session_unset();
					}
					if ( isset( $_SESSION[ 'pass_match' ] ) == NULL ) {
						echo '';
					} else {
						echo $_SESSION[ 'pass_match' ];
						session_unset();
					}
					?>
				</b>
			</td>
		</tr>
	</table>
	<script language="javascript">
             var nexts = document.getElementById("cen1");
			  var new1 = document.getElementById("cen2");
			 	function next(id){
				nexts.classList.add("invisible");
				new1.classList.add("show");
				}
				
			
			function checkin(form){
				if(form.fname.value == "" || form.fname.value == null){
					alert("First Name is Required!");
				}else if(form.lname.value == "" || form.lname.value == null){
					alert("Last Name is Required!");
				}else if(form.email.value == "" || form.email.value == null){
					alert("E-mail is Required!");
				}else if(form.phone.value == "" || form.phone.value == null){
					alert("Phone Number is Required!");
				}else if(form.password.value == "" || form.password.value == null){
					alert("Password is Required!");
				}else if(form.cpassword.value == "" || form.cpassword.value == null){
					alert("Re-enter Password is Required!");
				}else if(form.password.value != form.cpassword.value){
					alert("Password Not Match!");
				}else{
					form.action="<?php echo $_SERVER['PHP_SELF'];?>";
					}
				
					}	
				
             </script>
</div>
        
        
         <div class="navbar navbar-fixed-bottom">
            <div class="navbar-inner">
                <div class="container-fluid1">
                   <marquee>
                   	 <a class="brand1">Thank You For Joining Us.</a>
                    <a class="brand1">@2018 By MacAlistair.</a>
                    <a href="login.php" class="brand1">Already Signed Up <u>Login Now</u></a>
                   </marquee>
                   
                </div>
            </div>
        </div>
    </body>
</html>
