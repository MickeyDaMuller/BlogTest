<?php 
// starting session
//session_start();
//db connection
require_once 'konn.php';
//session check
//include('session.php');

$db = new Konn();
$pdo = $db->dbConn();


try{

$sql = $pdo->prepare("SELECT COUNT(id) FROM post");
$sql->execute();
$row = $sql->rowCount();
// Here we have the total row count
$rows = $row[0];
// This is the number of results we want displayed per page
$page_rows = 3;
// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
  $last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
// This is your query again, it is for grabbing just one page worth of rows by applying $limit
$sql = $pdo->prepare("SELECT id, title, description, img_link, author,created_date FROM post ORDER BY id DESC $limit");
$query = $sql->execute();
// This shows the user what page they are on, and the total number of pages
$textline1 = "Testimonials (<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last</b>";
// Establish the $paginationCtrls variable
$paginationCtrls = '';
// If there is more than 1 page worth of results

}catch(PDOException $e){

	echo $e->getMessage();

}


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

     if($sql->rowCount()>0){

   $list = '';
while($row = $sql->fetch()){

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
<?php echo $datemade; ?></a> - <?php echo $title; ?></p>
		
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


	<center style="border-style: groove;background-color: lightgray;">

   <?php

 
  echo ' <p> '.$textline2.' </p>';
echo ' <p> '.$list.' </p>';



if($last != 1){
  /* First we check if we are on page one. If we are then we don't need a link to 
     the previous page or the first page so we do nothing. If we aren't then we
     generate links to the first page, and to the previous page. */
  if ($pagenum > 1) {
        $previous = $pagenum - 1;

         
   echo '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="page-numbers previous">Previous</a>&nbsp; &nbsp;';  



     // Render clickable number links that should appear on the left of the target page number
    for($i = $pagenum-4; $i < $pagenum; $i++){
      if($i > 0){
            $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
      }
      }
    }

  // Render the target page number, but without it being a link
  $paginationCtrls .= ''.$pagenum.' &nbsp; ';
  // Render clickable number links that should appear on the right of the target page number
  for($i = $pagenum+1; $i <= $last; $i++){
    $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'">'.$i.'</a> &nbsp; ';
    if($i >= $pagenum+4){
      break;
    }
  }
  // This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;

         echo '&nbsp; &nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="page-numbers next">Next</a>'; 
    }
}


echo '<span class="page-numbers ">'.$paginationCtrls.'</span>';

       ?>
	
	</center>

</body>
</html>