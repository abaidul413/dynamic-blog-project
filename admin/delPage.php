<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php
  if (!isset($_GET['pageId']) || $_GET['pageId'] == 'NULL') {
  	 header("Location:index.php");
  }else{
  	$pageId = $_GET['pageId'];
  }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Delete Post</h2>
        <div class="block">
          <?php
              $query = "DELETE FROM tbl_page WHERE id ='$pageId' ";
              $is_delete = $db->delete($query);
              if ($is_delete) {
                 echo "<script>alert('Data Deleted Successfully!')</script>";
                 echo "<script>windows:location = 'index.php'</script>";
              }else{
                echo "<script>alert('Failed to Data Delete!')</script>";
                echo "<script>windows:location = 'index.php'</script>";
              }
           ?>
        </div>
    </div>
</div>
<?php include"inc/footer.php" ?>
