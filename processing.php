<?php
include('connection.php');

if ( isset( $_POST[ 'login' ] ) ) {

	$email = $_POST[ 'email' ];
	$password = $_POST[ 'password' ];


	if ( isset( $_POST[ 'remember' ] ) ) {
		setcookie( 'email', $email, time() + 60 * 60 );
		setcookie( 'pass', $password, time() + 60 * 60 );
	} else {
		setcookie( 'email', $email, time() - 60 * 60 );
		setcookie( 'pass', $password, time() - 60 * 60 );
	}
	$mpass = md5( $password );
	$check = "SELECT * FROM secure WHERE email = '$email' And password = '$mpass' ";

	$run = mysqli_query( $connect, $check );

	if ( !$row = $run->fetch_assoc() ) {
		$_SESSION[ 'error' ] = "<a href='signup.php' id='regme'>Register Now!</a> " . "Not Registered Guest!!";
		
	} else {
		$id = $row['id'];
		
		$ret = "SELECT * FROM secure WHERE id='$id'";
		$ret_run = mysqli_query( $connect, $ret );
		if($ret_row = $ret_run->fetch_assoc() );
		$uid = $ret_row['user_id'];
		$_SESSION['uid'] = $uid;
		$role = "SELECT * FROM user_role WHERE user_id='$uid'";
		$role_run = mysqli_query( $connect, $role );
		if($role_row = $role_run->fetch_assoc());
		$user_role = $role_row['role'];
		
		if($user_role == "Author"){
			header("location:author.php");
		}else if($user_role == "Visitor"){
			header("location:visitor.php");
		}else{
			header("location:index.php");
		}
		
	}
	
}







if(isset($_POST['signup'])){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$address = $_POST['address'];
	$occ = $_POST['occ'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$type = $_POST['type'];
	
	if($password == $cpassword){
		$insert = "INSERT INTO users (fname, lname, address, phone, gender, dob, occ) VALUES ('$fname', '$lname', '$address', '$phone', '$gender', '$dob', '$occ')";	
	$run = mysqli_query($connect, $insert);
	$c_id = mysqli_insert_id($connect);
		$insert1 = "INSERT INTO secure (email, password, user_id) VALUES ('$email', '$password', '$c_id')";	
	$run1 = mysqli_query($connect, $insert1);
		$insert2 = "INSERT INTO user_role (role, user_id) VALUES ('$type', '$c_id')";	
	$run2 = mysqli_query($connect, $insert2);
		
		if(!$run && !$run1 && !$run2){
			$_SESSION['ers'] = "Problem to Register New Guest.";
	}else if($run && $run1){
		header("location: login.php");
	}
		
	}
	
}






if(isset($_POST['update'])){
	$fname1 = $_POST['fname'];
	$lname1 = $_POST['lname'];
	$address1 = $_POST['address'];
	$phone1 = $_POST['phone'];
	$email1 = $_POST['email'];
	$occ1 = $_POST['occ'];
	$type1 = $_POST['type'];
	$password1 =md5($_POST['password']);
	$hid = $_POST['hid'];
	//echo $fname1." ".$lname1." ".$address1." ".$phone1." ".$email1." ".$occ1." ".$type1." ".$hid;
	
	$case ="SELECT * FROM secure WHERE password = '$password1' And user_id = '$hid' ";
		$caserun = mysqli_query($connect, $case);
		if(!$err = $caserun->fetch_assoc()){
			$_SESSION['error'] = "Old Password Incorrect during Update!";
			header("location: login.php");
		}else{
			$update = "UPDATE `users` SET `fname` = '$fname1', `lname` = '$lname1', `address` = '$address1', `phone` = '$phone1', `occ` = '$occ1' WHERE `users`.`user_id` = $hid";
			$res = mysqli_query($connect, $update);
			
			$update1 = "UPDATE `secure` SET `email` = '$email1' WHERE `secure`.`user_id` = $hid";
				$res1 = mysqli_query($connect, $update1);
			
			$update2 = "UPDATE `user_role` SET `role` = '$type1' WHERE `user_role`.`user_id` = $hid";
				$res2 = mysqli_query($connect, $update2);
			
			if(!$res && !$res1 && !$res2){
			$_SESSION['error']= "Can't Change Info.!!";
			header("location: login.php");
			}else{
			$_SESSION['error']= "Information Updated Successfully!!,Login with New Info.!!";
			header("location: login.php");
			}
		}
	
}




if ( isset( $_POST[ 'comment' ] ) ) {
		$us = $_POST[ 'user' ];
		$comment = $_POST[ 'comments' ];
		$del = $_POST[ 'del' ];
		$dat = date( 'd-m-Y' );
	
		if ( !empty( $comment ) ) {
			$comP = "INSERT INTO comment (user_id, article_id, comments, dat) VALUES('$us', '$del', '$comment', '$dat')";
			$comP_run = mysqli_query( $connect, $comP );
			
			$userCode = "SELECT * FROM user_role WHERE user_id = '$us' ";
			$userCode_run = mysqli_query($connect, $userCode);
			
			if($userCode_row = mysqli_fetch_object($userCode_run));
				$urole = $userCode_row->role;
			
			if ( !$comP_run ) {
				$_SESSION[ 'success' ] = "ErroR.......!!!";
				header("location: author.php");
			}else{
				
				header("location: author.php");
	
			}

			
		}
	}



if(isset($_POST['changep'])){
		$ids = $_POST['hidid'];
		$oldpass = md5($_POST['oldpass']);
		$newpass = md5($_POST['newpass']);
		
		if(!empty($oldpass) && !empty($newpass)){
			$checking = "SELECT * FROM secure WHERE user_id = '$ids'";
			$checking_run = mysqli_query($connect, $checking);
			if($checking_row = $checking_run->fetch_assoc());
			$pas = $checking_row['password'];
			
			if($pas == $oldpass){
				$up = "UPDATE secure set password = '$newpass' WHERE user_id = '$ids'";
				$up_run = mysqli_query($connect, $up);
				if(!$up_run){
					?>
				<script>
					alert('Password cannot be Change!!');
		</script>
				<?php
				}else{
					$_SESSION['error'] = "Password Changed! Login With New Password";
					header("location: login.php");
				}
			}else{
				?>
				<script>
					alert('Old Password not Match!!');
		</script>
				<?php
			}
		}
		
		
	}







?>