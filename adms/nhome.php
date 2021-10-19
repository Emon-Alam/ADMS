
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="CSS/table.css">

</head>
<body>


<div class="grid-container">
  <div class="header">
    <h2 style="color: #2E4053"; align="left">Tailor Management System </h2>

  </div>

  <div class="left" style="background-color:#aaa;">
  <ul>

  <li><a href="nhome.php">Dashboard</a></li>
  <li><a href="view.php?userName=<?php echo $userName; ?>">View Profile</a></li>
  <li><a href="edit.php">Edit Profile</a></li>
  <li><a href="changepic.php">Change Profile Picture</a></li>
  <li><a href="changepass.php">Change Password</a></li>
    <li><a href="all_taken_products.php">Taken Products</a></li>
  <li><a href="product.php">Order Lists</a></li>

  <li><a href="employee_list.php">Employees</a></li>
  <li><a href="delivery.php">Delivery</a></li>

 <li><a href="json.php">Json user </a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

  </div>
  <div class="middle" style="background-color:#bbb;"><?php



    ?>

      <?php

      //if(isset($_POST['login']))
      //{
        $con = oci_connect("system", "system", "localhost/orcl");
        if (!$con) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        /*create or replace procedure tailor_list(data out sys_refcursor)
                    as
                    begin
                    open data for
                                select T_id , T_name, T_email, T_userName, T_password, T_gender, T_dob, T_picture, T_type
                                from tailor;

                    end;*/

                    $query = "begin tailor_list(:data); end;";

                    $curs = oci_new_cursor($con);
                    $stid = oci_parse($con, $query);

                    oci_bind_by_name($stid, ":data", $curs, -1, OCI_B_CURSOR);

                    //oci_bind_by_name($stid, ":s_id", $s_id, 1000);

                    oci_execute($stid);
                    $data = [];
                    oci_execute($curs);  // Execute the REF CURSOR like a normal statement id
                    ?>

                    <div >
                        <table  border='1' cellpadding='8' >
                          <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>DOB</th>
                            <th>Usertype</th>

                          </tr>

                          <?php
                    while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
                        $data[] = $row;

                        //echo $row['C_ID'] . "\n";
                       // echo $row['C_NAME'] . "<br />\n";


                         echo "<tr>";
                         echo "<td>".$row['T_ID']."</td>";
                         echo "<td>".$row['T_NAME']."</td>";
                         echo "<td>".$row['T_EMAIL']."</td>";
                         echo "<td>".$row['T_USERNAME']."</td>";
                         echo "<td>".$row['T_DOB']."</td>";
                         echo "<td>".$row['T_TYPE']."</td>";
                         //echo '<td><a href="useredit.php? id='.$row['id'].'&Name=' .$row['name'].'&Email='.$row['email'].'&Username='.$row['userName'].'&Usertype='.$row['type'].'">Edit</a> || <a href="userdelete.php?id=' .$row['id'].'">Delete</a></td>';
                         echo "</tr>";




                      }
                  echo "</table>";
                    //return $data;

                    //oci_free_statement($stid);
                  //  oci_free_statement($curs);
                    //oci_close($con);




   /*create or replace procedure user_list(data out sys_refcursor)
            as
            begin
            open data for
                        select C_ID,C_name, C_email, C_userName, C_password, C_gender, C_dob, C_picture, C_type
                        from user2;

            end;*/

   $query = "begin user_list(:data); end;";

   $curs = oci_new_cursor($con);
   $stid = oci_parse($con, $query);

   oci_bind_by_name($stid, ":data", $curs, -1, OCI_B_CURSOR);

   //oci_bind_by_name($stid, ":s_id", $s_id, 1000);

   oci_execute($stid);
   $data = [];
   oci_execute($curs);  // Execute the REF CURSOR like a normal statement id

  ?>

   <div >
       <table  border='1' cellpadding='8' >
         <tr>
         <th>Id</th>
         <th>Name</th>
         <th>Email</th>
         <th>Username</th>
         <th>DOB</th>
         <th>Usertype</th>
         </tr>
  <?php
   while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
       $data[] = $row;

       //echo $row['C_ID'] . "\n";
      // echo $row['C_NAME'] . "<br />\n";


        echo "<tr>";
        echo "<td>".$row['C_ID']."</td>";
        echo "<td>".$row['C_NAME']."</td>";
        echo "<td>".$row['C_EMAIL']."</td>";
        echo "<td>".$row['C_USERNAME']."</td>";
        echo "<td>".$row['C_DOB']."</td>";
        echo "<td>".$row['C_TYPE']."</td>";
        //echo '<td><a href="useredit.php? id='.$row['id'].'&Name=' .$row['name'].'&Email='.$row['email'].'&Username='.$row['userName'].'&Usertype='.$row['type'].'">Edit</a> || <a href="userdelete.php?id=' .$row['id'].'">Delete</a></td>';
        echo "</tr>";




     }
echo "</table>";
   return $data;

   oci_free_statement($stid);
   oci_free_statement($curs);
   oci_close($con);


/*    $sql="SELECT t_id,t_name, t_email, t_userName,t_type FROM tailor";
  $result=oci_parse($con,$sql);
  oci_execute($result);
  //if(oci_num_rows($result)>0)
{
    ?>
    <table border='1' cellpadding='8' >
      <tr>
        <th>id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Usertype</th>
        <th>Actions</th>
      </tr>

    <?php
  //  while(($row = oci_fetch_array($result, OCI_ASSOC)) != false)
    while($row=oci_fetch_array($result))
    {
      echo "<tr>";
      echo "<td>".$row['t_id']."</td>";
      echo "<td>".$row['t_name']."</td>";
      echo "<td>".$row['t_email']."</td>";
      echo "<td>".$row['t_userName']."</td>";
      echo "<td>".$row['t_type']."</td>";
      //echo '<td><a href="tailoredit.php? id='.$row['id'].'&Name=' .$row['name'].'&Email='.$row['email'].'&Username='.$row['userName'].'&Usertype='.$row['type'].'">Edit</a> || <a href="tailordelete.php?id=' .$row['id'].'">Delete</a></td>';
      echo "</tr>";


    }
    echo "</table>";
   }



oci_close($con);*/

?>

    </div>

</div>
</body>
</html>

<?php
/*if(isset($_POST['register']))
{
  require "includes/db_connect.inc.php";
  //Row Insert
 $name=$_POST['Name'];
  $email=$_POST['email'];
  $userName=$_POST['userName'];
  $password=$_POST['password'];
  $cpassword=$_POST['cpassword'];
  $gender=$_POST['gender'];
  $dob=$_POST['dob'];
  $usertype=$_POST['type'];
 $sql="INSERT INTO `user`(`name`, `email`, `userName`, `password`, `gender`, `dob`, `picture`, `type`)VALUES('$name','$email','$userName','$password','$gender','$dob','','$usertype')";
  if(oci_parse($con,$sql))
  {
    header("Location:nhome.php");
  }
  else
  {
    //echo "Error in inserting: ".mysql_error($con);
  }
oci_close($con);
}*/
?>
