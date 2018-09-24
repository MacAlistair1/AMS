<?php
$connect = mysqli_connect("localhost", "root", "", "ams");

if(!$connect){
	?>
        <script>
		alert("Can't Connect to the Database..?");
		</script>
        <?php
	echo mysqli_connect_error();
	}
?>