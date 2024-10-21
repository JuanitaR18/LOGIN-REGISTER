<?php
include 'dbco.php'; 

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password']; 

$selectquery = "SELECT * FROM users WHERE email = '$email'";
$res2 = mysqli_query($con1, $selectquery);

if (mysqli_num_rows($res2) > 0) {
    echo "El usuario ya existe";
} else {
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

 
$insertsql = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";
    $res = mysqli_query($con1, $insertsql);

    if ($res) {
        $usuario_id = mysqli_insert_id($con1); 
        echo "Bienvendio. Identificador: $usuario_id";
    } else {
        echo "Error al insertar los datos: " . mysqli_error($con1);
    }
}

mysqli_close($con1);
?>
