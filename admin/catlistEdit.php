<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit The Category</h2>
       <div class="block copyblock">

 <?php
    if(!isset($_GET['id']) || $_GET['id'] == 'NULL')
    {
        header("Location:catlist.php");
    }else{
       $id = $_GET['id'];
    }
  ?>

 <?php
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $catname = $_POST['catname'];
        $catname = mysqli_real_escape_string($db->link,$catname);

        if (empty($catname)) {
            echo "<span style ='color:red; font-size:18px;'>Field must not be empty!!</span>";
        }else{
            $query = "UPDATE tbl_category SET name ='$catname' WHERE id = '$id' ";
            $catupdate = $db->update($query);
            if ($catupdate) {
                echo "<span style ='color:green; font-size:18px;'>Category Updated Successfully!!</span>";
            }else{
               echo "<span style ='color:red; font-size:18px;'>Category Not Updated!!</span>";
            }
        }
    } 
 ?>
         
  <?php 
     $query = "select * from tbl_category where id = '$id' order by id desc";
     $editById = $db->select($query);
     while ($result = $editById->fetch_assoc()) {
   ?>
   
 <form action = "" method = "POST">
    <table class="form">					
        <tr>
            <td>
                <input type="text" name = "catname" value="<?php echo $result['name']; ?>" class="medium" />
            </td>
        </tr>
		<tr> 
            <td>
                <input type="submit" name="submit" Value="Save" />
            </td>
        </tr>
  </table>
</form>

  <?php } ?>

    </div>
   </div>
  </div>

<?php include"inc/footer.php" ?>