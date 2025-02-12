<?php
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_eliminar = trim($_POST['nombre_eliminar']);

    if (empty($nombre_eliminar)) {
        echo "El Nombre No Puede Estar Vacio";
        exit;
    }

    $sql = "DELETE FROM productos_tbl WHERE nombre=?";
    $stmt = mysqli_prepare($conexion, $sql);

    mysqli_stmt_bind_param($stmt, "s", $nombre_eliminar);

    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Producto Eliminado Correctamente.";
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