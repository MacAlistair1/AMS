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

        <title>Login Now</title>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="brand2" href="index.php">Author Management System</a>
                </div>
            </div>
        </div>
        
        
<div class="centering">
<table align="center" width="70%" id="cen">
<caption> Log In</caption>
	<form action="" method="post">
		<tr>
			<td>E-mail:</td>
		</tr>
		<tr>
			<td><input type="email" name="email" class="input-append" placeholder="Your E-mail" value="<?php 
	if(isset($_COOKIE['email'])){
		echo $_COOKIE['email'];
		}
?>" required>
			</td>
		</tr>
		<tr>
			<td>Password:</td>
		</tr>
		<tr>
			<td><input type="password" name="password" class="input-prepend" placeholder="Your Password" value="<?php if(isset($_COOKIE['pass'])){
		echo $_COOKIE['pass'];
		}
?>" required>
			</td>
		</tr>
		<tr align="center">
			<td><button type="submit" name="login" id="btnLogin" class="btn btn-toolbar btn-large btn-info">Log In</button>
			</td>
		</tr>
		<tr>
			<td><input type="checkbox" name="remember" <?php if(isset($_COOKIE[ 'email'])){ ?>checked
				<?php
				}
				?> class="checkbox">Remember Me</td>
		</tr>
		</tr>
	</form>
<tr align="center">
<td><b style="color: crimson; font-size: 8pt;" class="badge-warning"><?php
			
			if(isset($_SESSION['error'])==NULL){
		echo '';
		}else{
			echo $_SESSION['error'];
				session_unset();
			}
?></b></td>
</tr>
<tr></tr>
<tr>
<td><b id="or">oR</b></td>
</tr>
<tr></tr>
<tr>
<td><a href="signup.php" id="regs">Register New Guest</a></td>
</tr>
</table> </div>        
        
         <div class="navbar navbar-fixed-bottom">
            <div class="navbar-inner">
                <div class="container-fluid1">
                   <marquee>
                   	 <a class="brand1">Thank You For Joining Us.</a>
                    <a class="brand1">@2018 By MacAlistair.</a>
                    <a href="signup.php" class="brand1">Not Signup yet? <u>Signup Now</u></a>
                   </marquee>
                   
                </div>
            </div>
        </div>
    </body>
</html>
