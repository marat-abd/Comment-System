<?php
include_once("db_connect.php");
$commentQuery = "";
$sort = 0;
if(!empty($_POST["text"]))
{
	if($_POST["text"] === "popular")
	{
		$sort = 1;
		$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '0' ORDER BY rating DESC";	
	}
	elseif($_POST["text"] === "old")
	{
		$sort = 2;
		$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '0' ORDER BY id ASC";
	}
	else{
		$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '0' ORDER BY id DESC";
	}
}
else{
	$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '0' ORDER BY id DESC";
}
$commentsResult = mysqli_query($conn, $commentQuery) or die("database error:". mysqli_error($conn));
$commentHTML = '';
while($comment = mysqli_fetch_assoc($commentsResult)){
	$commentHTML .= '
		<div style="width: 500px; margin-bottom:20px">
		<div class="nik"><b>'.$comment["sender"].'</b> on <i>'.$comment["date"].'</i><button type="button" class="reply" id="'.$comment["id"].'">Reply</button><div style="float: right;"><button type="button" class="buttonCountPlus" value="'.$comment["id"].'" name="btnPlus">+</button><button type="button" class="buttonCountMinus" value="'.$comment["id"].'" name="btnMinus">-</button>'.$comment["rating"].'</div></div>
		<div class="comm">'.$comment["comment"].'</div>
		</div> ';
	$commentHTML .= getCommentReply($conn, $comment["id"],$sort);
}
echo $commentHTML;

function getCommentReply($conn, $parentId = 0,$sort, $marginLeft = 0) {
	$commentHTML = '';
	if($sort === 1)
	{
		$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '".$parentId."' ORDER BY parent_id DESC, rating DESC";	
	}
	elseif($sort === 2)
	{
		$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '".$parentId."' ORDER BY id ASC";
	}
	else{
		$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '".$parentId."' ORDER BY id DESC";
	}
	//$commentQuery = "SELECT id, parent_id, comment, sender, date, rating FROM comment WHERE parent_id = '".$parentId."' ";	
	$commentsResult = mysqli_query($conn, $commentQuery);
	$commentsCount = mysqli_num_rows($commentsResult);
	if($parentId == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0) {
		while($comment = mysqli_fetch_assoc($commentsResult)){  
			$commentHTML .= '
				<div class="" style="margin-left:'.$marginLeft.'px; width: 500px; margin-bottom:20px;">
				<div class="nik"><b>'.$comment["sender"].'</b> on <i>'.$comment["date"].'</i><button type="button" class="reply" id="'.$comment["id"].'">Reply</button><div style="float: right;"><button type="button" class="buttonCountPlus" value="'.$comment["id"].'" name="btnPlus">+</button><button type="button" class="buttonCountMinus" value="'.$comment["id"].'" name="btnMinus">-</button>'.$comment["rating"].'</div></div>
				<div class="comm">'.$comment["comment"].'</div>
				</div>
				';
			$commentHTML .= getCommentReply($conn, $comment["id"],$sort, $marginLeft);
		}
	}
	return $commentHTML;
}
?>