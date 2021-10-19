<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Tailors</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="CSS/style.css">
</head>
<body>

<div class="topnav">
  <a href="index.php">Home</a>
  <a href="login.php">Login</a>
  <a href="registration.php">Registration</a>
</div>

<div>
  <h1 style="text-align: center">Tailor Management System</h1>

			<h4 style="text-align: center">Login Form</h4>

			<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<table align="center">
					<tr>
						<td>User Name</td>
						<td><input type="text" name="userName" placeholder="Give your Username" value="" required/>
							<br><span id="uErr" style="display: none;color: red">Username can't be empty!</span>

            </td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" required/>
							<br><span id="pErr" style="display: none;color: red">Password can't be empty!</span>

            </td>
					</tr>



<tr>
  <td>User Type</td>
		<td>
  <input type="radio" name="type" value="Admin" required> Admin</input>
  <input type="radio" name="type" value="User" required> User</input>
  <input type="radio" name="type" value="Tailor" required> Tailor</input>
<br><span id="tErr" style="display: none;color: red">Please select a type!</span>
<br>
		</td>

					</tr>

					<tr>
						<td></td>
						<td><input type="submit" name="login" value="Login"/></td>
					</tr>
				</table>
			</form>
			<script src="./js/script.js"></script>

</div>

<div class="footer">
  <p>Copyright © 2020</p>
</div>

</body>
</html>




<?php
if(isset($_POST['login']))
{
  $con = oci_connect("system", "system", "localhost/orcl");
  if (!$con) {
      $e = oci_error();
      trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
  }


  //Retrieve Data

	$password=$_POST['password'];
	$userName=$_POST['userName'];
	$usertype=$_POST['type'];


	if($usertype== "Admin"){


	$sql="SELECT * FROM ADMIN WHERE USERNAME='$userName' AND PASSWORD='$password'";
	$stid=oci_parse($con,$sql);
  oci_execute($stid);
  while($row=oci_fetch_array($stid))
  {
      if(empty($row)){
        echo "no data found";
        break;
      }
      else {
      $_SESSION['userName']=$row['userName'];
      $_SESSION['name']=$row['name'];
      header("Location:nhome.php");
      }
}

}


   else if($usertype== "Tailor"){
	$sql="SELECT * FROM tailor WHERE T_userName='$userName' AND T_password='$password'";
	$stid=oci_parse($con,$sql);
  oci_execute($stid);
  while($row=oci_fetch_array($stid))
  {
      if(empty($row)){
        echo "no data found";
        break;
      }
      else {
      $_SESSION['userName']=$row['userName'];
      $_SESSION['name']=$row['name'];
      header("Location:ntailor.php");
      }
}
}
else{
$sql="SELECT * FROM user2 WHERE C_username='$userName' AND C_password='$password'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
while($row=oci_fetch_array($stid))
{
    if(empty($row)){
      echo "no data found";
      break;
    }
    else {
    $_SESSION['userName']=$row['userName'];
    $_SESSION['name']=$row['name'];
    header("Location:nuser.php");
    }
}
}





oci_close($con);
}
?>
