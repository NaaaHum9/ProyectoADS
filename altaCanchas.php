<?php
include 'php/connection.php';
include 'php/deporBack.php';
$enlace = conexion();
session_start();
$id=$_GET['id'];
$consulta="SELECT * FROM deportivo where idDeportivo=".$id;
$query=mysqli_query($enlace,$consulta);
$depor=mysqli_fetch_array($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de Cancha</title>
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
            <h3 id="titulo">Alta de Cancha en <?php echo $depor[1];?></h3>
            <form action="#" method="post" name="alta-espacio">
                <ul>
                    <li>
                        <label for="nombre">Nombre del espacio deportivo:</label>
                        <input type="text" value=<?php echo '"'.$depor[1].'"';?> name="nombre" id="nombre" disabled />
                    </li>
                    <li>
                        <label for="ubicacion">Deporte:</label>
                        <select name="deporte" id="deporte" >
                            <option value="Fútbol">Fútbol</option>
                            <option value="Natacion">Natacion</option>
                            <option value="Atletismo">Atletismo</option>
                            <option value="Voleibol">Voleibol</option>
                            <option value="Baloncesto">Baloncesto</option>
                            <option value="Tenis">Tenis</option>
                            <option value="Fútbol Americano">Fútbol Americano</option>
                            <option value="Gimnasio">Gimnasio</option>
                            <option value="Otro">Otro</option>
                            </select>
                    </li>
                    <li>
                        <label for="medida">Medidas:</label>
                        <input type="text" name="medida" id="medida" required/>
                    </li>
                    <li>
                        <label for="suelo">Tipo de Suelo:</label>
                        <select name="suelo" id="suelo" >
                            <option value="Pasto Sintético">Pasto Sintético</option>
                            <option value="Pasto Natural">Pasto Natural</option>
                            <option value="Tierra">Tierra</option>
                            <option value="Duela">Duela</option>
                            </select>
                    </li>
                    <li>
                        <label for="equip">Equipamiento:</label>
                        <textarea name="equip" id="equip" placeholder="Ingresa el equipamiento de la cancha" required></textarea>
                    </li>

                    <li>
                        <label for="mascotas">¿Tiene iluminación?</label>
                            <label for="iluminacion-si"><input type="radio" name="iluminacion" value="1" id="iluminacion-si">Si</label>
                            <label for="iluminacion-no"><input type="radio" name="iluminacion" value="0" id="iluminacion-no">No</label>
                    </li>
                    <li>
                        <label for="mascotas">¿Está techada?</label>
                            <label for="techo-si"><input type="radio" name="techo" value="1" id="techo-si">Si</label>
                            <label for="techo-no"><input type="radio" name="techo" value="0" id="techo-no">No</label>
                    </li>
                    <li>
                        <label for="mascotas">¿Cuenta con gradas?</label>
                            <label for="gradas-si"><input type="radio" name="gradas" value="1" id="gradas-si">Si</label>
                            <label for="gradas-no"><input type="radio" name="gradas" value="0" id="gradas-no">No</label>
                    </li>
                    <li>
                        <label for="mascotas">¿Hay baños?</label>
                            <label for="banos-si"><input type="radio" name="banos" value="1" id="banos-si">Si</label>
                            <label for="banos-no"><input type="radio" name="banos" value="0" id="banos-no">No</label>
                    </li>
                    <li>
                        <label for="mascotas">¿Cuenta con vestidores?</label>
                            <label for="vestidores-si"><input type="radio" name="vestidores" value="1" id="vestidores-si">Si</label>
                            <label for="vestidores-no"><input type="radio" name="vestidores" value="0" id="vestidores-no">No</label>
                    </li>
                    <li>
                        <label for="horario-apertura">Horario de apertura:</label>
                        <input type="time" name="horario-apertura" id="horario-apertura">
                    </li>
                    <li>
                        <label for="horario-cierre">Horario de cierre</label>
                        <input type="time" name="horario-cierre" id="horario-cierre">
                    </li>
                <div class="div-boton-resgistro">
                    <input type="submit" name="alta" onclick="leerCheckboxes()" value='Dar de alta'>
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
        $nr=rand(1, 100);
        $matricula="C".$nr;
        $deporte = $_POST["deporte"];
        $medida = $_POST["medida"];
        $suelo = $_POST["suelo"];
        $equip = $_POST["equip"];
        $ilumi = $_POST["iluminacion"];
        $techo = $_POST["techo"];
        $grada = $_POST["gradas"];
        $bano = $_POST["banos"];
        $vest = $_POST["vestidores"];
        $horario = $_POST["horario-apertura"] . "a.m.-" . $_POST["horario-cierre"] . "p.m.";
        
        
        $consulta = "INSERT INTO cancha (etiqueta,deporteCancha,medidasCancha,tipoSueloCancha,equipamientoCanchaTipo,iluminacionCanchaStatus,techadoCancha,gradasCanchaStatus,banosCanchasStatus,vestidoresCanchaStatus,horarioCancha,idDeportivo) values('".$matricula."','".$deporte."','".$medida."','".$suelo."','".$equip."',".$ilumi.",".$techo.",".$grada.",".$bano.",".$vest.",'".$horario."',".$depor[0].")";
        echo $consulta;
        $query=mysqli_query($enlace,$consulta);
        echo '<script>window.location.href="deportivo.php?id='.$depor[0].'";</script>';
    }
    ?>
</body>

</html>