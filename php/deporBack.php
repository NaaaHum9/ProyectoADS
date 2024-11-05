<?php
function buscar($consulta, $enlace, $sesion)
{
    if (!empty($_POST["subBuscr"])) {

        if (isset($_POST['filtro'])) {
            // Obtener el valor del radio button seleccionado
            $filtroSeleccionado = $_POST['filtro'];

        }
        if ($filtroSeleccionado == "alcaldia") {
            $busqueda = $_POST["alcaldia"];
            $filtro = " WHERE direccion like '%" . $busqueda . "%'";
            $consulta = $consulta . $filtro;
        }
        if ($filtroSeleccionado == "deporte") {
            $busqueda = $_POST["deporte"];
            $consulta = "SELECT *, imgDepor.ruta FROM deportivo 
          INNER JOIN imgDepor ON imgDepor.idDeportivo = deportivo.idDeportivo 
          INNER JOIN cancha ON cancha.idDeportivo = deportivo.idDeportivo 
          WHERE cancha.deporteCancha = '$busqueda'";
        }
        if ($filtroSeleccionado == "gradas") {
            $busqueda = $_POST["gradas"];
            if ($busqueda == "Con gradas") {
                $consulta = "SELECT *, imgDepor.ruta FROM deportivo 
          INNER JOIN imgDepor ON imgDepor.idDeportivo = deportivo.idDeportivo 
          INNER JOIN cancha ON cancha.idDeportivo = deportivo.idDeportivo 
          WHERE cancha.gradasCanchaCantidad > 0";
            } else {
                $consulta = "SELECT *, imgDepor.ruta FROM deportivo 
          INNER JOIN imgDepor ON imgDepor.idDeportivo = deportivo.idDeportivo 
          INNER JOIN cancha ON cancha.idDeportivo = deportivo.idDeportivo 
          WHERE cancha.gradasCanchaCantidad = 0";
            }


        }
        if ($filtroSeleccionado == "costo") {
            $busqueda = $_POST["costo"];
            if ($busqueda == "Gratuito") {
                $filtro = " WHERE costo is NULL";
            } else {
                $filtro = " WHERE costo is NOT NULL";
            }
            $consulta = $consulta . $filtro;

        }
        if ($filtroSeleccionado == "mascota") {
            $busqueda = $_POST["mascota"];
            if ($busqueda == "Pet") {
                $filtro = " WHERE aceptaMascotas = 1";
            } else {
                $filtro = " WHERE aceptaMascotas = 0";
            }
            $consulta = $consulta . $filtro;

        }

        /*$busqueda = (isset($_POST["consulta"])) ? $_POST["consulta"] : "";*/



    }

    $resultado = mysqli_query($enlace, $consulta);


    while ($row = mysqli_fetch_array($resultado)) {
        $id = $row['idDeportivo']; ?>


        <td class="imagen">
            <a class="image-link" href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>>
                <img class="image img-thumbnail" src=<?php echo '"' . $row['ruta'] . '"' ?>>
            </a>
        </td>
        
        <td>
            <a href=<?php echo '"deportivo.php?id=' . $row['idDeportivo'] . '"' ?>>
            <h2><?php echo $row['nombre'] ?></h2></a>
            <table>
                <tr>
                    <td colspan="2"><b>Dirección:</b><br><?php echo '"' . $row['direccion'] . '"' ?></td>
                </tr>
                <tr>
                    <td><b>Horario: </b><?php echo $row['horario'] ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><?php
                    echo $row['aceptaMascotas'];
                    if ($row['aceptaMascotas'] = 0) {
                        echo "<b>Prohibidas las mascotas</b>";

                    } else {
                        echo "<b>Mascotas Bienvenidas </b>";
                    }
                    ?></td>
                </tr>

            </table>
        </td><td>
        <?php if ($row['costo'] == NULL) {
            echo '<b>Gratuito</b>';
        } else {
            echo '<b>$' . $row['costo'] . '</b>';
        } ?>

        </td>
        <td>
            <?php echo $row['calificacion'] ?>
        </td>
        <td>
            <?php echo $row['oferta'] ?>
        </td>
        </tr>


    <?php }
}
?>