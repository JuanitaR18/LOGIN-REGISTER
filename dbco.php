<?php

$server = "sql.freedb.tech";
$user = "freedb_Juanita";
$pass = "*W@VGAsPxg*mD63";
$dbname = "freedb_Example";
$db_port = "3306";


$con1 = mysqli_connect($server, $user, $pass, $dbname, $db_port);


if (!$con1) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
<?php