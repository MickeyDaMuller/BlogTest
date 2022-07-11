<?php 
include_once('Classes/controller.php');

$page = $_GET['page'];
$dbTable = 'post';
$getItem = new dataModel();
$getAllItemByPagination = $getItem->viewItemByPagination($page,$dbTable);


?>


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
		 <a href="add_entry.php" style="text-decoration:none">[Neuer Eintrag]<a/> 
		 <b> | </b>
		 <a href="" style="text-decoration:none">Impressum<a/> 
		 <a href="" style="text-decoration:none;float: right;">[Login/Logout]<a/>
		<hr>
	</div>


     <?php 

if(!empty($getAllItemByPagination['posts'])){
     foreach($getAllItemByPagination['posts'] as $row){

 $id = $row["id"];
  $title = $row["title"];
  $description = $row["description"];
  $img_link = $row["img_link"];
  $create_date = $row["created_date"];
  $author = $row["author"];
  $datemade = strftime("%b %d, %Y", strtotime($create_date));
  
?>
	<div style="background-color: lightblue;padding: 5px;">

		<a href="detail_view.php?id=<?php echo $id; ?>" style="text-decoration:none;"><p>
<span style="float: right;"><center><img src="<?php echo $img_link; ?>" style="float: right; margin-right: 0px;height: 120px;width: 300px;"></center></span></p></a>

		
	    <div class="wrapper">
	        <article class="text-msg">

	            		<p><a href="detail_view.php?id=<?php echo $id; ?>" style="text-decoration:none;"><p>
<?php echo $create_date; ?></a> - <?php echo $title; ?></p>
		
	        <a href="detail_view.php?id=<?php echo $id; ?>" style="text-decoration:none;"><p>

	            <?php echo $description; ?>


	        </p></a>

	        <span style="padding-right:850px;">Author: Michael Isijola</span><a href="detail_view.php?id=<?php echo $id; ?>" style="text-decoration:none;">
<span >Comment: 300</span></a>

	        </article>

	    </div>

	</div>
	<?php 
	 }
}else{

	echo "<center><b>No post!</b></center>";
}

	?>
	<br>
	<br>
	<br>
	<center style="border-style: groove;background-color: lightgray;">
	<?php 
	$total_pages = $getAllItemByPagination['paginator']['total_pages'];
	$page = $getAllItemByPagination['paginator']['page'];


	for ($page = 1; $page <= $total_pages ; $page++):
	
		?>

        <a href='<?php echo "?page=$page"; ?>' class="links">
            <?php  echo $page; ?>
        </a>
    <?php 



endfor; 

?>
	</center>
	

</body>
</html>
