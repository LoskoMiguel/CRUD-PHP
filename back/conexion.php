<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "productos";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
    die("Error: " . mysqli_connect());
} else {
    // echo "Conexion Exitosa";
}

?>