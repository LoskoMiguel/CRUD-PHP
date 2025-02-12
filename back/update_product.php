<?php
include "conexion.php";

function limpiarDatos($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato,ENT_QUOTES,'UTF-8');
    return $dato;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_buscar = limpiarDatos($_POST["nombre_buscar"]);
    $nombre_cambiar = limpiarDatos($_POST["nombre_cambiar"]);
    $precio_cambiar = limpiarDatos($_POST["precio_cambiar"]);

    if (empty($nombre_cambiar) && empty($precio_cambiar)) {
        echo "Los Datos No Pueden Estar Vacíos";
        exit;
    }
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    if (empty($nombre_cambiar)) {
        $sql = "UPDATE productos_tbl SET precio=? WHERE nombre=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "is", $precio_cambiar, $nombre_buscar);
    }

    else if (empty($precio_cambiar)) {
        $sql = "UPDATE productos_tbl SET nombre=? WHERE nombre=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $nombre_cambiar, $nombre_buscar);
    }

    else {
        $sql = "UPDATE productos_tbl SET nombre=?, precio=? WHERE nombre=?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sis", $nombre_cambiar, $precio_cambiar, $nombre_buscar);
    }
    
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Producto Actualizado Correctamente.";
        } else {
            echo "No se encontró un producto con ese nombre.";
        }
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
