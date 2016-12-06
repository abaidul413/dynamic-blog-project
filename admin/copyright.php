<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>iv>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
         <?php 
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
             $copyright  = $fm->validation($_POST['copyright']);
             $copyright  = mysqli_real_escape_string($db->link, $copyright);
             $query  = "UPDATE tbl_copyright SET copyright = '$copyright' WHERE id = '1' ";
             $update = $db->update($query);
             if ($update) {
                 echo "<span class = 'success'>Data Updated Successfully!!</span>";
             }else{
                echo "<span class = 'error'>Failed to update Data</span>";
            }
          }
         ?>

        <div class="block copyblock">
         <?php
            $query = "SELECT * FROM tbl_copyright WHERE id = '1'";
            $get_copyright = $db->select($query);
            if ($get_copyright) {
                 while ($result = $get_copyright->fetch_assoc()) {
     
          ?> 
         <form action = "" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['copyright']; ?>" name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php } } ?>
        </div>
    </div>
</div>

<?php include"inc/footer.php" ?>