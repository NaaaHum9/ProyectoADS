# Sistema Aprovechamiento de Espacios Deportivos

## Contenido de `sistema.tgz`

El archivo `sistema.tgz` contiene los siguientes elementos:
- Código fuente de la aplicación web.
- Archivos de configuración necesarios.
- `test.sql` para la creación de la base de datos.

## Especificaciones de Software y Hardware

### Requisitos de Software

- **Sistema Operativo**: Windows, macOS o Linux
- **Servidor Web**: XAMPP (incluye Apache, PHP y MySQL)
- **Base de Datos**: MySQL (incluido en XAMPP)
- **IDE Recomendado**: Visual Studio Code, PHPStorm o cualquier editor de texto con soporte para PHP y JavaScript
- **Navegador Web**: Google Chrome, Mozilla Firefox, Microsoft Edge

### Requisitos de Hardware

- **Procesador**: Intel i3 o superior
- **Memoria RAM**: 4 GB mínimo (8 GB recomendado)
- **Espacio en Disco**: 500 MB para XAMPP y archivos del proyecto

## Instrucciones para Modificar el Sistema en un IDE

1. **Instalar XAMPP**:
   - Descarga e instala XAMPP desde [Apache Friends](https://www.apachefriends.org/es/download.html).
   - Asegúrate de que Apache y MySQL estén activos en el panel de control de XAMPP.

2. **Configurar el Proyecto en el IDE**:
   - Abre tu IDE preferido.
   - Clona el repositorio del proyecto o extrae el contenido de `sistema.tgz` en el directorio `htdocs` de XAMPP.
   - Abre el proyecto en tu IDE.

## Instrucciones para Desplegar la Aplicación en un Servidor

1. **Configurar el Servidor Web**:
   - Asegúrate de que Apache y MySQL estén activos en el panel de control de XAMPP.
   - Copia los archivos del proyecto al directorio `htdocs` de XAMPP.

2. **Crear la Base de Datos**:
   - Abre phpMyAdmin desde el panel de control de XAMPP.
   - Crea una nueva base de datos llamada `test`.
   - Importa el archivo `test.sql` para crear las tablas necesarias:
     1. Selecciona la base de datos `test`.
     2. Haz clic en la pestaña "Importar".
     3. Selecciona el archivo `test.sql` desde tu computadora.
     4. Haz clic en "Ejecutar" para importar el archivo.

3. **Configurar el Archivo de Conexión a la Base de Datos**:
   - Edita el archivo de configuración de la base de datos (por ejemplo, `config.php`) con los detalles de tu base de datos:
     ```php
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "test";
     ?>
     ```

## Comandos Necesarios para Configurar y Ejecutar el Sistema

1. **Iniciar Apache y MySQL**:
   - Abre el panel de control de XAMPP y haz clic en "Start" para Apache y MySQL.

2. **Acceder a la Aplicación**:
   - Abre tu navegador web y navega a `http://localhost/nombre_del_proyecto`.


## Notas Adicionales

- Asegúrate de tener PHP instalado y configurado correctamente en tu sistema.
- Revisa la documentación oficial de XAMPP para más detalles sobre la configuración y uso del servidor.
