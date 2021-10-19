
<html>
<head>
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
  <li><a href="Product.php">Order Lists</a></li>
  <li><a href="employee_list.php">Employees</a></li>
  <li><a href="delivery.php">Delivery</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
  </div>
  <div class="middle" style="background-color:#bbb;"><?php

    ?>
<?php


$conn = oci_connect("system", "system", "localhost/orcl");

$query = 'select * from product';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);


print '<legend><b>Products List</b></legend><br>';

print '<table border="1">';
print 'All the product information: ';
print'<tr>
<td>Product ID</td>
<td>Tailor ID</td>
<td>PName</td>
<td>Description</td>
<td>PQuantity</td>
<td>Price</td>


			</tr>';


while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {


   print '<tr>';
   foreach ($row as $item) {
       print '<td>'.     ($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp')    .'</td>';
   }
   print '</tr>';

}
print '</table>';
//print'<td><a href="adminhome.php">GO BACK </a></td>';

?>
</div>

<div class="footer">
<p>Copyright © 2020</p>
</div>
</div>
</body>
</html>
