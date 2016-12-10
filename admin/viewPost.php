<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php 
   if (!isset($_GET['viewPostId']) || $_GET['viewPostId'] == NULL) {
       echo"<script>window.location='postlist.php'</script>";
   }else{
      $viewPostId = $_GET['viewPostId'];
   }
 ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>View Post</h2>

<?php 
   if($_SERVER['REQUEST_METHOD'] == 'POST') {

      echo"<script>window.location='postlist.php'</script>";
    }
    ?>

     <div class="block">
     <?php
        $query = "SELECT * FROM tbl_post WHERE id = '$viewPostId' ";
        $viewpost  =$db->select($query);
        if ($viewpost) {
        	while ($postResult = $viewpost->fetch_assoc()) {
        		
     ?>

         <form action="" method="post">
            <table class="form">
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $postResult['title']; ?>" class="medium" />
                    </td>
                </tr>
             
                <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                    <select id="select">
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
                        <label>Image</label>
                    </td>
                    <td>
                        <img src = "<?php echo $postResult['image']; ?>" width = 100px height = 70px;/><br>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce" readonly> <?php echo $postResult['body']; ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tags</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $postResult['tags']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Author</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $postResult['author']; ?>" class="medium" />
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
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
