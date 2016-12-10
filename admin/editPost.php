<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php
  if (!isset($_GET['editPostId']) || $_GET['editPostId'] == 'NULL') {
  	 header("Location:postlist.php");
  }else{
  	$id = $_GET['editPostId'];
  }
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>

<?php 
   if($_SERVER['REQUEST_METHOD'] == 'POST') {

     $title  = mysqli_real_escape_string($db->link,  $_POST['title']);
     $cat_id = mysqli_real_escape_string($db->link,  $_POST['cat_id']);
     $body   = mysqli_real_escape_string($db->link,  $_POST['body']);
     $tags   = mysqli_real_escape_string($db->link,  $_POST['tags']);
     $author = mysqli_real_escape_string($db->link,  $_POST['author']);
     $userid = mysqli_real_escape_string($db->link,  $_POST['userid']);

     $permited  = array('jpg', 'jpeg', 'png', 'gif');
     $file_name = $_FILES['image']['name'];
     $file_size = $_FILES['image']['size'];
     $file_temp = $_FILES['image']['tmp_name'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;

     if($title == "" || $cat_id == "" || $body == "" || $tags == "" || $author == ""){
        echo "<span style ='color:red; font-size:18px;'>Field must not be empty</span>";
    }else{
 
 if(!empty($file_name)){
    if($file_size >1048567) {
         echo "<span class='error'>Image Size should be less then 1MB!
         </span>";

        } elseif (in_array($file_ext, $permited) === false) {
         echo "<span class='error'>You can upload only:-"
         .implode(', ', $permited)."</span>";

        } else{
	        move_uploaded_file($file_temp, $uploaded_image);
	        $query = "UPDATE tbl_post
	                      SET 
	                  cat_id = '$cat_id',
	                  title  = '$title',
	                  body   = '$body',
	                  image  = '$uploaded_image',
	                  author = '$author',                  
	                  tags   = '$tags',
                      userid = '$userid'
	                  WHERE id = '$id'";
         $updated_rows = $db->update($query);
        if ($updated_rows) {
         echo "<span class='success'>Data Updated Successfully.
         </span>";
        }else {
         echo "<span class='error'>Data Not Updated !</span>";
        }
      }

   }else{
        $query = "UPDATE tbl_post
                      SET 
                  cat_id   = '$cat_id',
                  title    = '$title',
                  body     = '$body',
                  author   = '$author',                  
                  tags     = '$tags',
                  userid   = '$userid'
                  WHERE id = '$id'";
     $updated_rows = $db->update($query);
    if ($updated_rows) {
     echo "<span class='success'>Data Updated Successfully.
     </span>";
    }else {
     echo "<span class='error'>Data Not Updated !</span>";
    }
   }
  }
}
?>

        <div class="block">
     <?php
        $query = "SELECT * FROM tbl_post WHERE id = '$id' ";
        $post  =$db->select($query);
        if ($post) {
        	while ($postResult = $post->fetch_assoc()) {
        		
     ?>

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name = "title" value="<?php echo $postResult['title']; ?>" class="medium" />
                    </td>
                </tr>
             
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                    <select id="select" name="cat_id">
                    <option>Select Category</option>
                    <?php
                       $query = "Select * from tbl_category";
                       $catlist = $db->select($query);
                       if($catlist){
                        while ($result = $catlist->fetch_assoc()) {  
                    ?> 
              <option
                <?php
                  if ($postResult['cat_id'] == $result['id']) {
                  	echo "selected = 'selected'";
                  }
                ?>
                value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?>	
             </option> 

                        <?php } } ?>
                    </select>
                    </td>
                </tr>
        
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src = "<?php echo $postResult['image']; ?>" width = 100px height = 70px;/><br>
                        <input type="file" name = "image"  />
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name ="body"> <?php echo $postResult['body']; ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" name ="tags" value="<?php echo $postResult['tags']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" name ="author" value="<?php echo $postResult['author']; ?>" class="medium" />
                    </td>
                    <td>
                        <input type="hidden" name ="userid" value="<?php echo Session::get('userId') ?>" class="medium" />
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
      <?php } } ?>

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
