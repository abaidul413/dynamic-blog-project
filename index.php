<?php include'inc/header.php'; ?>
<?php include'inc/slider.php'; ?>

<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>

  <?php

     $db = new Database();
     $fm = new Format();

  ?>


	
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
           
           <!-- Pagination process -->
           <?php
               $per_page = 3;
               if(isset($_GET['page']))
               {
               	  $page = $_GET['page'];
               }else{
               	   $page = 1;
               }
               $start_form = ($page-1)*$per_page;

           ?>
           <!-- Pagination process End-->


           <?php 
               $query = "select * from tbl_post limit $start_form,$per_page";
               $post = $db->select($query);

               if($post){

               	while ($result = $post->fetch_assoc()) {
           ?>

			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $resutl['id']; ?>"><?php echo $result['title']; ?></a>
				</h2>

				<h4>
				<?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a>
				</h4>

				<a href="#"><img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/></a>

				<?php echo $fm->shortText($result['body']); ?>

				<div class="readmore clear">
					<a href="post.php?id=<?php echo $resutl['id']; ?>">Read More</a>
				</div>
			</div>
    <?php } ?>	<!-- End of whilop -->	

    <!-- Pagination -->

      <?php 
       
	       $query = "select * from tbl_post";
	       $result = $db->select($query);
	       $total_row = mysqli_num_rows($result);
	       $total_pages = ceil($total_row/$per_page);

	       echo "<span class='pagination'><a href='index.php?page=1'>".'First page'."</a>";
	       for ($i=1; $i <=$total_pages ; $i++) { 
	        	echo "<a href = 'index.php?page=".$i."'>".$i."</a>";
	        } 
	       echo "<a href='index.php?page= $total_pages'>".'Last page'."</a></span>"
       ?>

    <!-- End of pagination -->

     <?php  }else{header("location:404.php");}  ?>

		</div>
		
<?php include'inc/sidebar.php'; ?>	
<?php include'inc/footer.php'; ?>
