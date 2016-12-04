<?php include"inc/header.php" ?>
<?php include"inc/sidebar.php" ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
       <div class="block copyblock">

         <?php
            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $catname = $_POST['catname'];
                $catname = mysqli_real_escape_string($db->link,$catname);
                if (empty($catname)) {
                    echo "<span style ='color:red; font-size:18px;'>Field must not be empty!!</span>";
                }else{
                    $query = "INSERT INTO tbl_category(name) VALUES('$catname')";
                    $catinsert = $db->insert($query);
                    if ($catinsert) {
                        echo "<span style ='color:green; font-size:18px;'>Category Inserted Successfully!!</span>";
                    }else{
                       echo "<span style ='color:red; font-size:18px;'>Category Not Inserted!!</span>";
                    }
                }
            } 
         ?>

         <form action = "" method = "POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name = "catname" placeholder="Enter Category Name..." class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
        
<?php include"inc/footer.php" ?>