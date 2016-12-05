﻿<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
				    <th width="5%">Serial</th>
					<th width="15%">Post Title</th>
					<th width="15%">Description</th>
					<th width="5%">Category</th>
					<th width="10%">Image</th>
					<th width="10%">Author</th>
					<th width="10%">Tags</th>
					<th width="15%">Date</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>

			<?php
			  $query = "SELECT tbl_post.*, tbl_category.name from tbl_post, tbl_category WHERE tbl_post.id = tbl_category.id"; 
			  $postList = $db->select($query);
			  if ($postList) {
			  	$i = 0;
			  	while ($result = $postList->fetch_assoc()) {
			  		$i++;
			 ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><?php echo $fm->shortText($result['body'],50); ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><img src = "<?php echo $result['image']; ?>" width = "50px" height = "70px"/></td>
					<td><?php echo $result['author']; ?></td>
					<td><?php echo $result['tags']; ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td><a href="">Edit</a> || <a href="">Delete</a></td>
				</tr>
			<?php } } ?>	
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
    
<?php include"inc/footer.php" ?>