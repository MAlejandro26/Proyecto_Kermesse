<?php

include 'src/entidades/location.php';
include 'src/datos/DTLocation.php';

$datosLocation = new DTLocation();
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
                <th>Street Address</th>
                <th>Postal Code</th>
                <th>City</th>
                <th>State Province</th>
                <th>Country Id</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($datosLocation->listarLocations() as $r): ?>
            <tr>
                <td><?php echo $r->__GET('location_id'); ?></td>
                <td><?php echo $r->__GET('street_address'); ?></td>
                <td><?php echo $r->__GET('postal_code'); ?></td>
                <td><?php echo $r->__GET('city'); ?></td>
                <td><?php echo $r->__GET('state_province'); ?></td>
                <td><?php echo $r->__GET('country_id'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>