<?php
include "conexion.php";

function limpiarDatos($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato,ENT_QUOTES,'UTF-8');
    return $dato;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = limpiarDatos($_POST["nombre"]);
    $precio = limpiarDatos($_POST["precio"]);

    $sql = "INSERT INTO productos_tbl (nombre, precio) VALUES (?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param($stmt, "si", $nombre, $precio);

    if (mysqli_stmt_execute($stmt)) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>