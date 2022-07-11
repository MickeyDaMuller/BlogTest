<?php 
include_once('Classes/controller.php');

$id = $_GET['id'];
$message = "";
$getItem = new dataModel();
$getAllItem = $getItem->viewItemById($id);

if(!empty($getAllItem)){
foreach($getAllItem as $detailItem){
			  $title = $detailItem["title"];
			  $description = $detailItem["description"];
			  $img_link = $detailItem["img_link"];
			  $create_date = $detailItem["created_date"];
			  $author = $detailItem["author"];
			  $datemade = strftime("%b %d, %Y", strtotime($create_date));
}

}else{

	echo "No details";

}

if(isset($_GET['delete_id'])){

	$id = $_GET['delete_id'];
	$post_id = $_GET['post_id'];
	
	$deletedItem = $getItem->deleteItem($id);

	if($deletedItem=="deleted"){

		header("Location: ".$_SERVER['PHP_SELF']."?id=".$post_id);

	}

}


if(isset($_POST['submit'])){

$post_id = $_POST['post_id'];
$name = $_POST['name'];
$url = $_POST['url'];
$mail = $_POST['mail'];
$comment = $_POST['comment'];
date_default_timezone_set('Europe/Berlin');
$created_at = date('Y-m-d H:i:s');

$query = 'INSERT INTO comments(post_id,name, mail, url,comment,created_at)VALUE(?,?,?,?,?,?)';
$array = [$post_id,$name,$mail,$url,$comment,$created_at];
$addComment = $getItem->addItem($query,$array);
if($addComment=="inserted successful"){
	header("Location: ".$_SERVER['PHP_SELF']."?id=".$post_id);
  
	
}

}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<script type="text/javascript">
		
				function validate(){

//clearing all initial error message
			document.getElementById('nameError').innerHTML = "";
//storing value input in a variable
			var name = document.form.name.value;


			if(name == ""){


				document.getElementById("nameError").innerHTML = "Name is required";
				document.form.name.focus();

				return false;


			}

//clearing all initial error message
			document.getElementById('commentError').innerHTML = "";
//storing value input in a variable
			var comment = document.form.comment.value;


			if(img_comment == ""){


				document.getElementById("commentError").innerHTML = "Comment link is required";
				document.form.comment.focus();

				return false;


			}

//clearing all initial error message
			document.getElementById('accessError').innerHTML = "";
//storing value input in a variable
			var real_access_code = document.form.real_access_code.value;


			if(real_access_code == ""){


				document.getElementById("accessError").innerHTML = "Access code link is required";
				document.form.real_access_code.focus();

				return false;


			}


		
			return true;

}

	</script>
</head>
<body>

		<div>
		<a href="index.php"><img src="https://via.placeholder.com/300.png/09f/fff" height="100px" width="100px" style="padding-right: 10px;"></a>Blog Name
    </div>

    <div>
		<hr>
		<a href="" style="text-decoration:none">Übersichht<a/>
		 <b> | </b> 
		 <a href="" style="text-decoration:none">[Neuer Eintrag]<a/> 
		 <b> | </b>
		 <a href="" style="text-decoration:none">Impressum<a/> 
		 <a href="" style="text-decoration:none;float: right;">[Login/Logout]<a/>
		<hr>
	</div>

	<div style="background-color:lightblue; padding: 10px;">

		<p><?php echo $datemade; ?></p>
		<h1><?php echo $title; ?></h1>
		<img src="<?php echo $img_link; ?>" width="100%" height="300px" >

		<p><?php echo $description; ?></p>

		<p>Author: Michael</p>
		

	</div>

	<?php 

	$query = "SELECT * FROM comments WHERE post_id = ?";
	$array = [$id];	

	$commentList = $getItem->viewItem($query,$array);



	if($message!=""){ echo $message; }

	if(!empty($commentList)){
		foreach($commentList as $comments){
			$delete_id = $comments["id"];
			$name = $comments["name"];
			  $mail = $comments["mail"];
			  $comment = $comments["comment"];
			  $url = $comments["url"];
			  $create_date = $comments["created_date"];

	?>


	<p><?php echo $comment; ?><span><a href="<?php $_SERVER['PHP_SELF'] ?>?delete_id=<?php echo $delete_id; ?>&post_id=<?php echo $id; ?>" onclick="return confirm('Are you sure to delete?');"><b>[X]</b></a></span></p> 

<?php 
	}
}else{

echo "<center><b>No Comment!</b></center>";

}



?>

	<div style="background-color:lightblue; padding: 10px;">
		<center>
			<form action="detail_view.php" method="post" id = "form" name = "form" onsubmit="return validate();">

				<span>Name * </span><input style="width:1000px" type="text" name="name" id="name">
				<p id="nameError" style="color:red;"></p>
				<br>

				<input type="hidden" name="post_id" value ="<?php echo $id; ?>">

				<span>Mail  </span><input style="width:1000px" type="text" name="mail" id="mail">
				<br><br><br>

				<span>URL  </span><input style="width:1000px" type="text" name="url" id="url">
				<br><br><br>

				<span>Comment * </span><textarea rows="5" style="width:1000px" type="text" name="comment" id="comment"></textarea> 
				<p id="commentError" style="color:red;"></p>
				<br>

				<?php 
              
              $access_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
            
              
              ?>

              <span>Type this in the box: <b>(<?php echo $access_code;?>)</b>  </span><input style="width:1000px" type="text" name="real_access_code" id="real_access_code">
              <p id="accessError"></p>
				
				<br><br><br>


               
               

				<input type="submit" name="submit" value="Submit">

			</form>
		</center>

	</div>
</body>
</html>