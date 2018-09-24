<?php
include( 'connection.php' );
include( 'processing.php' );
session_start();
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

	<title>Update Your Information</title>
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand2" href="index.php">Author Management System</a>
			</div>
		</div>
	</div>


	<?php
	if ( isset( $_GET[ 'id' ] ) )
		$id = $_GET[ 'id' ];
	$fromUsers = "SELECT * FROM users WHERE user_id='$id' ";
	$open = mysqli_query( $connect, $fromUsers );
	$row = $open->fetch_assoc();

	$fromSecure = "SELECT * FROM secure WHERE user_id='$id' ";
	$open1 = mysqli_query( $connect, $fromSecure );
	$row1 = $open1->fetch_assoc();

	$fromUser_role = "SELECT * FROM user_role WHERE user_id='$id' ";
	$open2 = mysqli_query( $connect, $fromUser_role );
	$row2 = $open2->fetch_assoc();
	$tys = $row2[ 'role' ];

	?>

	<div class="centering2">
		<table align="center" width="70%" id="cen3">
			<form action="" method="post">
				<caption>Update Your Information</caption>
				<tr>
					<td>First Name</td>
				</tr>
				<tr>
					<input type="hidden" value="<?php echo $id; ?>" name="hid">
					<td><input type="text" name="fname" id="fname" value="<?php echo $row['fname'];?>" placeholder="Enter First Name" required>
					</td>
				</tr>
				<tr>
					<td>Last Name</td>
				</tr>
				<tr>
					<td><input type="text" name="lname" id="lname" value="<?php echo $row['lname'];?>" placeholder="Enter Last Name" required>
					</td>
				</tr>

				<tr>
					<td>E-mail</td>
				</tr>
				<tr>
					<td><input type="email" name="email" id="email" value="<?php echo $row1['email'];?>" placeholder="Your E-mail" required>
					</td>
				</tr>
				<tr>
					<td>Phone</td>
				</tr>
				<tr>
					<td><input type="tel" name="phone" value="<?php echo $row['phone'];?>" placeholder="Enter Phone Number" required>
					</td>
				</tr>
				<tr>
					<td>Address</td>
				</tr>
				<tr>
					<td><input type="text" name="address" value="<?php echo $row['address'];?>" placeholder="Enter Address" required>
					</td>
				</tr>
				<tr>
					<td>Occupation</td>
				</tr>
				<tr>
					<td><input type="text" name="occ" value="<?php echo $row['occ'];?>" placeholder="Your Occupation" required>
					</td>
				</tr>

				<tr>
					<td>Change Your Role:</td>
					<tr>
						<td align="center"><input type="radio" name="type" class="radio" value="Visitor" <?php if($tys=="Visitor" ){?> checked
							<?php } ?> >
						</td>
						<td><b style="color: aqua; margin-left: -150%;">Visitor</b>
						</td>
					</tr>
					<tr>
						<td align="center"><input type="radio" name="type" class="radio" value="Author" <?php if($tys=="Author" ){?> checked
							<?php } ?> >
						</td>
						<td><b style="color: aqua; margin-left: -150%;">Author</b>
						</td>
					</tr>
				</tr>
				<tr>
					<td>Your Password</td>
				</tr>
				<tr>
					<td><input type="password" name="password" placeholder="Old Password Required" required>
					</td>
				</tr>
				<tr align="center">
					<td><button type="submit" name="update" id="update">Update</button>
					</td>
				</tr>
			</form>
		</table>
	</div>

	<div class="navbar navbar-fixed-bottom">
		<div class="navbar-inner">
			<div class="container-fluid1">
				<marquee>
					<a class="brand1">Thank You For Joining Us.</a>
					<a class="brand1">@2018 By MacAlistair.</a>
				</marquee>

			</div>
		</div>
	</div>
</body>

</html>