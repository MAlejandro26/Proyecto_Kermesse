<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nueva Region</title>
</head>
<body>
    <form role="form" name="newEmpleado" method="POST" action="src/negocio/NGRegion.php">
        <fieldset>
            <legend>Registro de nueva Region</legend>
            <input name="txtaccion" type="hidden" value="1" />

            <div>
                <label>Id: </label>
                <input type="number" name="txtregionid" id="txtregion" required/>
            </div>
            <div>
                <label>Nombre: </label>
                <input type="text" name="txtregion" id="txtregion" placeholder="Nombre de region" required/>
            </div>

            <button type="submit">Guardar</button>
            <button type="reset">Cancelar</button>
        </fieldset>
    </form>
</body>
</html>