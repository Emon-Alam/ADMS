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

<div class>
  <h4 style="text-align: center">Registration</h1>
  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				<table align="center">
					<tr>
						<td>Name</td>
						<td><input type="text" name="name" placeholder="Give your name" required/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="text" name="email" placeholder="Give your email" required/></td>
					</tr>
					<tr>
						<td>User Name</td>
						<td><input type="text" name="userName"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password" placeholder="Give your password" required/></td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td><input type="password" name="cpassword" placeholder="Retype your password" required></td>
					</tr>
						<tr>
							<td>Gender</td>
							<td>
								<input type="radio" name="gender" value="male" required>Male

								<input type="radio" name="gender" value="female">Female

								<input type="radio" name="gender" value="other">Other
							</td>
						</tr>
						<tr>
							<td>Date of Birth</td>
							<td><input type="text" name="dob" required></td>
							<td>(dd/mm/yyy)</td>
						</tr>

<tr>					<td>User Type</td>
						<td>
  <input type="radio" name="type" value="Admin" required>Admin
  <input type="radio" name="type" value="User">User
  <input type="radio" name="type" value="Tailor">Tailor

<br>
		</td>

						</tr>

					<tr>
						<td></td>
						<td><input type="submit" name="register" value="Register"/>

						<input type="reset" value="Reset"></td>
					</tr>
				</table>
			</form>
</div>

<div class="footer">
  <p>Copyright © 2020</p>
</div>

</body>
</html>


<?php
if(isset($_POST['register']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$userName=$_POST['userName'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$gender=$_POST['gender'];
	$dob=$_POST['dob'];
	$usertype=$_POST['type'];

	if($password==$cpassword)
	{
    $con = oci_connect("system", "system", "localhost/orcl");
    if (!$con) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
	//Row Insert
/**create or replace trigger check_email_admin
before insert on admin

for each row
declare
count_email int;

begin
select count(*) into count_email from admin
where email = :new.email;
if(count_email > 0) then
   Raise_application_error(-20116,'Admin Email already Exists');
end if;
end;

***create or replace procedure insert_admin (name in admin.name%type, email in admin.email%type,username in admin.username%type,
password in admin.password%type, gender in admin.gender%type,dob in admin.dob%type, picture in admin.picture%type, type in admin.type%type)
        is

        begin
        insert into admin ( name,email,username, password,gender,dob,picture,type)
        values (name,email,username, password,gender,dob,picture,type);
        end;
  */
	if($usertype=="Admin"){

  //  echo "string";

/*	$sql="INSERT INTO admin (name, email, userName, password, gender, dob, picture, type) VALUES ('$name','$email','$userName','$password','$gender','$dob','','$usertype')";
  $stid=oci_parse($con,$sql);
oci_execute($stid);*/
$sql = "begin insert_admin (:name, :email, :userName, :password, :gender, :dob, :picture, :type); end;";

       $result = oci_parse($con, $sql);


       oci_bind_by_name($result, ':name', $name1, 100);
       $name1 = $name;
       oci_bind_by_name($result, ':email', $email1, 100);
       $email1 = $email;
       oci_bind_by_name($result, ':userName', $uname, 100);
       $uname = $userName;
       oci_bind_by_name($result, ':password', $password1, 100);
       $password1 = $password;
       oci_bind_by_name($result, ':gender', $gen, 100);
       $gen = $gender;
       oci_bind_by_name($result, ':dob', $d, 100);
       $d = $dob;
       oci_bind_by_name($result, ':picture', $pic, 100);
       $pic = "";
       oci_bind_by_name($result, ':type', $t, 100);
       $t = $usertype;
       oci_execute($result);

       oci_free_statement($result);
       

    echo "Register Successfully";
	//	header("Location:login.php");

	/*else
	{
		echo "Error in inserting: ".oci_error($con);
	}*/

}
//*create sequence C_ID start with 7 increment by 1;

	else if($usertype=="User"){
	$sql="INSERT INTO user2 ( C_ID,C_name, C_email, C_userName, C_password, C_gender, C_dob, C_picture, C_type) VALUES ( C_ID.nextval,'$name','$email','$userName','$password','$gender','$dob','','$usertype')";
  $stid=oci_parse($con,$sql);
  oci_execute($stid);
    echo "Register Successfully";



}
else
{

//**create sequence T_ID start with 6 increment by 1;
	$sql="INSERT INTO tailor (T_id , T_name, T_email, T_userName, T_password, T_gender, T_dob, T_picture, T_type) VALUES (T_ID.nextval,'$name','$email','$userName','$password','$gender','$dob',' ','$usertype')";
  $stid=oci_parse($con,$sql);
  oci_execute($stid);
echo "Register Successfully";



}




    oci_close($con);
    }
    else
    {
    	echo "Password Mismatch";
    }
}





//Row Update
	// $sql="UPDATE customers SET name='Loki' WHERE id=2";
	// if(oci_parse($con,$sql))
	// {
	// 	echo "Successfully row updated..<br/>";
	// }
	// else
	// {
	// 	echo "Error in updating: ".oci_error($con);
	// }

//Row Delete
	// $sql="DELETE FROM customers WHERE id=2";
	// if(oci_parse($con,$sql))
	// {
	// 	echo "Successfully row deleted..<br/>";
	// }
	// else
	// {
	// 	echo "Error in deleting: ".oci_error($con);
	// }

//Retrieve Data
	// $sql="SELECT * FROM customers WHERE id=1";
	// $result=oci_parse($con,$sql);
	// if(mysqli_num_rows($result)>0)
	// {
	// 	while($row=mysqli_fetch_array($result))
	// 	{
	// 		//echo "Id: ".$row[0]." Name: ".$row[1]."<br/>";
	// 		echo "Id: ".$row['id']." Name: ".$row['name']."<br/>";
	// 	}
	// }
	// else
	// {
	// 	echo "No data found.<br/>";
	// }


?>
