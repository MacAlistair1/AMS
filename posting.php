<?php
include('connection.php');
session_start();

if(isset($_POST['post'])){
	
	$title = $_POST['title'];
	$descr = $_POST['descr'];
	$date = date('d-m-Y');
	$user_id = $_POST['uid'];
	
	$article = "INSERT INTO article (title, descr, user_id, dat) VALUES ('$title', '$descr', '$user_id', '$date')";
	$article_run = mysqli_query($connect, $article);
	
	if(!$article_run){
		$_SESSION['success'] = "ErroR.......!!!";
		header("location: author.php");
	}else if($article_run){
		
		$_SESSION['success'] = "Article Posted!!!";
		$title = "";
	$descr = "";
	$date = "";
	$user_id = "";
	}
	
}

if(isset($_POST['delete'])){
	$userr = $_POST['user'];
	$del = $_POST['del'];
	
	$delQ = "DELETE FROM article WHERE article_id ='$del' And user_id = '$userr'";
	$del_run = mysqli_query($connect, $delQ);
	
	if(!$del_run){
		$_SESSION['success'] = "ErroR.......!!!";
		header("location: author.php");
	}else if($del_run){
		$delC = "DELETE FROM comment WHERE article_id ='$del' And user_id = '$userr'";
		$delC_run = mysqli_query($connect, $delC);
		$_SESSION['success'] = "Article Deleted!!!";
	}
	
}



if ( isset( $_POST[ 'commentvisit' ] ) ) {
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
				
				header("location: visitor.php");
	
			}

			
		}
	}

if(isset($_POST['deleting'])){
	$del = $_POST['del'];
	$delQ = "DELETE FROM article WHERE article_id ='$del'";
	$del_run = mysqli_query($connect, $delQ);
	
	if(!$del_run){
		$_SESSION['success'] = "ErroR.......!!!";
		header("location: author.php");
	}else if($del_run){
		$_SESSION['success'] = "Article Deleted!!!";
	}
	
}












?>