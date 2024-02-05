<?php
session_start();
if (empty($_SESSION['id_usuario'])) {
    header("location: ../vistas/login.php");
}
include_once("../config/conexiondb.php");
include_once("../config/variablesentorno.php");
?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once "../vistas/modulos/header.php"; ?>
    <br>
</head>

<body>
    <div class="container text-center">
        <div class="row justify-content-md-center">
            <div class='col-md-auto'>
                <h1>Eliminar</h1>
                <?php
                if ($_GET && isset($_GET['id_oferta'])) {
                    $id_oferta = $_GET['id_oferta'];

                    // Realiza una consulta para obtener los detalles de la oferta
                    $dataoferta = new ConexionDb();
                    $sql = "SELECT * FROM oferta WHERE id_oferta = $id_oferta";
                    $result = $dataoferta->getMysqli()->query($sql);
                    $oferta = $result->fetch_assoc();

                    if ($oferta) {
                        echo '<div class="container card">';
                        echo '<h2>Oferta a eliminar</h2>';
                        echo '<div class="table-responsive">';
                        echo '<table class="table table-bordered">';
                          
                        // Modifica las líneas de las fechas para mostrarlas en el formato d/m/Y
                        echo "<tr><td>Fecha de Inicio</td><td>" . date("d/m/Y", strtotime($oferta['fecha_inicio'])) . "</td></tr>";
                        echo "<tr><td>Nombre del Puesto</td><td>{$oferta['nombre_puesto']}</td></tr>";
                        echo "<tr><td>Estado de la Oferta</td><td>{$oferta['estado']}</td></tr>";
                       

                        $fecha_fin = $oferta['fecha_fin'];
                        if ($fecha_fin && $fecha_fin !== '0000-00-00') {
                            echo "<tr><td>Fecha de Fin</td><td>" . date("d/m/Y", strtotime($fecha_fin)) . "</td></tr>";
                        } else {
                            echo "<tr><td>Fecha de Fin</td><td></td></tr>";
                        }
                        

                        echo '</table>';
                        echo '</div>';
                        echo '</div>';
                        

                        if ($_POST && isset($_POST['eliminar'])) {
                            // Realiza la eliminación de la oferta
                            $delete = new ConexionDb();
                            $sql = "DELETE FROM oferta WHERE id_oferta = $id_oferta";

                            if ($delete->getMysqli()->query($sql)) {
                                echo '<div class="container  text-danger">';
                                echo '<br> ';
                                echo '<div class="alert alert-danger text-center" role="alert">
                                Oferta Eliminada.
                            </div>';
                                echo '</div>';
                            } else {
                                echo '<div class="container">';
                                echo '<br> ';
                                echo "Error al eliminar la oferta: " . $delete->getMysqli()->error;
                                echo '<br> ';
                                echo '</div> ';
                            }
                        } else {
                            // Mostrar el formulario de confirmación de eliminación y el botón Volver juntos
                            echo '<br>';
                            echo '<div class="container">';
                            echo '<form class="d-inline" method="post">';
                            echo '<input type="hidden" name="id_oferta" value="' . $oferta['id_oferta'] . '">';
                            echo '<input type="submit" name="eliminar" value="Eliminar Oferta" class="btn btn-danger mr-2">';
                        }
                    } else {
                        echo "No se encontró la oferta con el ID proporcionado.";
                    }
                }
                ?>
                </form>
                <a href="../vistas/ofertas.php" class="btn btn-success">Volver</a>
            </div>
        </div>
    </div>
    </div>
    <br>
    <br>
    <br>

    <footer>
        <?php require_once __DIR__ . "/../vistas/modulos/footer.php"; ?>


    </footer>
</body>

</html>