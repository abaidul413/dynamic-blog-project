<?php include'inc/header.php'; ?>
<?php
   if(!isset($_GET['pageId']) || $_GET['pageId']=="NULL")
   {
   	  header("Location:404.php");
   }else{
   	 $id = $_GET['pageId'];
   }
 ?>

 <?php 
   $query = "select *from tbl_page where id = $id";
   $page = $db->select($query);
   if ($page) {
   	while ($result = $page->fetch_assoc()) {
   		
    // echo $result['page_name'];
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['page_name'] ?></h2>
				 <?php echo $result['page_body'] ?>
				
	</div>

</div>
<?php } }else{ header("Location:404.php");} ?>

<?php include'inc/sidebar.php'; ?>	
<?php include'inc/footer.php'; ?>