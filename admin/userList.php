<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
   <?php 
      if (isset($_GET['userid'])) {
          $userid = $_GET['userid'];

          $query = "delete from tbl_user where id = '$userid'";
          $delete = $db->delete($query);
          if ($delete) {
            echo "<span style = 'color:green'>User Deleted Successfully!!</span>";
          }else{
            echo "<span style = 'color:red'>Failed to Delete User</span>";
          }
      }
   ?>

        <div class="block">        
         <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Details</th>
                    <th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
          <?php
             $query = "select * from tbl_user order by id desc";
             $userlist = $db->select($query);

             if($userlist) {
                $i = 0;
             	while ($result = $userlist->fetch_assoc()) {		
                  $i++;
         ?>

				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $fm->shortText($result['details'],30); ?></td>
                    <td>
                      <?php 
                        if ($result['role'] == '0') {
                            echo "Admin";
                        }elseif ($result['role'] == '1') {
                           echo "Athor";
                        }elseif ($result['role'] == '2') {
                            echo "Editor";
                        }
                      ?>   
                    </td>

					         <td>
                        <a href="userView.php?userid=<?php echo $result['id'] ?>">View</a>
                        <?php if (Session::get('userRole') == '0') { ?>
                           || <a onclick="return confirm('Are You Sure For Delete!!');" href= "?userid=<?php echo $result['id'] ?>">Delete</a>     
                       <?php } ?>         
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

