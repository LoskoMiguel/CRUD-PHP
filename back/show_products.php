<?php
include "conexion.php";

$sql = "SELECT * FROM productos_tbl";
$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<table style='border: 1px solid black;'>
    <thead>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
    </thead>
    <tbody>
        <td>".$fila["id"]."</td>
        <td>".$fila["nombre"]."</td>
        <td>".$fila["precio"]."</td>
    </tbody>
</table>";
}

mysqli_close($conexion);
?>