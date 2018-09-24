<?php
include( 'connection.php' );

session_start();


if ( isset( $_POST[ 'editor' ] ) ) {

	$users_id = $_POST[ 'user' ];
	$article_id = $_POST[ 'del' ];

	$udetails = "SELECT * FROM users WHERE user_id ='$users_id'";
	$u_run = mysqli_query( $connect, $udetails );
	if ( $u_row = $u_run->fetch_assoc() );

	?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">



		<!-- Le styles -->
		<link rel="stylesheet" href="css/bootstrap.css">

		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
		</style>


		<title>Hello,
			<?php echo $u_row['fname']." ".$u_row['lname']; ?> </title>
	</head>

	<body>


		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
				


					<a class="brand" href="author.php">Author Management System</a>
					<div class="nav-collapse">
						<ul class="nav">
							<li><a href="visitor.php?visit=1">Stay As Visitor</a>
							</li>
							<li><a href="articles.php?id=<?php echo $users_id; ?>">My Articles</a>
							</li>
						</ul>
					</div>
					<div class="btn-group pull-right">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i><?php echo $u_row['fname']." ".$u_row['lname'];?>
                            <span class="caret"></span>
                        </a>
					


						<ul class="dropdown-menu">
							<li><a href="update.php?id=<?php echo $users_id; ?>">Edit Profile</a>
							</li>
							<li class="divider"></li>
							<li>
								<form>
									<input type="hidden" name="hidid" value="<?php echo $users_id; ?>">
									<input type="hidden" name="oldpass" id="oldpass">
									<input type="hidden" name="newpass" id="newpass">
									<button type="submit" name="changep" style="border: none; background-color: white; text-align: center; color: black; text-decoration: underline; text-decoration-color: red;" onClick="changing(this.form)">Change Password</button>
								</form>
							</li>
							<li class="divider"></li>
							<li><a href="logout.php">Log Out</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					<div id="welcome" class="badge">
						Welcome
						<?php echo $u_row['fname'];?>, From Here You can edit your Article.
					</div>
				</div>
				<!--/span-->
			</div>
		</div>
	
	<?php
	
	$eart = "SELECT * FROM article WHERE user_id = '$users_id' And article_id = '$article_id'";
	$eart_run = mysqli_query($connect, $eart);
	if($eart_row = $eart_run->fetch_assoc());
	?>
	
	
	
	
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9 pagination-centered">
					<div class="row-fluid help-block alert-error">
						<div class="breadcrumb help-block pagination-centered">
						
						<table id="editing" width="70%">
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="hidden" name="hiddenuser" value="<?php echo $users_id; ?>">
							<input type="hidden" name="hiddenart" value="<?php echo $article_id; ?>">
							<tr><td>Title:<input type="text" class="input-append" name="etitle" value="<?php echo $eart_row['title'] ?>" required></tr>
								<tr><td>Article:<input type="text" class="input-xxxlarge" name="edescr" value="<?php echo $eart_row['descr'] ?>" required/></td></tr>
								<tr align="center">
									<td><button type="submit" name="eupdate" class="btn btn-toolbar btn-large btn-info carousel">Update</button></td>
								</tr>
							</form>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>








		<?php

		}
		?>

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

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap-dropdown.js"></script>
	</body>

	</html>
	

<?php
		if(isset($_REQUEST['eupdate'])){
			$uart = $_POST['hiddenuser'];
			$aart = $_POST['hiddenart'];
			$etitle = $_POST['etitle'];
			$edescr = $_POST['edescr'];
			echo $uart." ".$aart." ".$etitle;
			$uQuery = "UPDATE `article` SET `title` = '$etitle', `descr` = '$edescr' WHERE `article`.`article_id` = '$aart' ";
			
			$uQuery_run = mysqli_query($connect, $uQuery);
			if(!$uQuery_run){
				$_SESSION['error'] = "Article Cannot be Updated!!";
				header("location: login.php");
			}else{
				$_SESSION['error'] = "Article Updated!!";
				header("location: login.php");
			}
			
		}

?>











