<?php
include 'dbco.php'; 

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_POST['login'])) {
        $query = "SELECT password FROM users WHERE email = '$email'";
        $res = mysqli_query($con1, $query);

        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (password_verify($password, $row['password'])) {
                $resultado = "Bienvenido";
            } else {
                $resultado = "Credenciales incorrectas";
            }
        } else {
            $resultado = "Credenciales incorrectas";
        }
    }

    if (isset($_POST['bsubmit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];

        $query = "SELECT * FROM users WHERE email = '$email'";
        $res2 = mysqli_query($con1, $query);

        if ($res2 && mysqli_num_rows($res2) > 0) {
            $resultado = "El usuario ya existe";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$hashed_password')";
            $insert_res = mysqli_query($con1, $insert_query);

            if ($insert_res) {
                $resultado = "Bienvenido. Usuario registrado.";
            } else {
                $resultado = "Error al insertar los datos: " . mysqli_error($con1);
            }
        }
    }
}

mysqli_close($con1);
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN/REGISTER</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>

    <h1>LOGIN/REGISTER</h1>
    <div class="login-register">
        <form method="POST" class="formulario__login">
            <h2>Iniciar Sesión</h2>
            <input type="text" name="email" placeholder="Correo Electronico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login">Entrar</button>
        </form>
        <p><?php echo $resultado; ?></p>
    </div>

    <div>
        <h2>Registro</h2>
        <form method="post">
            <table>
                <tr>
                    <th>Nombre:</th>
                    <td><input type="text" name="fname" placeholder="Nombre" required></td>
                </tr>
                <tr>
                    <th>Apellido:</th>
                    <td><input type="text" name="lname" placeholder="Apellido" required></td>
                </tr>
                <tr>
                    <th>Correo:</th>
                    <td><input type="text" name="email" placeholder="Email" required></td>
                </tr>
                <tr>
                    <th>Contraseña:</th>
                    <td><input type="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td><input type="submit" name="bsubmit" value="Registrarse" style="width: 100%; padding: 10px; background-color: #a76bcf; color: white; border: none; border-radius: 5px; cursor: pointer;"></td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>


