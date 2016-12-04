<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<div class="grid_10">
  <div class="box round first grid">
      <h2>Delete The Category</h2>
       <div class="block copyblock">

           <?php
              if (isset($_GET['id'])){
               $id = $_GET['id'];
               $query = "DELETE FROM tbl_category WHERE id ='$id' ";
               $delete = $db->delete($query);
               if ( $delete) {
                 echo "<span style ='color:green; font-size:18px;'>Category Deleted Successfully!!</span>";
               }else{
                echo "<span style ='color:green; font-size:18px;'>Failed To Delete Category!!</span>";
               }
              }
            ?>

      </div>
  </div>
</div>

<?php include"inc/footer.php" ?>