# Sistema de Gestión de Espacios Deportivos

## Contenido de `sistema.tgz`

El archivo `sistema.tgz` contiene los siguientes elementos:
- Código fuente de la aplicación web.
- Archivos de configuración necesarios.
- Scripts SQL para la creación de la base de datos.

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
   - Descarga e instala XAMPP desde Apache Friends.
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
   - Crea una nueva base de datos.
   - Importa los scripts SQL incluidos en `sistema.tgz` para crear las tablas necesarias.

3. **Configurar el Archivo de Conexión a la Base de Datos**:
   - Edita el archivo de configuración de la base de datos (por ejemplo, `config.php`) con los detalles de tu base de datos:
     ```php
     <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "nombre_de_tu_base_de_datos";
     ?>
     ```

## Comandos Necesarios para Configurar y Ejecutar el Sistema

1. **Iniciar Apache y MySQL**:
   - Abre el panel de control de XAMPP y haz clic en "Start" para Apache y MySQL.

2. **Acceder a la Aplicación**:
   - Abre tu navegador web y navega a `http://localhost/nombre_del_proyecto`.

3. **Comandos SQL para Crear la Base de Datos**:
   - Abre phpMyAdmin y selecciona la base de datos creada.
   - Importa los scripts SQL incluidos en `sistema.tgz`.

4. **Instalar Dependencias (si aplica)**:
   - Si el proyecto utiliza dependencias gestionadas por Composer o npm, asegúrate de instalarlas:
     ```bash
     # Para Composer
     composer install

     # Para npm
     npm install
     ```

## Notas Adicionales

- Asegúrate de tener PHP instalado y configurado correctamente en tu sistema.
- Revisa la documentación oficial de XAMPP para más detalles sobre la configuración y uso del servidor.

---

Espero que esta guía te sea útil. Si necesitas más detalles o tienes alguna otra pregunta, ¡no dudes en decírmelo!
