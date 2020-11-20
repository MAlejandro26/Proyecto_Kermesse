<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar nueva Localización</title>
</head>
<body>
    <form role="form" name="newLocation" method="POST" action="src/negocio/NGLocation.php">
        <fieldset>
            <legend>Registro de nueva Localizacion</legend>
            <input name="txtaccion" type="hidden" value="1" />

            <label>Street Address</label>
            <input type="text" name="txtStreet" id="txtStreet" placeholder="Nombre de la calle" required>
            <label>Postal Code</label>
            <input type="text" name="txtPostalCode" id="txtPostalCode" placeholder="Código Postal" required>
            <label>City</label>
            <input type="text" name="txtCity" id="txtCity" placeholder="Nombre de la ciudad" required>
            <label>State Province</label>
            <input type="text" name="txtState" id="txtState" placeholder="Nombre del estado" required>
            <label>Country Id</label>
            <input type="text" name="txtCountry" id="txtCountry" placeholder="Nombre del país" required>

            <button type="submit">Guardar</button>
            <button type="reset">Cancelar</button>
        </fieldset>
    </form>
</body>
</html>