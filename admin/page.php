<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php 
   if (!isset($_GET['pageId']) || $_GET['pageId'] == 'NULL') {
       header("Location:index.php");
   }else{
     echo $pageId = $_GET['pageId'];
   }

?>

<style>
    .delbutton{margin-left: 10px; }
    .delbutton a{border: 1px solid #ddd;color: #444;cursor: pointer;font-size: 20px;padding: 2px 10px; font-weight: normal; background: #F0F0F0;}
</style>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>

<?php 
   if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $page_name  = mysqli_real_escape_string($db->link,  $_POST['page_name']);
     $page_body = mysqli_real_escape_string($db->link,  $_POST['page_body']);

     if($page_name == "" || $page_body == "" ){
        echo "<span style ='color:red; font-size:18px;'>Field must not be empty</span>";

     }else{
        $query = "UPDATE tbl_page SET page_name = '$page_name', page_body = '$page_body' WHERE id = '$pageId'";
         $update_rows = $db->update($query);
        if ($update_rows) {
         echo "<span class='success'>Data Updated Successfully.
         </span>";
        }else {
         echo "<span class='error'>Failed to Update Data !</span>";
        }
      }

   }

?>

      <div class="block">

      <?php 
         $query = "select * from tbl_page where id = '$pageId'";
         $page  = $db->select($query);
         if ($page) {
            while ($result = $page->fetch_assoc()) {

      ?>
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name = "page_name" value="<?php echo $result['page_name']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name ="page_body">
                         <?php echo $result['page_body']; ?>  
                        </textarea>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                        <span class = "delbutton"><a onclick="return confirm('Are You Sure to Delete!!!!');" href = "delPage.php? pageId=<?php echo $result['id'] ?>">Delete</a></span>
                    </td>
                </tr>
            </table>
            </form>
      <?php  } } ?>

        </div>
    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>

<?php include"inc/footer.php" ?>
