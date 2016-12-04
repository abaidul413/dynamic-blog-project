<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">        
         <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
          <?php
             $query = "select * from tbl_category order by id desc";
             $catlist = $db->select($query);

             if($catlist) {
                $i = 0;
             	while ($result = $catlist->fetch_assoc()) {		
                  $i++;
            ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><a href="catlistEdit.php?id=<?php echo $result['id'] ?>">Edit</a> || <a onclick="return confirm('Are You Sure For Delete!!');" href= "catlistDelete.php?id=<?php echo $result['id'] ?>">Delete</a></td>
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

