<?php
session_start();
if(empty($_SESSION['id_usuario'])){
    header("location: ../vistas/login.php");
}
include_once("../config/conexiondb.php");
include_once("../config/variablesentorno.php");

// viene del botón editar, pluma del índice. Va a updateOferta.php.
?>

<!doctype html>
<html lang="en">

<head>
<?php require_once "../vistas/modulos/header.php"; ?>

</head>

<body>
    <h1 class="text-center">Editar Oferta</h1>
    <br>
    <div class="container">
        <form action="updateOferta.php" method="POST">


            <!-- <input type="hidden" name="id_usuario" value="1">-->
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
            <?php else: ?>
                <p>Error: $_SESSION['id_usuario'] no está definido.</p>
            <?php endif; ?>

            <?php

            // Realiza una consulta para obtener los datos de la oferta que deseas editar
            $dataoferta = new ConexionDb();
            $id = $_GET['id_oferta'];
            $sql = "SELECT * FROM oferta WHERE id_oferta ={$id}";
            $result = $dataoferta->getMysqli()->query($sql);
            $oferta = $result->fetch_assoc();

            ?>

            <input type="hidden" name="id_oferta" value="<?php echo $id; ?>">
            <label class="form-label">Fecha Alta</label>
            <input type="date" class="form-control" name="fecha_inicio" value="<?php echo $oferta['fecha_inicio']; ?>">


            <label class="form-label">Envío</label>
            <select name="id_envio" id="selectTipo" class="form-select mb-3">
                <option>Envío</option>
                <?php
                $dataenvio = new ConexionDb();
                $esql = "SELECT * FROM envio order by tipo asc";
                $eresult = $dataenvio->getMysqli()->query($esql);
                while ($envio = $eresult->fetch_assoc()) {
                    $selected = ($envio['id_envio'] == $oferta['id_envio']) ? "selected" : "";
                    echo "<option value='" . $envio['id_envio'] . "' $selected>" . $envio['tipo'] . "</option>";
                }
                $dataenvio->closeConnection();
                ?>

            </select>

            <label for="selectEmpresa" class="form-label">Empresa</label>
            <select name="id_empresa" id="selectEmpresa" class="form-select mb-3">
                <option>Empresa</option>
                <?php
                $dataempresa = new ConexionDb();
                $esql = "SELECT * FROM empresa order by nombre_empresa asc";
                $eresult = $dataempresa->getMysqli()->query($esql);
                while ($empresa = $eresult->fetch_assoc()) {
                    $selected = ($empresa['id_empresa'] == $oferta['id_empresa']) ? "selected" : "";
                    echo "<option value='" . $empresa['id_empresa'] . "' $selected>" . $empresa['nombre_empresa'] . "</option>";
                }
                $dataempresa->closeConnection();
                ?>
            </select>

            <label class="form-label">Puesto</label>
            <input type="text" name="nombre_puesto" class="form-control"
                value="<?php echo $oferta['nombre_puesto']; ?>">

            <label for="selectContacto" class="form-label">Contacto</label>
            <select name="id_contacto" id="selectContacto" class="form-select mb-3">
                <option value="">Seleccione un contacto</option>
                <?php
                $datacontacto = new ConexionDb();
                $csql = "SELECT * FROM contacto WHERE nombre_contacto IS NOT NULL AND nombre_contacto <> '' ORDER BY nombre_contacto";
                $cresult = $datacontacto->getMysqli()->query($csql);
                while ($contacto = $cresult->fetch_assoc()) {
                    $selected = ($contacto['id_contacto'] == $oferta['id_contacto']) ? "selected" : "";
                    echo "<option value='" . $contacto['id_contacto'] . "' $selected>" . $contacto['nombre_contacto'] . "</option>";
                }
                $datacontacto->closeConnection();
                ?>
            </select>

            <label class="form-label">Tecnología</label>
            <input name="tecnologia" type="text" class="form-control" value="<?php echo $oferta['tecnologia']; ?>">

            <label for="selectTipo" class="form-label">Tipo</label>
            <select name="tipo_trabajo" id="selectTipo" class="form-select mb-3">
                <option value="">Seleccione el tipo</option>
                <?php
                $datattrabajo = new ConexionDb();
                $ttsql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'oferta' AND COLUMN_NAME = 'tipo_trabajo'";
                $tresult = $datattrabajo->getMysqli()->query($ttsql);

                if ($tresult) {
                    $row = $tresult->fetch_assoc();
                    $enumOptions = $row['COLUMN_TYPE'];
                    $enumOptions = substr($enumOptions, 6, -2);
                    $options = explode("','", $enumOptions);
                    foreach ($options as $option) {
                        $selected = ($option == $oferta['tipo_trabajo']) ? "selected" : "";
                        echo "<option value='$option' $selected>$option</option>";
                    }
                }
                $datattrabajo->getMysqli()->close();
                ?>
            </select>

            <label class="form-label">Años de experiencia</label>
            <input name="experiencia_anios" type="text" class="form-control"
                value="<?php echo $oferta['experiencia_anios']; ?>">

            <label for="selectIngles" class="form-label">Nivel de Inglés</label>
            <select name="ingles" id="selectIngles" class="form-select mb-3">
                <?php
                $datattrabajo = new ConexionDb();
                $ttsql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'oferta' AND COLUMN_NAME = 'ingles'";
                $tresult = $datattrabajo->getMysqli()->query($ttsql);

                if ($tresult) {
                    $row = $tresult->fetch_assoc();
                    $enumOptions = $row['COLUMN_TYPE'];
                    $enumOptions = substr($enumOptions, 6, -2);
                    $options = explode("','", $enumOptions);
                    foreach ($options as $option) {
                        $selected = ($option == $oferta['ingles']) ? "selected" : "";
                        echo "<option value='$option' $selected>$option</option>";
                    }
                }
                $datattrabajo->getMysqli()->close();
                ?>
            </select>

            <label class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="<?php echo $oferta['fecha_fin']; ?>">

            <label for="selectEstado" class="form-label">Estado</label>
            <select name="estado" id="selectEstado" class="form-select mb-3">
                <?php
                $datattrabajo = new ConexionDb();
                $ttsql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'oferta' AND COLUMN_NAME = 'estado'";
                $tresult = $datattrabajo->getMysqli()->query($ttsql);

                if ($tresult) {
                    $row = $tresult->fetch_assoc();
                    $enumOptions = $row['COLUMN_TYPE'];
                    $enumOptions = substr($enumOptions, 6, -2);
                    $options = explode("','", $enumOptions);
                    foreach ($options as $option) {
                        $selected = ($option == $oferta['estado']) ? "selected" : "";
                        echo "<option value='$option' $selected>$option</option>";
                    }
                }
                $datattrabajo->getMysqli()->close();
                ?>
            </select>

            <button type="submit" class="btn btn-danger">Guardar Cambios</button>
            <button class="btn btn-warning"> <a href="../vistas/ofertas.php">Volver</a></button>

    </div>
</body>

</html>