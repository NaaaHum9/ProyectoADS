-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-09-2024 a las 17:04:44
-- Versión del servidor: 8.0.37
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aprovdep`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `idCalificacion` int NOT NULL,
  `idUsuario` int NOT NULL,
  `idDeportivo` int NOT NULL,
  `calificacion` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `calificacion`
--
DELIMITER $$
CREATE TRIGGER `updateAvgDepor` AFTER INSERT ON `calificacion` FOR EACH ROW BEGIN
    DECLARE nuevo_promedio DECIMAL(10, 2);

    -- Calcular el promedio de todos los valores en la tabla 'valores'
    SELECT AVG(calificacion) INTO nuevo_promedio FROM calificacion where idDeportivo=NEW.idDeportivo;

    -- Actualizar el promedio en la tabla 'promedios'
    UPDATE deportivo SET calificacion = nuevo_promedio WHERE id = NEW.idDeportivo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentdeportivo`
--

CREATE TABLE `comentdeportivo` (
  `idComentDeportivo` int NOT NULL,
  `autor` int NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL,
  `idDeportivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentdeportivo`
--

INSERT INTO `comentdeportivo` (`idComentDeportivo`, `autor`, `contenido`, `fecha`, `idDeportivo`) VALUES
(1, 1, 'Bonito Lugar', '2024-09-03 00:00:00', 1),
(2, 1, 'Hola', '2024-09-14 05:44:30', 1),
(5, 1, 'xD', '2024-09-14 05:45:31', 1),
(6, 1, 'xD', '2024-09-14 05:45:45', 1),
(7, 1, '!8 de Marzo', '2024-09-14 05:47:24', 1),
(8, 1, '123', '2024-09-14 05:48:53', 1),
(9, 1, 'Muy bonito', '2024-09-14 06:23:50', 2),
(10, 1, 'Excelente', '2024-09-14 06:24:04', 2),
(11, 1, 'Muchas Actividades', '2024-09-16 00:34:47', 2),
(12, 1, 'Excelente pagina de mucha ayuda', '2024-09-16 00:35:09', 2),
(14, 1, '123', '2024-09-20 12:04:34', 1),
(15, 1, 'Bieen', '2024-09-20 12:04:42', 1),
(16, 2, 'Hola', '2024-09-20 13:18:15', 1),
(17, 2, 'Hola a todos', '2024-09-20 13:36:06', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentusuario`
--

CREATE TABLE `comentusuario` (
  `idComentUsuario` int NOT NULL,
  `autor` int NOT NULL,
  `contenido` text NOT NULL,
  `fecha` timestamp NOT NULL,
  `idUsuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentusuario`
--

INSERT INTO `comentusuario` (`idComentUsuario`, `autor`, `contenido`, `fecha`, `idUsuario`) VALUES
(1, 1, ':)', '2024-09-10 06:00:00', 1),
(3, 1, 'Gran Jugador', '2024-09-03 06:00:00', 1),
(4, 1, 'Bastante Disciplinado', '2024-09-20 19:48:28', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `idDeporte` int NOT NULL,
  `idUsuario` int NOT NULL,
  `deporte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportivo`
--

CREATE TABLE `deportivo` (
  `idDeportivo` int NOT NULL,
  `nombre` text NOT NULL,
  `direccion` text NOT NULL,
  `horario` text NOT NULL,
  `oferta` text NOT NULL,
  `mapa` text NOT NULL,
  `calificacion` decimal(1,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `deportivo`
--

INSERT INTO `deportivo` (`idDeportivo`, `nombre`, `direccion`, `horario`, `oferta`, `mapa`, `calificacion`) VALUES
(1, 'Deportivo 18 de Marzo', 'Habana s/n, Tepeyac Insurgentes, Gustavo A. Madero, 07020 Ciudad de México, CDMX', '6:00 a.m. - 9:30 p.m.', 'Canchas de futbol al aire libre, chanchas de basquetbol al aire libre y cerradas, alberca techada, cancha de futbol americano, salón de eventos, cancha de tenis.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15045.372924674166!2d-99.13440478261717!3d19.48386350000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9a05593187f%3A0xe37409f0fab22428!2sDeportivo%2018%20de%20Marzo!5e0!3m2!1ses-419!2smx!4v1726822223122!5m2!1ses-419!2smx', 0.0),
(2, 'Deportivo Hermanos Galeana', 'Av. José Loreto Fabela 190, San Juan de Aragón VII Secc, Gustavo A. Madero, 07910 Ciudad de México, CDMX', '7:30 a.m. - 7:30 p.m.', 'Canchas de basquetbol, futbol soccer, futbol americano, estadio y campo de beisbol, alberca, rampas de skate, juegos infantiles.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7523.034112687611!2d-99.08426601926001!3d19.476378140237234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fbb6b9af24bd%3A0xa8188376a4459339!2sDeportivo%20los%20Galeana%2C%2007910%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1726822376036!5m2!1ses-419!2smx', 0.0),
(3, 'Centro Deportivo “Lomas de San Jerónimo”', 'Laurel 76, Lomas de San Miguel, 52928 Cdad. López Mateos, Méx.', '8:00 a.m. - 9:00 p.m.', 'Gimnasio equipado, canchas de voleibol, pista de atletismo, muro de escalada, cancha de pádel, áreas de yoga al aire libre, parque de calistenia.', '', 0.0),
(4, 'Complejo Olímpico – Alberca “Francisco Márquez” y Gimnasio “Juan de la Barrera”', 'Av. Río Churubusco, Gral Anaya, Benito Juárez, 03340 Ciudad de México, CDMX', '8:00 a.m. - 8:00 p.m.', 'Canchas de fútbol rápido, canchas de voleibol, gimnasio de pesas, cancha de básquetbol, pista para correr, alberca al aire libre, zona de entrenamiento funcional.', '', 0.0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgdepor`
--

CREATE TABLE `imgdepor` (
  `idImgDepor` int NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `idDeportivo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `imgdepor`
--

INSERT INTO `imgdepor` (`idImgDepor`, `ruta`, `idDeportivo`) VALUES
(1, 'img/areas/dep18.png', 1),
(2, 'img/areas/galeana.jpg', 2),
(3, 'img/areas/centro-deportivo-san-jeronimo-piscina-francisco-tabuenca-pool.jpg', 3),
(4, 'img/areas/Alberca_Olímpica_Francisco_Márquez.jpg', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reputacion`
--

CREATE TABLE `reputacion` (
  `idReputacion` int NOT NULL,
  `autor` int NOT NULL,
  `calificado` int NOT NULL,
  `reputacion` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Disparadores `reputacion`
--
DELIMITER $$
CREATE TRIGGER `updateAvgUser` AFTER INSERT ON `reputacion` FOR EACH ROW BEGIN
    DECLARE nuevopromedio DECIMAL(10, 2);

    -- Calcular el promedio de todos los valores en la tabla 'valores'
    SELECT AVG(reputacion) INTO nuevopromedio FROM reputacion where calificado= NEW.calificado;

    -- Actualizar el promedio en la tabla 'promedios'
    UPDATE deportivo SET reputacion = nuevopromedio WHERE calificado= NEW.calificado;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int NOT NULL,
  `nombre` text NOT NULL,
  `correo` text NOT NULL,
  `pass` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `reputacion` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `correo`, `pass`, `imagen`, `reputacion`) VALUES
(1, 'root', 'root@root', 'root', 'img/metallica.jpeg', 5.0),
(2, 'Paki', 'christopherpaki.nunezr@hotmail.com', '123', 'img/2.jpeg', 0.0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`idCalificacion`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `comentdeportivo`
--
ALTER TABLE `comentdeportivo`
  ADD PRIMARY KEY (`idComentDeportivo`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `comentusuario`
--
ALTER TABLE `comentusuario`
  ADD PRIMARY KEY (`idComentUsuario`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD PRIMARY KEY (`idDeporte`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `deportivo`
--
ALTER TABLE `deportivo`
  ADD PRIMARY KEY (`idDeportivo`);

--
-- Indices de la tabla `imgdepor`
--
ALTER TABLE `imgdepor`
  ADD PRIMARY KEY (`idImgDepor`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `reputacion`
--
ALTER TABLE `reputacion`
  ADD PRIMARY KEY (`idReputacion`),
  ADD KEY `autor` (`autor`),
  ADD KEY `calificado` (`calificado`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `idCalificacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentdeportivo`
--
ALTER TABLE `comentdeportivo`
  MODIFY `idComentDeportivo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `comentusuario`
--
ALTER TABLE `comentusuario`
  MODIFY `idComentUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `idDeporte` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imgdepor`
--
ALTER TABLE `imgdepor`
  MODIFY `idImgDepor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `comentdeportivo`
--
ALTER TABLE `comentdeportivo`
  ADD CONSTRAINT `comentdeportivo_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentdeportivo_ibfk_2` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `comentusuario`
--
ALTER TABLE `comentusuario`
  ADD CONSTRAINT `comentusuario_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentusuario_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD CONSTRAINT `deporte_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `imgdepor`
--
ALTER TABLE `imgdepor`
  ADD CONSTRAINT `imgdepor_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `reputacion`
--
ALTER TABLE `reputacion`
  ADD CONSTRAINT `reputacion_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `reputacion_ibfk_2` FOREIGN KEY (`calificado`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
