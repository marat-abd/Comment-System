<?php
include_once("db_connect.php");
if(!empty($_POST["id"])){
	$query = "SELECT rating FROM comment WHERE id='".$_POST["id"]."'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row["rating"];
	$count++;
	
	
	$insertComments = "UPDATE comment SET rating='".$count."' WHERE id='".$_POST["id"]."'";
	mysqli_query($conn, $insertComments) or die("database error: ". mysqli_error($conn));	
	$message = '<label class="text-success">Comment posted Successfully.</label>';
	$status = array(
		'error'  => 0,
		'message' => $message
	);	
}elseif(empty($_POST["id"])){
$message = '<label class="text-danger">Error: Empty</label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);
}
else {
	$message = '<label class="text-danger">Error: Comment not posted.</label>';
	$status = array(
		'error'  => 1,
		'message' => $message
	);	
}
echo json_encode($status);
include_once("show_comments.php");
?>