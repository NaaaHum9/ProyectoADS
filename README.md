"# ProyectoADS" 
# Instrucciones para Configuración del Proyecto en XAMPP

## Requisitos Previos
- Sistema operativo compatible (Windows, macOS o Linux).
- XAMPP instalado (versión actual o superior).
- Archivo `main.sql` que contiene la estructura de la base de datos.

## Paso 1: Instalación de XAMPP

1. **Descargar XAMPP**:
   - Ve a [https://www.apachefriends.org/es/index.html](https://www.apachefriends.org/es/index.html).
   - Selecciona tu sistema operativo y descarga la versión más reciente de XAMPP.
   
2. **Instalar XAMPP**:
   - Ejecuta el instalador y sigue las instrucciones en pantalla.
   - Durante la instalación, asegúrate de que estén seleccionados los módulos Apache y MySQL.

3. **Iniciar XAMPP**:
   - Abre el Panel de Control de XAMPP (en Windows) o ejecuta el comando `sudo /opt/lampp/lampp start` en Linux.
   - Inicia los servicios de **Apache** y **MySQL** desde el panel de control.

## Paso 2: Configuración del Proyecto

1. **Copiar la carpeta del proyecto**:
   - Ve a la carpeta de instalación de XAMPP y localiza el directorio `htdocs`.
   - En **Windows**: `C:\xampp\htdocs`.
   - En **Linux**: `/opt/lampp/htdocs`.

2. **Agregar la carpeta del proyecto**:
   - Copia la carpeta del proyecto llamada `main` y pégala dentro del directorio `htdocs`.

3. **Acceder al proyecto**:
   - Abre tu navegador web y accede a `http://localhost/main/`.

## Paso 3: Configuración de la Base de Datos

1. **Crear la base de datos**:
   - Abre **phpMyAdmin** desde el Panel de Control de XAMPP o en el navegador a través de `http://localhost/phpmyadmin/`.
   - Haz clic en la pestaña **Bases de datos**.
   - En el campo de nombre, escribe `test` y selecciona el formato de intercalación (`utf8_general_ci`).
   - Haz clic en **Crear**.

2. **Importar la base de datos**:
   - Con la base de datos `test` seleccionada, haz clic en la pestaña **Importar**.
   - Usa el botón **Elegir archivo** para seleccionar el archivo `main.sql` del proyecto.
   - Asegúrate de que el formato esté seleccionado como **SQL** y haz clic en **Continuar**.

## Paso 4: Verificar la instalación

1. Abre un navegador y navega a `http://localhost/main/`.
2. Verifica que el proyecto esté funcionando correctamente y que pueda acceder a la base de datos `test`.

---

## Problemas Comunes

1. **Error de conexión a la base de datos**:
   - Verifica que los servicios de MySQL estén ejecutándose en el Panel de Control de XAMPP.
   - Revisa las credenciales de conexión en el archivo de configuración del proyecto (por ejemplo, en `config.php`).

2. **Apache no inicia**:
   - Asegúrate de que no haya otros servicios usando el puerto 80 o 443 (puedes cambiar el puerto en el archivo `httpd.conf`).

---

## Enlaces útiles

- [Documentación oficial de XAMPP](https://www.apachefriends.org/es/index.html)
- [phpMyAdmin](https://www.phpmyadmin.net/)