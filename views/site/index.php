<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<body >
<title>Comments</title>

<link rel="stylesheet" href="/css/style.css">


	<div class="container overflow-auto">		
		<div class="titles">
			<h2>Comments</h2>		
			<button type="button" class="popular" value="popular"/>Popular</button>
			<button type="button" class="new" value="new"/>New</button>
			<button type="button" class="old" value="old"/>Old</button>
			<p>Rules</p>
		</div>		
		<form class="form" method="POST" id="commentForm">
			<div class="form-group">
				<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required />
			</div>
			<div class="form-group">
				<textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
			</div>
			<span id="message"></span>
			<br>
			<div class="form-group">
				<input type="hidden" name="commentId" id="commentId" value="0" />
				<input type="submit" name="submit" id="submit" class="btn" value="Post Comment" />
			</div>
		</form>		
		<br>
		<div id="showComments"></div>   
</div>	

<script src="js/comments.js"></script>
</body>
</html>


