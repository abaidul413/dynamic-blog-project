<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php 
   if (!isset($_GET['msgId']) || $_GET['rplyId'] == 'NULL') {
       header("Location:inbox.php");
   }else{
      $msgId = $_GET['msgId'];
   }
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>View Messag</h2>
        
    <?php 

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         echo "<script>window.location = 'inbox.php';</script>";
      }

    ?>

        <div class="block">
        <?php
            $query = "select * from tbl_contact where id = '$msgId'";
            $select = $db->select($query);
            if ($select) {
              while ($result = $select->fetch_assoc()) {
                 
         ?>

         <form action="" method="post" >
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['firstname'].' '.$result['lastname'];?>" class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Date</label>
                    </td>
                    <td>
                        <input type="text" readonly value="<?php echo $fm->formatDate($result['date']); ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td >
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="tinymce" readonly><?php echo $result['msg']; ?></textarea>
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value ="Ok" />
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
