<?php
include 'connection.php';
include( 'posting.php' );
if(isset($_GET['id'])){
	$users_id = $_GET['id'];
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
							<li class="active"><a href="articles.php?id=<?php echo $users_id; ?>" >My Articles</a>
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
							<li><form>
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
						<?php echo $u_row['fname'];?>, From Here you can See your All Articles, and can delete and update your Article.
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			
			
			<?php
		$art = "SELECT * FROM article WHERE user_id='$users_id' ORDER BY article_id DESC";
		$art_run = mysqli_query( $connect, $art );

		while ( $art_row = mysqli_fetch_object( $art_run ) ) {

			$title = $art_row->title;
			$descr = $art_row->descr;
			$dat = $art_row->dat;
			$id = $art_row->user_id;
			$art_id = $art_row->article_id;

			$com = "SELECT * FROM comment WHERE article_id='$art_id'";
			$com_run = mysqli_query( $connect, $com );

		
			?>
			
			<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9 pagination-centered">
					<div class="row-fluid help-block alert-error">
						<div class="breadcrumb help-block pagination-centered">
						<table id="showing" width="100%">
							<tr align="center"><td><strong class="breadcrumb help-inline">Title:<b><?php echo $title; ?></b></strong>
							<strong class="breadcrumb help-inline">Published On:<b><?php echo $dat; ?></b></strong>
							<p></td></tr>
							<tr align="center"><td><center><b class="breadcrumb"><q><?php echo $title; ?></q></b>
								</center></td></tr>
								<tr align="center"><td><p class="carousel btn">
									<?php echo $descr; ?>
								
							</p></td></tr>
							
								<form>
									<input type="hidden" name="user" value="<?php echo $id; ?>">
									<input type="hidden" name="del" value="<?php echo $art_row->article_id; ?>">
									<tr align="right">
										
										<td><button type="submit" name="editor" onClick="editing(this.form)" class="btn btn-toolbar btn-large btn-info carousel">Edit</button>
										
										<button type="submit" name="deleting" class="btn btn-toolbar btn-large btn-info carousel" onClick="sure(this.id, 'editing')">Del</button>
										</td>
									</tr>
								</form>

							</table>
							
							
							
						</p>
					</div>
					</div>
				</div>
				</div>
			</div>
		
		<?php
			}
			?>
		
		<script>
				


				function sure( form ) {
					var ch = confirm( "Are you Sure you want to delete this Article?" );

					if ( ch ) {
						form.method = "post";
					} else {
						form.onload();
					}
				}
			
			function changing(form){
		var oldpass = prompt("Enter Old Password:");
		var newpass = prompt("Enter New Password:");
		if(oldpass != null && newpass != null || oldpass != "" && newpass != ""){
			form.oldpass.value = oldpass;
			form.newpass.value = newpass;
			form.method = "post";
		}
		
	}
			function editing(form){
				form.method = "post";
				form.action = "editor.php";
			}
			
		</script>
		<?php
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
	}
	
	?>
