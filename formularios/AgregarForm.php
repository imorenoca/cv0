<?php
session_start();
if (empty($_SESSION['id_usuario'])) {
  header("location: login.php");
}

include_once("../config/conexiondb.php");
include_once("../config/variablesentorno.php");

// agregar empresa.-- envia a insertarOferta.
?>
<!doctype html>
<html lang="en">

<head>
  <?php require_once "../vistas/modulos/header.php"; ?>
  <script>
  function validarCampos() {
    var envio = document.querySelector('select[name="tipo"]');
    var empresa = document.querySelector('select[name="nombre_empresa"]');
    var contacto = document.querySelector('select[name="nombre_contacto"]');

    if (envio.value.trim() === 'Envio' || empresa.value.trim() === 'Empresa' || contacto.value.trim() === 'Seleccione un contacto') {
      alert('Los campos de "Envío", "Empresa" y "Contacto" son obligatorios. Por favor, complétalos.');
      return false;
    }

    return true;
  }
</script>


</head>

<body>
  <h1 class="text-center">Agregar Oferta</h1>
  <div class="container  col-auto">

    <form action="insertarOferta.php" method="POST" class="row g-3">
      <!-- <input type="hidden" name="id_usuario" value="1">-->
      <?php if (isset($_SESSION['id_usuario'])): ?>
        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
      <?php else: ?>
        <p>Error: $_SESSION['id_usuario'] no está definido.</p>
      <?php endif; ?>

      <div class="">

        <label class="form-label">Fecha Alta</label>
        <input type="date" class="form-control" name="fecha_alta" value="<?php echo date('Y-m-d'); ?>">
      </div>
      <div class="">

        <label class="form-label">Envío</label>
        <select name="tipo" class="form-control mb-3">

          <option>Envio</option>
          <?php

          $dataenvio = new ConexionDb();
          $ssql = "SELECT * FROM envio order by tipo asc";
          $result = $dataenvio->getMysqli()->query($ssql);
          while ($envio = $result->fetch_assoc()) {
            echo "<option value='" . $envio['id_envio'] . "'>" . $envio['tipo'] . "</option>";
          }
          $dataenvio->closeConnection();
          ?>
        </select>
      </div>
      <div class="">

        <label for="selectEmpresa" class="form-label">Empresa</label>
        <select name="nombre_empresa" id="selectEmpresa" class="form-select mb-3">
          <option>Empresa</option>
          <?php
          $dataempresa = new ConexionDb();
          $esql = "SELECT * FROM empresa order by nombre_empresa asc";
          $eresult = $dataempresa->getMysqli()->query($esql);
          while ($empresa = $eresult->fetch_assoc()) {
            echo "<option value='" . $empresa['id_empresa'] . "'>" . $empresa['nombre_empresa'] . "</option>";
          }
          $dataempresa->closeConnection();
          ?>

        </select>
      </div>
      <div class="">

        <label class="form-label">Puesto</label>
        <input type="text" name="nombre_puesto" class="form-control">

      </div>
      <div class="">

        <label for="selectContacto" class="form-label">Contacto</label>
        <select name="nombre_contacto" id="selectContacto" class="form-select mb-3">
          <option>Seleccione un contacto</option> <!-- Opción predeterminada vacía -->
          <?php
          $datacontacto = new ConexionDb();
          $csql = "SELECT * FROM contacto WHERE nombre_contacto IS NOT NULL AND nombre_contacto <> '' ORDER BY nombre_contacto";

          $cresult = $datacontacto->getMysqli()->query($csql);
          while ($contacto = $cresult->fetch_assoc()) {
            echo "<option value='" . $contacto['id_contacto'] . "'>" . $contacto['nombre_contacto'] . "</option>";
          }
          $datacontacto->closeConnection();
          ?>

        </select>
      </div>
      <div class="">

        <label class="form-label">Tecnología</label>
        <input name="tecnologia" type="text" class="form-control">
      </div>
      <div class="">

        <label for="selectTrabajo" class="form-label">Tipo</label>
        <select name="tipo_trabajo" id="selectTipo" class="form-select mb-3">
          <option>Seleccione el tipo</option>
          <?php
          $datattrabajo = new ConexionDb();
          $ttsql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'oferta' AND COLUMN_NAME = 'tipo_trabajo'";
          $tresult = $datattrabajo->getMysqli()->query($ttsql);

          if ($tresult) {
            $row = $tresult->fetch_assoc();
            // La información sobre las opciones ENUM se encuentra en la columna "COLUMN_TYPE"
            $enumOptions = $row['COLUMN_TYPE'];
            // Extrae las opciones del ENUM y elimina las comillas
            $enumOptions = substr($enumOptions, 6, -2); // Utiliza 6 para MariaDB
            $options = explode("','", $enumOptions);
            foreach ($options as $option) {
              echo "<option value='$option'>$option</option>";
            }
          }
          $datattrabajo->getMysqli()->close();
          ?>


        </select>
      </div>
      <div class="">

        <label for="experiencia" class="form-label">Años</label>
        <input name="experiencia" type="text" class="form-control">
      </div>
      <div class="">

        <label class="form-label">Inglés</label>
        <select name="ingles" id="selectTipo" class="form-select mb-3">
          <?php
          $datattrabajo = new ConexionDb();
          $ttsql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'oferta' AND COLUMN_NAME = 'ingles'";
          $tresult = $datattrabajo->getMysqli()->query($ttsql);

          if ($tresult) {
            $row = $tresult->fetch_assoc();
            // La información sobre las opciones ENUM se encuentra en la columna "COLUMN_TYPE"
            $enumOptions = $row['COLUMN_TYPE'];
            // Extrae las opciones del ENUM y elimina las comillas
            $enumOptions = substr($enumOptions, 6, -2); // Utiliza 6 para MariaDB
            $options = explode("','", $enumOptions);
            foreach ($options as $option) {
              if ($option === 'no') {
                echo "<option value='$option' selected>$option</option>";
              } else {
                echo "<option value='$option'>$option</option>";
              }
            }
          }
          $datattrabajo->getMysqli()->close();
          ?>
        </select>
      </div>
      <div class="">

        <label class="col-form-label">Fecha Fin</label>
        <input type="date" name="fecha_fin" class="form-control">
      </div>
      <div class="">

        <label class="col-form-label">Estado</label>
        <select name="estado" id="selectEstado" class="form-select mb-3">
          <?php
          $datattrabajo = new ConexionDb();
          $ttsql = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'oferta' AND COLUMN_NAME = 'estado'";
          $tresult = $datattrabajo->getMysqli()->query($ttsql);

          if ($tresult) {
            $row = $tresult->fetch_assoc();
            // La información sobre las opciones ENUM se encuentra en la columna "COLUMN_TYPE"
            $enumOptions = $row['COLUMN_TYPE'];
            // Extrae las opciones del ENUM y elimina las comillas
            $enumOptions = substr($enumOptions, 6, -2); // Utiliza 6 para MariaDB
            $options = explode("','", $enumOptions);
            foreach ($options as $option) {
              if ($option === 'abierta') {
                echo "<option value='$option' selected>$option</option>";
              } else {
                echo "<option value='$option'>$option</option>";
              }
            }
          }
          $datattrabajo->getMysqli()->close();
          ?>
        </select>
      </div>

      <br>
      <div>
      <button type="submit" class="btn btn-danger" onclick="return validarCampos()">Enviar</button>

        <button type="button" class="btn btn-warning"
          onclick="window.location.href='../vistas/ofertas.php'">Volver</button>

      </div>

    </form>
  </div>


</body>

</html>