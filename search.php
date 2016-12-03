<?php include'inc/header.php'; ?>
   <?php
     $db = new Database();
     $fm = new Format();
   ?>


   <?php 
      if (!isset($_GET['search']) || $_GET['search'] == NULL) {
      	header("Location:404.php");
      }else{
      	$search = $_GET['search'];
      }
    ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
           
           <?php
              $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
              $catpost = $db->select($query);
              if( $catpost) 
              {
              	while ($result = $catpost->fetch_assoc()) { 	 	
            ?>

           <div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a>
				</h2>

				<h4>
				<?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a>
				</h4>

				<a href="#"><img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/></a>

				<?php echo $fm->shortText($result['body']); ?>

				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
			<?php } }else{ ?>

        <p>Your Search query is not found</p>

      <?php } ?>
      </div>
		
<?php include'inc/sidebar.php'; ?>	
<?php include'inc/footer.php'; ?>