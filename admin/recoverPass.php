<?php 
  include '../lib/Session.php'; 
  Session::checkLogin();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>

   <?php
	 $db = new Database();
	 $fm = new Format();
   ?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Recover Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">

         <?php
           if ($_SERVER['REQUEST_METHOD'] == "POST") {
           	  $email = $fm->validation($_POST['email']);
              $email = mysqli_real_escape_string($db->link,$email);

              $query = "select * from tbl_user where email = '$email' limit 1";
              $checkemail = $db->select($query);
              if($checkemail != false) {
              	 while ($result = $checkemail->fetch_assoc()) {
                   $userid = $result['id'];
                   $username = $result['username'];
                 }

               $txt     = substr($email, 0,3);
               $rand    = rand(1111,99999);
               $newPass = "$txt$rand";
               $password= md5($newPass);

               $query   = "update tbl_user set password = '$password' where id = '$userid'";
               $update  = $db->update($query);
               $to      = $email;
               $subject = "Password Recover Message";
               $message = "Hi, Mr.".$username. "Your Password is".$newPass."Please login Now this password";
               $form    = "Abaidul Haque";
               $headers = "From: $form <br>";
              $sendMail = mail($to, $subject, $message, $headers);
               if ($sendMail) {
                 echo "<span style = 'color:red; font-size:18px;'>Password Sent To Your Email, Check your Email</span>";
               }else{
                  echo "<span style = 'color:red; font-size:18px;'>Failed To Sent password</span>";
               }
              
              }else{
              	echo "<span style = 'color:red; font-size:18px;'>Email Not Exist</span>";
              }
           }
         ?>

		 <form action="" method="post">
  			<h1>Recover Password</h1>
  			<div>
  				<input type="text" placeholder="Enter Email" required="" name="email"/>
  			</div>
  			<div>
  				<input type="submit" value="Send" />
  			</div>
		 </form><!-- form -->
    <div class="button">
      <a href="login.php">Login</a>
    </div>
		<div class="button">
			<a href="#">Vivacom Solutions</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>