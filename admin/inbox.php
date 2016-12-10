<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>

        <?php 
		  if (isset($_GET['seenId'])) {
		  	$seenId = $_GET['seenId'];

		  	$query = "UPDATE tbl_contact SET status = '1' WHERE id = '$seenId'";
		  	$update = $db->update($query);
		  	if ($update) {
		  		echo "<span style = 'color:green; font-weight:bold;'>Message Send To Seen Box</span>";
		  	}else{
		  		echo "<span style = 'color:green; font-weight:bold;'>Faild to send messege in seen box</span>";
		  	}
		  }
      ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			  <?php
			     $query = "select * from tbl_contact where status = '0' order by id desc";
			     $select = $db->select($query);
			     if ($select) {
			     	$i = 0;
			       while ($result = $select->fetch_assoc()) {
			       	$i++;
			   ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->shortText($result['msg'],30); ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td>
					  <a href="viewMessage.php?msgId=<?php echo $result['id']; ?>">View</a> || 
					  <a href="replyMessage.php?rplyId=<?php echo $result['id']; ?>">Reply
					  </a>||
					   <a onclick="return confirm('Are Sure To Move The Message?');" href="?seenId=<?php echo $result['id']; ?>">Seen</a>
					</td>
				</tr>
       <?php } } ?>
			</tbody>
		</table>
       </div>
    </div>

  <div class="box round first grid">
        <h2>Seen Message</h2>
       <?php
          if(isset($_GET['msgid'])){
           $msgid = $_GET['msgid'];
           $query = "DELETE FROM tbl_contact WHERE id ='$msgid' ";
           $delete = $db->delete($query);
           if ( $delete) {
             echo "<span style ='color:green; font-size:18px;'>Message Deleted Successfully!!</span>";
           }else{
            echo "<span style ='color:green; font-size:18px;'>Failed To Delete Message!!</span>";
           }
          }
       ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
         <?php 
             $query = "select * from tbl_contact where status = '1'";
             $select = $db->select($query);
             if ($select) {
             	$i = 0;
             	while ($result = $select->fetch_assoc()) {
                   $i++;
          ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->shortText($result['msg'],30); ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td>
					<a href="viewMessage.php?msgId=<?php echo $result['id']; ?>">View</a> ||  
					<a onclick="return confirm('Are You Sure For Delete!!');" href= "?msgid=<?php echo $result['id'] ?>">Delete</a> 
					</td>
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