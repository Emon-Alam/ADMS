<?php

$userName = "system";
$password = "system";
$dbName = "localhost/orcl";

$conn = oci_connect("system", "system", "localhost/orcl");
if (!$con) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

?>
