<?php
include('connection.php');
include( 'processing.php' );
session_start();


if(isset($_GET['visit'])){
	setcookie('vis', "0", time()+10);
	
	if(isset($_COOKIE['vis']) != "0"){
		header("location: author.php");
	}
}
	


if(isset($_SESSION['uid'])){
	
$users_id = $_SESSION['uid'];

	$udetails = "SELECT * FROM users WHERE user_id ='$users_id'";
	$u_run = mysqli_query($connect, $udetails);
	if($u_row = $u_run->fetch_assoc());
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


        <title>Hello,<?php echo $u_row['fname']." ".$u_row['lname']; ?> </title>
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
                    <a class="brand" href="visitor.php">Author Management System</a>
                     <div class="btn-group pull-right">
                      <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i><?php echo $u_row['fname']." ".$u_row['lname'];?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="update.php?id=<?php echo $users_id; ?>">Edit Profile</a></li>
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
                        Welcome <?php echo $u_row['fname'];?>, This is Your Home Page. From Here you can see others Article, change your Profile, Comment on others Article and See comments etc.
                    </div>
                </div><!--/span-->
            </div>
        </div>
        
         <form class="accordion pagination-right breadcrumb help-block">
        	<select name="seelog" onChange="show(this.form)">
        		<option>Choose Article by Author Name</option>
        		<?php
			$authors = "SELECT * FROM user_role WHERE role='Author'";
			$authors_run = mysqli_query($connect, $authors);
			while($authors_row = $authors_run->fetch_assoc()){
				$auth = $authors_row['user_id'];
				
				$names = "SELECT fname FROM users WHERE user_id = '$auth'";
				$names_run =  mysqli_query($connect, $names);
				while($names_row = $names_run->fetch_assoc()){
					?>
					<option><?php echo $names_row['fname']; ?></option>
					<?php
					
				}
			}
	?>
        	
        	</select>
        </form>
        
      <?php
		$art = "SELECT * FROM article ORDER BY article_id DESC";
		$art_run = mysqli_query( $connect, $art );


		while ( $art_row = mysqli_fetch_object( $art_run ) ) {
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
							<strong class="breadcrumb help-line">Title:<b><?php echo $title; ?></b></strong>
							<strong class="breadcrumb help-inline">Published On:<b><?php echo $dat; ?></b></strong>
                           <strong class="breadcrumb help-inline">Published By:<b><?php echo $u_row2['fname']." ".$u_row2['lname']; ?></b></strong>
                            <p>
								<center><b class="breadcrumb"><q><?php echo $title; ?></q></b></center>
                          <p class="carousel btn">
                          <?php echo $descr; ?>
                          </p> 
                           
                           <?php
			$count = mysqli_num_rows( $com_run );
								while ( $com_row = mysqli_fetch_object( $com_run ) ) {

									$useid = $com_row->user_id;
									$comment_des = $com_row->comments;
									$com_dat = $com_row->dat;

									$udetails1 = "SELECT * FROM users WHERE user_id ='$useid'";
									$u_run1 = mysqli_query( $connect, $udetails1 );
									if ( $u_row1 = $u_run1->fetch_assoc() );
									$fname = $u_row1['fname'];
									$lname = $u_row1['lname'];
									$_SESSION['fname'] = $fname;
									$_SESSION['lname'] = $lname;
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
                            <table align="center">
								<form>
									<input type="hidden" name="user" value="<?php echo $users_id; ?>">
									<input style="border-radius: 10px;" name="comments" id="comments" class="help-inline" placeholder="Write a Comment Here!" required/>
									<input type="hidden" name="del" value="<?php echo $art_row->article_id; ?>">
									<tr>

										<td><button type="submit" name="commentvisit" onClick="comt(this.form)" class="btn btn-toolbar btn-large btn-info carousel"><b class="label-warning"><?php echo $count; ?></b><i class="icon-comment"></i></button>
										</td>

										
									</tr>
								</form>

							</table>
                        </div><!--/span-->
                        
                    </div><!--/row-->
                </div><!--/span-->
            </div><!--/row-->
         <?php
		}
		?>
        <script>
			var i=0;
			
			function changing(form){
		var oldpass = prompt("Enter Old Password:");
		var newpass = prompt("Enter New Password:");
		if(oldpass != null && newpass != null || oldpass != "" && newpass != ""){
			form.oldpass.value = oldpass;
			form.newpass.value = newpass;
			form.method = "post";
		}
		
	}
			
			function comt(form){
				
					
						form.method = "post";
						form.action = "posting.php";
						
				
				}
			

		</script>
      
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

}else{
	header("location: login.php");
}


?>