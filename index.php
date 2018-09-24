<?php
include( 'connection.php' );
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

	<title>Welcome | Home</title>
</head>

<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="index.php">Author Management System</a>
				<div class="nav-collapse">
					<ul class="nav1">
						<li><a href="signup.php">Sign Up</a>
						</li>
						<li><a href="login.php">Log In</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>



	<?php
	$art = "SELECT * FROM article ORDER BY article_id DESC";
	$art_run = mysqli_query( $connect, $art );


	while ( $art_row = mysqli_fetch_object( $art_run ) ) {
		//	$count = mysqli_fetch_lengths( $art_run );
		$title = $art_row->title;
		$descr = $art_row->descr;
		$dat = $art_row->dat;
		$id = $art_row->user_id;
		$art_id = $art_row->article_id;

		$com = "SELECT * FROM comment WHERE article_id='$art_id'";
		$com_run = mysqli_query( $connect, $com );

		$udetails2 = "SELECT * FROM users WHERE user_id ='$id'";
		$u_run2 = mysqli_query( $connect, $udetails2 );
		if ( $u_row2 = $u_run2->fetch_assoc() );


		?>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span9 pagination-centered">
				<div class="row-fluid help-block alert-error">
                        <div class="breadcrumb help-block pagination-centered">
						<strong class="breadcrumb help-inline">Title:<b><?php echo $title; ?></b></strong>
						<strong class="breadcrumb help-inline">Published On:<b><?php echo $dat; ?></b></strong>
						<strong class="breadcrumb help-inline">Published By:<b><?php echo $u_row2['fname']." ".$u_row2['lname']; ?></b></strong>
						<p>
							<center><b class="breadcrumb"><q><?php echo $title; ?></q></b>
							</center>
							<p class="carousel btn">
								<?php echo $descr; ?>
							</p>

							<?php
							while ( $com_row = mysqli_fetch_object( $com_run ) ) {

								$useid = $com_row->user_id;
								$comment_des = $com_row->comments;
								$com_dat = $com_row->dat;

								$udetails1 = "SELECT * FROM users WHERE user_id ='$useid'";
								$u_run1 = mysqli_query( $connect, $udetails1 );
								if ( $u_row1 = $u_run1->fetch_assoc() );
								?>
							<i>
								<center>
									<b class="accordion-toggle help-block alert-info">
										<?php echo $u_row1['fname']; ?> says
										<q>
											<?php echo $comment_des; ?>
										</q> on
										<?php echo $com_dat; ?>
									</b>

								</center>
								<?php
								}
								?>
							</i>



						</p>
					</div>
					<!--/span-->

				</div>
				<!--/row-->
			</div>
			<!--/span-->
		</div>
		<!--/row-->
		<?php
		}
		echo "<a href='signup.php' class='brand1'><u>Read more...</u></a>";
		echo "<a href='login.php' class='help-block' style='font-size:13pt;'><center><u>Read more.......</u></center></a>";

		?>



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