<?php 
// starting session
//session_start();
//db connection
require_once 'konn.php';
//session check
//include('session.php');


if(isset($_POST['submit'])){



$author = $_SESSION[''];
$text = $_POST['text'];
$title = $_POST['title'];
$link_img = $_POST['link_img'];
date_default_timezone_set('Europe/Berlin');
$created_at = date('Y-m-d H:i:s');
try{
$insert = $pdo->prepare('INSERT INTO post(title, description, img_link,author,created_date)VALUE(?,?,?,?)');

if($insert->execute([$title,$text,$link_img,$author,$created_at])){


	echo header("Location: index.php");


}


}catch(PDOException $e){

echo $e->getMessage();


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
			document.getElementById('titleError').innerHTML = "";
//storing value input in a variable
			var title = document.form.title.value;


			if(title == ""){


				document.getElementById("titleError").innerHTML = "Title is required";
				document.form.title.focus();

				return false;


			}

//clearing all initial error message
			document.getElementById('imgLinkError').innerHTML = "";
//storing value input in a variable
			var img_link = document.form.link_img.value;


			if(img_link == ""){


				document.getElementById("imgLinkError").innerHTML = "Image link is required";
				document.form.link_img.focus();

				return false;


			}

//clearing all initial error message
			document.getElementById('textError').innerHTML = "";
//storing value input in a variable
			var text = document.form.text.value;


			if(text == ""){


				document.getElementById("textError").innerHTML = "Text is required";
				document.form.text.focus();

				return false;


			}
		
			return true;

}
	</script>
</head>
<body>


	<div>
		<a href="home.php"><img src="https://via.placeholder.com/300.png/09f/fff" height="100px" width="100px" style="padding-right: 10px;"></a>Blog Name
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
		<center>
			<form action="add_entry.php" method="post" id = "form" name = "form" onsubmit="return validate();">

				<span>Title * </span><input style="width:1000px" type="text" name="title" id="title">
				<p id="titleError" style="color: red;"></p>
				<br>

				<span>Link zum Bild *  </span><input style="width:1000px" type="text" name="link_img" id="link_img">
				<p id="imgLinkError" style="color: red;"></p>
				<br>

				
				<span>Text * </span><textarea rows="5" style="width:1000px" type="text" name="text" id="text"></textarea> 
				<p id="textError" style="color: red;"></p>
				<br>

				<input type="submit" name="submit" value="Submit">

			</form>
		</center>

	</div>

</body>
</html>