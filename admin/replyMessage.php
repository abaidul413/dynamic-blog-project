<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<?php 
   if (!isset($_GET['rplyId']) || $_GET['rplyId'] == 'NULL') {
       header("Location:inbox.php");
   }else{
      $rplyId = $_GET['rplyId'];
   }
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Reply Messag</h2>
        
    <?php 

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $to      = $_POST['toEmail'];
         $from    = $_POST['fromEmail'];
         $subject = $_POST['subject'];
         $message = $_POST['message'];

         $sendMail = mail($to, $subject, $message, $from);
         if ($sendMail) {
             echo "<span style = 'color:green; font-weight:bold;'>Message sent Successfully</span>";
         }else{
            echo "<span style = 'color:red; font-weight:bold;'>Failed to Sent Message</span>";
         }
      }

    ?>

        <div class="block">
        <?php
            $query = "select * from tbl_contact where id = '$rplyId'";
            $select = $db->select($query);
            if ($select) {
              while ($result = $select->fetch_assoc()) {
                 
         ?>

         <form action="" method="post" >
            <table class="form">
                
                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" readonly name = "toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="text" name ="fromEmail" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name ="subject" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td >
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name = "message"> </textarea>
                    </td>
                </tr> 
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value ="Reply" />
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
