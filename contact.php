<?php include'inc/header.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
               
  <?php 

     if ($_SERVER['REQUEST_METHOD'] == "POST") {
     	$fname = $fm->validation($_POST['firstname']);
     	$lname = $fm->validation($_POST['lastname']);
     	$email = $fm->validation($_POST['email']);
     	$msg   = $fm->validation($_POST['msg']);

     	$fname  = mysqli_real_escape_string($db->link,$fname);
     	$lname  = mysqli_real_escape_string($db->link,$lname);
     	$email  = mysqli_real_escape_string($db->link,$email);
     	$msg    = mysqli_real_escape_string($db->link,$msg);
        if ($fname == '' || $lname == '' || $email == '' || $msg == '') {
        	echo "<span style = 'color:red'>Field must not be Empty!!</span>";
        }else{
        	$query = "insert into tbl_contact(firstname, lastname, email, msg) values('$fname', '$lname', '$email', '$msg')";
        	$insert = $db->insert($query);
        	if ($insert) {
        		echo "<span style = 'color:green; font-weight:bold'>Messege Sent Successfully</span>";
        	}else{
        		echo "<span style = 'color:red; font-weight:bold'>Failed to Messege Sent</span>";
          }
        }
     }
?>

		<form action="" method="post">
			<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name = "msg"> </textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	 </form>				
  </div>
</div>

<?php include'inc/sidebar.php'; ?>	
<?php include'inc/footer.php'; ?>