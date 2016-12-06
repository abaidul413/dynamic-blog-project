<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

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
        $query = "INSERT INTO tbl_page(page_name, page_body) VALUES('$page_name','$page_body')";
         $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Data Inserted Successfully.
         </span>";
        }else {
         echo "<span class='error'>Data Not Inserted !</span>";
        }
      }

   }

?>

      <div class="block">
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name = "page_name" placeholder="Enter Page Title..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name ="page_body"></textarea>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
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
