<?php
include 'php/connection.php';
include 'php/deporBack.php';
$enlace = conexion();
session_start();

$idDepor=$_GET['id'];


$consulta="SELECT * FROM deportivo WHERE idDeportivo=".$idDepor;
$query=mysqli_query($enlace,$consulta);
$info=mysqli_fetch_array($query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de espacio deportivo</title>
</head>

<body>
    <header></header>
    <nav>
        <div class="buscador">
            <form method="get" id="buscarform">
                <fieldset>
                    <input type="text" id="" value="" placeholder="Buscar">
                    <button>Click</button>
                    <i class="search"></i>
                </fieldset>
            </form>
        </div>

        <div class="perfil-usuario">
            <img src="" alt="">
        </div>

        <div class="botones-container">
            <button class="boton">Inicio</button>
            <button class="boton">Espacios</button>
            <button class="boton">Partida</button>
            <button class="boton">Reporte</button>
        </div>
    </nav>

    <main>
        <section>
            <h3 id="titulo">Actualizar <?php echo '"'.$info['nombre'].'"';?></h3>
            <form action="#" method="post" name="alta-espacio"  >
                <ul>
                    <li>
                        <label for="nombre">Nombre del espacio deportivo:</label>
                        <input type="text" name="nombre" id="nombre" value=<?php echo '"'.$info['nombre'].'"';?>/>
                    </li>
                    <li>
                        <label for="ubicacion">Link de Maps:</label>
                        <input type="text" name="ubicacion" id="ubicacion" value=<?php echo '"'.$info['mapa'].'"';?>/>
                    </li>
                    <li>
                        <label for="dir">Dirección</label>
                        <textarea name="dir" id="dir" ><?php echo $info['direccion'];?></textarea>
                    </li>
                    
                    <li>
                        <label for="nombre-usuario">Nombre de usuario</label>
                        <input type="text" name="nombre-usuario" value=<?php echo '"' . $_SESSION['nombre'] . '"'; ?>
                            id="nombre-usuario" disabled />
                    </li>
                    <li>
                        <label for="tipo-espacio">Tipo de espacio deportivo</label>
                        <select name="tipo-espacio" id="tipo-espacio" list="tipo-opciones">
                            <option value="Deportivo">Deportivo</option>
                            <option value="Canchas">Canchas</option>
                            <option value="Gimnasio al aire libre">Gimnasio al aire libre</option>
                            <option value="Alberca">Alberca</option>
                            <option value="Gimnasio">Gimnasio</option>
                            <option value="Modulo deportivo">Modulo deportivo</option>
                            <option value="Complejo olimpico">Complejo olimpico</option>
                            <option value="Centro deportivo">Centro deportivo</option>
                            <option value="Unidad deportiva">Unidad deportiva</option>
                            <option value="Deportivo popular">Deportivo popular</option>
                        </select>
                    </li>
                    <li>
                        <label for="imagen-principal">Imagen principal</label>
                        <input type="file" name="imagen-principal" id="imagen-principal" />
                    </li>

                    <li>
                        <label for="fecha-registro">Fecha de registro</label>
                        <input type="date" name="fecha-registro" id="fecha-registro" readonly />
                    </li>
                    <li>
                        <label for="">Baños:</label>
                        <label for="ba-si"><input type="radio" name="banos" value="1" id="ba-si">Si</label>
                        <label for="ba-no"><input type="radio" name="banos" value="0" id="ba-no">No</label>
                        
                        <?php
                            if(isset($info['banosStatus'])){

                                if($info['banosStatus']==0){

                                    echo '<script>document.getElementById("ba-no").checked = true;</script>';

                                }else{
                                    echo '<script>document.getElementById("ba-si").checked = true;</script>';

                                }
                            }
                        ?>
                    </li>
                    <!--<li>
                        <label for="no-banos">Numero de baños</label>
                        <input type="number" name="no-banos" id="no-banos" onchange="generarCamposBanos()"
                            placeholder="Ingresa el numero de baños" />
                        <div id="estado-container"></div>
                        <div id="tipos-container"></div>
                        <datalist id="status-banos">
                            <option value="Funcionales"></option>
                            <option value="Fuera de servicio"></option>
                            <option value="En reparacion"></option>
                            <option value="Sin baños"></option>
                        </datalist>
                    </li>
                    
                    <li>
                        <label for="estado-banos">Estado de los baños</label>
                        <input type="text" name="estado-banos" id="estado-banos" list="status-banos"/>
                        <datalist id="status-banos">
                            <option value="Funcionales"></option>
                            <option value="Fuera de servicio"></option>
                            <option value="En reparacion"></option>
                            <option value="Sin baños"></option>
                        </datalist>
                    </li>
                    <li>
                        <label>Tipos de baños:</label>
                        <div>
                            <label><input type="checkbox" name="tipos-banos" value="Discapacitados"> Discapacitados</label>
                            <label><input type="checkbox" name="tipos-banos" value="Damas">Damas</label>
                            <label><input type="checkbox" name="tipos-banos" value="Caballeros">Caballeros</label>
                            <label><input type="checkbox" name="tipos-banos" value="Sin baños"> Sin baños</label>
                        </div>
                    </li>
                    <li>
                        <label for="no-comercios">Numero de comercios</label>
                        <input type="number" name="no-comercios" id="no-comercios" onchange="generarCamposComercios()"
                            placeholder="Ingresa el numero de comercios" />
                        <div id="estado-container-comercio"></div>
                        <div id="tipos-container-comercio"></div>
                        <datalist id="status-comercios">
                            <option value="Abiertos"></option>
                            <option value="Fuera de servicio"></option>
                            <option value="En reparacion"></option>
                        </datalist>
                    </li>
                    <li>-->
                        <!--<label for="vigilancia">Vigilancia</label>
                        <div class="div-vigilancia">
                            <label for="vigilancia-tipo1"><input type="checkbox" name="vigilancia"
                                    value="Camaras de seguridad" id="vigilancia-tipo1">Camaras de seguridad</label>
                            <label for="vigilancia-tipo2"><input type="checkbox" name="vigilancia"
                                    value="Guardia de seguridad" id="vigilancia-tipo2">Guardia de seguridad</label>
                            <label for="vigilancia-tipo3"><input type="checkbox" name="vigilancia"
                                    value="Seguridad privada" id="vigilancia-tipo3">Seguridad privada</label>
                            <label for="vigilancia-tipo0"><input type="checkbox" name="vigilancia" value="Sin seguridad"
                                    id="vigilancia-tipo0" onclick="toggleCheckboxes()">Sin
                                seguridad</label>-->
                    <li>
                        <label for="">Vigilancia:</label>
                        <label for="vig-si"><input type="radio" name="vigilancia" value="1" id="vig-si">Si</label>
                        <label for="vig-no"><input type="radio" name="vigilancia" value="0" id="vig-no">No</label>
                        <?php
                            if(isset($info['vigilanciaStatus'])){

                                if($info['vigilanciaStatus']==0){

                                    echo '<script>document.getElementById("vig-no").checked = true;</script>';

                                }else{
                                    echo '<script>document.getElementById("vig-si").checked = true;</script>';

                                }
                            }
                        ?>
                    </li>
                    </div>
                    </li>
                    
                    <li>
                        <label for="mascotas">Permite mascotas:</label>
                        <label for=""><input type="radio" name="mascotas" value="1" id="mascotas-si">Si</label>
                        <label for=""><input type="radio" name="mascotas" value="0" id="mascotas-no">No</label>
                        <?php
                            if(isset($info['aceptaMascotas'])){

                                if($info['aceptaMascotas']==0){

                                    echo '<script>document.getElementById("mascotas-no").checked = true;</script>';

                                }else{
                                    echo '<script>document.getElementById("mascotas-si").checked = true;</script>';

                                }
                            }
                        ?>
                    </li>
                    <li>
                        <label for="puertas-entradas">Puertas de entrada;</label>
                        <input type="number" name="puertas-entradas" id="puertas-entradas" />
                    </li>
                    <li>
                        <label for="horario-apertura">Horario de apertura:</label>
                        <input type="time" name="horario-apertura" id="horario-apertura">
                    </li>
                    <li>
                        <label for="horario-cierre">Horario de cierre</label>
                        <input type="time" name="horario-cierre" id="horario-cierre">
                    </li>
                    <li>
                        <label for="costos">Costos:</label>
                        <input type="number" name="costos" id="costos" placeholder="$--.-">
                        <label for=""><input type="checkbox" name="sin-costo" id="sin-costo"
                                onclick="toggleDisabled()">Sin costo</label>
                                <?php
                            if(empty($info['costo'])){

                                    echo '<script>document.getElementById("sin-costo").checked = true;</script>';
                                    echo '<script>document.getElementById("costos").disabled = true;</script>';
                                }
                        ?>
                    </li>
                    <li>
                        <label for="encargado">Encargado:</label>
                        <select name="encargado" id="encargado">
                            <?php
                            $cons = "SELECT * FROM usuario WHERE tipoUsuario=1";
                            $res = mysqli_query($enlace, $cons);
                            while ($fila = mysqli_fetch_assoc($res)) {
                                // Acceder a cada valor
                                echo "<option value=" . $fila['idUsuario'] . ">" . $fila['nombre'] . "</option>";
                            }
                            ?>
                        </select>
                    </li>
                </ul>
                <div class="div-boton-resgistro">
                    <input type="submit" name="alta" value='Actualizar información'>
                </div>
            </form>

        </section>
    </main>
    <footer></footer>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        /* Estilos generales */
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Navegación */
        nav {
            background-color: #D9D9D9;
        }

        #titulo {
            margin-top: 50px;
        }

        /* Contenedor de botones */
        .botones-container {
            padding-bottom: 10px;
            display: flex;
            justify-content: center;
            gap: 70px;
        }

        .boton {
            padding: 5px 20px;
            cursor: pointer;
        }

        /* Título */
        #alta-espacio {
            display: flex;
            justify-content: center;
            font-size: 22px;
            margin-top: 50px;
        }

        /* Formulario */
        form {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
        }

        h3 {
            border: 2px solid;
            padding: 15px;
            margin: 0 150px;
            text-align: center;
            background-color: #D9D9D9;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        /* Etiquetas */
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        /* Contenedor de vigilancia */
        .div-vigilancia {
            display: flex;
            flex-direction: column;
            margin-top: 8px;
        }

        .div-vigilancia label {
            margin-bottom: 5px;
        }

        /* Contenedor del botón de registro */
        .div-boton-resgistro {
            padding-top: 50px;
            display: flex;
            justify-content: center;
        }

        .boton-registro {
            font-size: 22px;
            padding: 10px 40px;
            cursor: pointer;
        }
    </style>

    <script>
        const ahora = new Date();
        const año = ahora.getFullYear();
        const mes = (ahora.getMonth() + 1).toString().padStart(2, '0'); // Añadir cero inicial
        const dia = ahora.getDate().toString().padStart(2, '0');

        const fecha = `${año}-${mes}-${dia}`;
        document.getElementById('fecha-registro').value = fecha;



        function toggleDisabled() {
            let a = document.getElementById('costos');
            a.disabled = !a.disabled;
        }
        function leerCheckboxes() {

            const checkboxes = document.querySelectorAll('input[name="vigilancia-tipo"]:checked'); // Selecciona todos los checkboxes marcados
            const valores = []; // Array para almacenar los valores seleccionados

            checkboxes.forEach((checkbox) => {
                valores.push(checkbox.value); // Agrega el valor del checkbox al array
            });

            // Muestra los resultados
            $vigilancia = valores.join(', ');
            alert($vigilancia);
            return $vigilancia
        }
        function toggleCheckboxes() {
            let a = document.getElementById('vigilancia-tipo1');
            a.checked = false;
            a.disabled = !a.disabled;
            let b = document.getElementById('vigilancia-tipo2');
            b.checked = false;
            b.disabled = !b.disabled;
            let c = document.getElementById('vigilancia-tipo3');
            c.checked = false;
            c.disabled = !c.disabled;


        }
        function generarCamposBanos() {
            const numBanos = document.getElementById('no-banos').value;
            const estadoContainer = document.getElementById('estado-container');
            const tiposContainer = document.getElementById('tipos-container');

            // Limpiar contenedores antes de generar nuevos
            estadoContainer.innerHTML = '';
            tiposContainer.innerHTML = '';

            for (let i = 0; i < numBanos; i++) {
                // Crear el campo para estado de baños
                let estadoLabel = document.createElement('label');
                estadoLabel.innerText = `Estado del baño ${i + 1}: `;
                let estadoInput = document.createElement('input');
                estadoInput.type = 'text';
                estadoInput.name = `estado-banos-${i + 1}`;
                estadoInput.setAttribute('list', 'status-banos');

                estadoContainer.appendChild(estadoLabel);
                estadoContainer.appendChild(estadoInput);
                estadoContainer.appendChild(document.createElement('br'));

                // Crear el campo para tipos de baños
                let tiposLabel = document.createElement('label');
                tiposLabel.innerText = `Tipo de baño ${i + 1}: `;
                let tiposDiv = document.createElement('div');

                ['Discapacitados', 'Damas', 'Caballeros', 'Sin baños'].forEach(tipo => {
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = `tipos-banos-${i + 1}[]`;
                    checkbox.value = tipo;
                    tiposDiv.appendChild(checkbox);
                    tiposDiv.appendChild(document.createTextNode(tipo));
                });

                tiposContainer.appendChild(tiposLabel);
                tiposContainer.appendChild(tiposDiv);
                tiposContainer.appendChild(document.createElement('br'));
            }
        }

        function generarCamposComercios() {
            const numComercios = document.getElementById('no-comercios').value;
            const estadoContainer = document.getElementById('estado-container-comercio');
            const tiposContainer = document.getElementById('tipos-container-comercio');

            estadoContainer.innerHTML = '';
            tiposContainer.innerHTML = '';

            for (let i = 0; i < numComercios; i++) {
                // Crear el campo para estado de baños
                let estadoLabel = document.createElement('label');
                estadoLabel.innerText = `Estado del comercio ${i + 1}: `;
                let estadoInput = document.createElement('input');
                estadoInput.type = 'text';
                estadoInput.name = `estado-comercios-${i + 1}`;
                estadoInput.setAttribute('list', 'status-comercios');

                estadoContainer.appendChild(estadoLabel);
                estadoContainer.appendChild(estadoInput);
                estadoContainer.appendChild(document.createElement('br'));

                // Crear el campo para tipos de baños
                let tiposLabel = document.createElement('label');
                tiposLabel.innerText = `Tipo de comercio ${i + 1}: `;
                let tiposDiv = document.createElement('div');

                ['Restaurante', 'Tienda', 'Articulos deportivos', 'Ropa'].forEach(tipo => {
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = `tipos-comercios-${i + 1}[]`;
                    checkbox.value = tipo;
                    tiposDiv.appendChild(checkbox);
                    tiposDiv.appendChild(document.createTextNode(tipo));
                });

                tiposContainer.appendChild(tiposLabel);
                tiposContainer.appendChild(tiposDiv);
                tiposContainer.appendChild(document.createElement('br'));
            }
        }
    </script>
    <?php
    if (isset($_POST["alta"])) {
        $nombre = $_POST["nombre"];
        $ubi = $_POST["ubicacion"];
        $direc = $_POST["dir"];
        $mascota = $_POST["mascotas"];
        $horario = $_POST["horario-apertura"] . "a.m.-" . $_POST["horario-cierre"] . "p.m.";
        $opcion1 = isset($_POST['sin-costo']) ? "NULL" : $_POST["costos"];
        $encar = $_POST["encargado"];
        $tipo = $_POST["tipo-espacio"];
        
        $consulta = "UPDATE deportivo SET nombre = '".$nombre."',direccion = '".$direc."',horario = '" . $horario . "',    mapa = '" . $ubi . "',  tipoEspacio = '" . $tipo . "',    aceptaMascotas = " . $mascota . ",    costo = " . $opcion1 . ",    idEncargado = " . $encar . " WHERE idDeportivo=";
        $consulta= $consulta.$idDepor;
        $query=mysqli_query($enlace,$consulta);
        echo '<script>window.location.href="deportivo.php?id='.$idDepor.'"</script>';

    }
    ?>
</body>

</html>