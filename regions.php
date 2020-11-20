<?php

include 'src/entidades/region.php';
include 'src/datos/DTRegion.php';

$datosReg = new DTRegion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Regiones</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Region</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($datosReg->listarRegiones() as $r): ?>
            <tr>
                <td><?php echo $r->__GET('region_id'); ?></td>
                <td><?php echo $r->__GET('region_name'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>