<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
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
			<form>

				<span>Title * </span><input style="width:1000px" type="text" name="title" id="title">
				<p id="nameError"></p>
				<br>

				<span>Link zum Bild  </span><input style="width:1000px" type="text" name="link_img" id="link_img">
				<p id="mailError"></p>
				<br>

				
				<span>Text * </span><textarea rows="5" style="width:1000px" type="text" name="text" id="text"></textarea> 
				<p id="mailError"></p>
				<br>

				<input type="submit" name="submit" value="Submit">

			</form>
		</center>

	</div>

</body>
</html>