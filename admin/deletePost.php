<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php
  if (!isset($_GET['deletetPostId']) || $_GET['deletetPostId'] == 'NULL') {
  	 header("Location:postlist.php");
  }else{
  	$id = $_GET['deletetPostId'];
  }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Delete Post</h2>
        <div class="block">
          <?php
              $img = "select * from tbl_post where id = '$id'";
              $img_delete = $db->select($img);
              if($img_delete){
                  while ($delete_result = $img_delete->fetch_assoc()) {
                      $link_img = $delete_result['image'];
                      unlink($link_img);
                  }
              } 
              $query = "DELETE FROM tbl_post WHERE id ='$id' ";
              $is_delete = $db->delete($query);
              if ($is_delete) {
                 echo "<span class='sucess'>Data Deleted Successfully!</span></span>";
              }else{
                echo "<span class='error'>Failed To Delete Post !</span>";
              }
           ?>
        </div>
    </div>
</div>
<?php include"inc/footer.php" ?>
