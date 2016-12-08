<?php include'inc/header.php'; ?>

    <?php 
      if (!isset($_GET['id']) || $_GET['id'] == NULL) {
      	header("Location:404.php");
      }else{
      	$id = $_GET['id'];
      }
    ?>



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
               <?php
                 $query = "select *from tbl_post where id = $id";
                 $post = $db->select($query);
                 if($post)
                 {
                 	while ($result = $post->fetch_assoc()) {
                 	
               ?>

				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <?php echo $result['author'] ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<?php echo $result['body']; ?>
				
			
		 <div class="relatedpost clear">
			<h2>Related articles</h2>

            <?php
               
                $cat_id = $result['cat_id'];
                $cat_query = "select * from tbl_post where cat_id = '$cat_id' limit 6";
                $cat_post = $db->select($cat_query);
                if($cat_post)
                {
                 while ($relResult = $cat_post->fetch_assoc()) {   
             ?>
                
			   <a href="post.php?id=<?php echo $relResult['id']; ?>">
			   <img src="admin/<?php echo $relResult['image']; ?>" alt="post image"/></a>

		 <?php } }else{echo"No Related Post";} ?>
		</div>
        
     <?php } }else{ header("Location:404.php");} ?>	

	</div>
</div>


<?php include'inc/sidebar.php'; ?>	
<?php include'inc/footer.php'; ?>