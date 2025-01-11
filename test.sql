-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2025 a las 09:03:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigo`
--

CREATE TABLE `amigo` (
  `idAmigo` int(11) NOT NULL,
  `idAmigo1` int(11) NOT NULL,
  `idAmigo2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `idCalificacion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idDeportivo` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`idCalificacion`, `idUsuario`, `idDeportivo`, `calificacion`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 5),
(3, 1, 5, 3);

--
-- Disparadores `calificacion`
--
DELIMITER $$
CREATE TRIGGER `updateAvgDepor` AFTER INSERT ON `calificacion` FOR EACH ROW BEGIN
    DECLARE nuevo_promedio DECIMAL(10, 2);

    
    SELECT AVG(calificacion) INTO nuevo_promedio FROM calificacion where idDeportivo=NEW.idDeportivo;

    
    UPDATE deportivo SET calificacion = nuevo_promedio WHERE idDeportivo = NEW.idDeportivo;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateAvgDepor2` AFTER UPDATE ON `calificacion` FOR EACH ROW BEGIN
    DECLARE nuevo_promedio DECIMAL(10, 2);

    
    SELECT AVG(calificacion) INTO nuevo_promedio FROM calificacion where idDeportivo=NEW.idDeportivo;

    
    UPDATE deportivo SET calificacion = nuevo_promedio WHERE idDeportivo = NEW.idDeportivo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE `cancha` (
  `idCancha` int(11) NOT NULL,
  `etiqueta` varchar(100) DEFAULT NULL,
  `deporteCancha` varchar(100) DEFAULT NULL,
  `medidasCancha` varchar(255) DEFAULT NULL,
  `tipoSueloCancha` varchar(100) DEFAULT NULL,
  `senalamientosCancha` text DEFAULT NULL,
  `equipamientoCanchaTipo` varchar(100) DEFAULT NULL,
  `equipamientoCanchaStatus` varchar(100) DEFAULT NULL,
  `equipamientoCanchaCantidad` int(11) DEFAULT NULL,
  `iluminacionCanchaCantidad` int(11) DEFAULT NULL,
  `iluminacionCanchaStatus` varchar(100) DEFAULT NULL,
  `iluminacionCanchaTipo` varchar(100) DEFAULT NULL,
  `techadoCancha` tinyint(1) DEFAULT NULL,
  `techadoCanchaTipo` varchar(100) DEFAULT NULL,
  `gradasCanchaTipo` varchar(100) DEFAULT NULL,
  `gradasCanchaStatus` varchar(100) DEFAULT NULL,
  `gradasCanchaCantidad` int(11) DEFAULT NULL,
  `banosCanchaCantidad` int(11) DEFAULT NULL,
  `banosCanchasStatus` varchar(100) DEFAULT NULL,
  `banosCanchasTipo` varchar(100) DEFAULT NULL,
  `vestidoresCanchaTipo` int(11) DEFAULT NULL,
  `vestidoresCanchaStatus` varchar(100) DEFAULT NULL,
  `vestidoresCanchaCantidad` int(11) DEFAULT NULL,
  `ubicacionPoligono` varchar(255) DEFAULT NULL,
  `direccionEnDeportivo` varchar(255) DEFAULT NULL,
  `horarioCancha` varchar(100) DEFAULT NULL,
  `idDeportivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cancha`
--

INSERT INTO `cancha` (`idCancha`, `etiqueta`, `deporteCancha`, `medidasCancha`, `tipoSueloCancha`, `senalamientosCancha`, `equipamientoCanchaTipo`, `equipamientoCanchaStatus`, `equipamientoCanchaCantidad`, `iluminacionCanchaCantidad`, `iluminacionCanchaStatus`, `iluminacionCanchaTipo`, `techadoCancha`, `techadoCanchaTipo`, `gradasCanchaTipo`, `gradasCanchaStatus`, `gradasCanchaCantidad`, `banosCanchaCantidad`, `banosCanchasStatus`, `banosCanchasTipo`, `vestidoresCanchaTipo`, `vestidoresCanchaStatus`, `vestidoresCanchaCantidad`, `ubicacionPoligono`, `direccionEnDeportivo`, `horarioCancha`, `idDeportivo`) VALUES
(2, 'C46', 'Fútbol', '23mX20m', 'Pasto Sintético', NULL, 'LOL', NULL, NULL, NULL, '1', NULL, 0, NULL, NULL, '1', NULL, NULL, '0', NULL, NULL, '1', NULL, NULL, NULL, 'a.m.-p.m.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentcurso`
--

CREATE TABLE `comentcurso` (
  `idComentCurso` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` date NOT NULL,
  `idCurso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentdeportivo`
--

CREATE TABLE `comentdeportivo` (
  `idComentDeportivo` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` date NOT NULL,
  `idDeportivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentdeportivo`
--

INSERT INTO `comentdeportivo` (`idComentDeportivo`, `autor`, `contenido`, `fecha`, `idDeportivo`) VALUES
(1, 1, 'Bonito Lugar', '2024-09-03', 1),
(2, 1, 'Hola', '2024-09-14', 1),
(5, 1, 'xD', '2024-09-14', 1),
(6, 1, 'xD', '2024-09-14', 1),
(7, 1, '!8 de Marzo', '2024-09-14', 1),
(8, 1, '123', '2024-09-14', 1),
(9, 1, 'Muy bonito', '2024-09-14', 2),
(10, 1, 'Excelente', '2024-09-14', 2),
(11, 1, 'Muchas Actividades', '2024-09-16', 2),
(12, 1, 'Excelente pagina de mucha ayuda', '2024-09-16', 2),
(14, 1, '123', '2024-09-20', 1),
(15, 1, 'Bieen', '2024-09-20', 1),
(16, 2, 'Hola', '2024-09-20', 1),
(17, 2, 'Hola a todos', '2024-09-20', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comenttorneo`
--

CREATE TABLE `comenttorneo` (
  `idComentTorneo` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` date NOT NULL,
  `idTorneo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentusuario`
--

CREATE TABLE `comentusuario` (
  `idComentUsuario` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentusuario`
--

INSERT INTO `comentusuario` (`idComentUsuario`, `autor`, `contenido`, `fecha`, `idUsuario`) VALUES
(1, 1, ':)', '2024-09-10 00:00:00', 1),
(3, 1, 'Gran Jugador', '2024-09-03 12:45:00', 1),
(4, 1, 'Bastante Disciplinado', '2024-09-20 13:16:00', 2),
(5, 1, 'Holis', '2025-01-09 01:15:00', 2),
(6, 1, 'Holis', '2025-01-09 01:26:00', 2),
(7, 1, 'Holis', '2025-01-09 01:20:00', 2),
(8, 1, 'Acepta mi solicitud por favor', '2025-01-09 02:00:00', 2),
(9, 1, 'A ver si ora si', '2025-01-09 09:16:58', 2),
(10, 1, 'Ya?', '2025-01-09 02:17:39', 2),
(11, 2, 'Holi', '2025-01-10 02:01:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `idCurso` int(11) NOT NULL,
  `nombreCurso` varchar(255) NOT NULL,
  `objetivoCurso` text DEFAULT NULL,
  `descripcionCurso` text DEFAULT NULL,
  `modalidadCurso` varchar(100) DEFAULT NULL,
  `fechasProgramadas` date DEFAULT NULL,
  `numeroHoras` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `ligaInscripciones` varchar(255) DEFAULT NULL,
  `calificaciones` decimal(3,2) DEFAULT NULL,
  `ubicacionCurso` varchar(255) DEFAULT NULL,
  `tipoReconocimiento` varchar(255) DEFAULT NULL,
  `empresaPatrocinadora` varchar(255) DEFAULT NULL,
  `prerequisitos` text DEFAULT NULL,
  `materialEquipamineto` text DEFAULT NULL,
  `nivelExperiencia` varchar(100) DEFAULT NULL,
  `idDeportivo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deporte`
--

CREATE TABLE `deporte` (
  `idDeporte` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `deporte` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportivo`
--

CREATE TABLE `deportivo` (
  `idDeportivo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `direccion` text NOT NULL,
  `horario` text NOT NULL,
  `oferta` text NOT NULL,
  `mapa` text NOT NULL,
  `imagen` text DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `tipoEspacio` varchar(100) NOT NULL,
  `banosCantidad` int(11) DEFAULT NULL,
  `banosStatus` varchar(100) DEFAULT NULL,
  `banosTipo` varchar(100) DEFAULT NULL,
  `vigilaciaCantidad` int(11) DEFAULT NULL,
  `vigilanciaStatus` varchar(100) DEFAULT NULL,
  `vigilanciaTipo` varchar(100) DEFAULT NULL,
  `puertasEntradas` int(11) DEFAULT NULL,
  `aceptaMascotas` tinyint(1) DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `calificacion` decimal(1,1) NOT NULL,
  `idResponsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `deportivo`
--

INSERT INTO `deportivo` (`idDeportivo`, `nombre`, `direccion`, `horario`, `oferta`, `mapa`, `imagen`, `fechaRegistro`, `tipoEspacio`, `banosCantidad`, `banosStatus`, `banosTipo`, `vigilaciaCantidad`, `vigilanciaStatus`, `vigilanciaTipo`, `puertasEntradas`, `aceptaMascotas`, `costo`, `calificacion`, `idResponsable`) VALUES
(1, 'Deportivo 18 de Marzo', 'Habana s/n, Tepeyac Insurgentes, Gustavo A. Madero, 07020 Ciudad de México, CDMX', 'a.m.-p.m.', 'Canchas de futbol al aire libre, chanchas de basquetbol al aire libre y cerradas, alberca techada, cancha de futbol americano, salón de eventos, cancha de tenis.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15045.372924674166!2d-99.13440478261717!3d19.48386350000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f9a05593187f%3A0xe37409f0fab22428!2sDeportivo%2018%20de%20Marzo!5e0!3m2!1ses-419!2smx!4v1726822223122!5m2!1ses-419!2smx', 'img/areas/dep18.png', NULL, 'Deportivo', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0.9, 1),
(2, 'Deportivo Hermanos Galeana', 'Av. José Loreto Fabela 190, San Juan de Aragón VII Secc, Gustavo A. Madero, 07910 Ciudad de México, CDMX', '7:30 a.m. - 7:30 p.m.', 'Canchas de basquetbol, futbol soccer, futbol americano, estadio y campo de beisbol, alberca, rampas de skate, juegos infantiles.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7523.034112687611!2d-99.08426601926001!3d19.476378140237234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1fbb6b9af24bd%3A0xa8188376a4459339!2sDeportivo%20los%20Galeana%2C%2007910%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1726822376036!5m2!1ses-419!2smx', 'img/areas/galeana.jpg', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.9, 1),
(3, 'Centro Deportivo “Lomas de San Jerónimo”', 'Laurel 76, Lomas de San Miguel, 52928 Cdad. López Mateos, Méx.', '8:00 a.m. - 9:00 p.m.', 'Gimnasio equipado, canchas de voleibol, pista de atletismo, muro de escalada, cancha de pádel, áreas de yoga al aire libre, parque de calistenia.', '', 'img/areas/centro-deportivo-san-jeronimo-piscina-francisco-tabuenca-pool.jpg', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.0, 1),
(4, 'Complejo Olímpico – Alberca “Francisco Márquez” y Gimnasio “Juan de la Barrera”', 'Av. Río Churubusco, Gral Anaya, Benito Juárez, 03340 Ciudad de México, CDMX', '8:00 a.m. - 8:00 p.m.', 'Canchas de fútbol rápido, canchas de voleibol, gimnasio de pesas, cancha de básquetbol, pista para correr, alberca al aire libre, zona de entrenamiento funcional.', '', 'img/areas/Alberca_Olímpica_Francisco_Márquez.jpg', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0.0, 1),
(5, 'Canchita', 'CAlle,#,Campestre,Álvaro Obregón,07530', '04:06a.m.-07:06p.m.', '', 'link', NULL, '2025-01-09 00:00:00', 'Deportivo', NULL, '1', NULL, NULL, '1', NULL, NULL, 1, 150.00, 0.9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgsecundarias`
--

CREATE TABLE `imgsecundarias` (
  `idImgSec` int(11) NOT NULL,
  `ruta` varchar(255) DEFAULT NULL,
  `idDeportivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `negocio`
--

CREATE TABLE `negocio` (
  `idNegocio` int(11) NOT NULL,
  `nombreNegocio` varchar(100) DEFAULT NULL,
  `duenoNegocio` varchar(100) DEFAULT NULL,
  `serviciosNegocio` varchar(100) DEFAULT NULL,
  `productosNegocio` varchar(100) DEFAULT NULL,
  `horarioNegocio` varchar(100) DEFAULT NULL,
  `tipoNegocio` varchar(255) DEFAULT NULL,
  `ubicacionNegocio` varchar(100) DEFAULT NULL,
  `descripcionNegocio` varchar(255) DEFAULT NULL,
  `imagenesNegocio` varchar(255) DEFAULT NULL,
  `idDeportivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participante`
--

CREATE TABLE `participante` (
  `idParti` int(11) NOT NULL,
  `idPartida` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `idPartida` int(11) NOT NULL,
  `nombrePartida` varchar(255) DEFAULT NULL,
  `lugarPartida` varchar(255) DEFAULT NULL,
  `fechaPartida` date DEFAULT NULL,
  `duracionPartida` time DEFAULT NULL,
  `descripcionPartida` text DEFAULT NULL,
  `deportePartida` varchar(100) DEFAULT NULL,
  `empresaPatrocinioPartida` varchar(255) DEFAULT NULL,
  `publicoDirigido` varchar(255) DEFAULT NULL,
  `nivelExperiencia` varchar(100) DEFAULT NULL,
  `horaReunion` time DEFAULT NULL,
  `transporte` varchar(255) DEFAULT NULL,
  `indicacionesExtra` text DEFAULT NULL,
  `uniformes` varchar(255) DEFAULT NULL,
  `idDeportivo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `accesoPublico` tinyint(4) NOT NULL DEFAULT 1,
  `cuota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`idPartida`, `nombrePartida`, `lugarPartida`, `fechaPartida`, `duracionPartida`, `descripcionPartida`, `deportePartida`, `empresaPatrocinioPartida`, `publicoDirigido`, `nivelExperiencia`, `horaReunion`, `transporte`, `indicacionesExtra`, `uniformes`, `idDeportivo`, `idUsuario`, `accesoPublico`, `cuota`) VALUES
(1, 'Cascara', '2', '2025-01-17', '00:00:50', 'Cascarita para jovenes', 'Fútbol', 'Gamesa', 'todos', 'Sin experiencia necesaria', '18:50:00', NULL, 'Mucha Actitud', 'No es necesario', 1, 1, 1, NULL),
(2, 'Cascara', '2', '2025-01-17', '00:00:50', 'Cascarita para jovenes', 'Fútbol', 'Gamesa', 'todos', 'Sin experiencia necesaria', '18:50:00', NULL, 'Mucha Actitud', 'No es necesario', 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reputacion`
--

CREATE TABLE `reputacion` (
  `idReputacion` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `calificado` int(11) NOT NULL,
  `reputacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `reputacion`
--
DELIMITER $$
CREATE TRIGGER `updateAvgUser` AFTER INSERT ON `reputacion` FOR EACH ROW BEGIN
    DECLARE nuevopromedio DECIMAL(10, 2);

    
    SELECT AVG(reputacion) INTO nuevopromedio FROM reputacion where calificado= NEW.calificado;

    
    UPDATE usuario SET reputacion = nuevopromedio WHERE calificado= NEW.calificado;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `soliamigo`
--

CREATE TABLE `soliamigo` (
  `idSoli` int(11) NOT NULL,
  `idAmigo1` int(11) DEFAULT NULL,
  `idAmigo2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solipartida`
--

CREATE TABLE `solipartida` (
  `idSoliPartida` int(11) NOT NULL,
  `idPartida` int(11) DEFAULT NULL,
  `idSolicitante` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `redaccion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `idTorneo` int(11) NOT NULL,
  `nombreTorneo` varchar(255) NOT NULL,
  `objetivoTorneo` text DEFAULT NULL,
  `descripcionTorneo` text DEFAULT NULL,
  `modalidadTorneo` varchar(100) DEFAULT NULL,
  `fechasProgramadas` date DEFAULT NULL,
  `numeroHoras` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `ligaInscripciones` varchar(255) DEFAULT NULL,
  `calificacionesTorneo` decimal(3,2) DEFAULT NULL,
  `ubicacionTorneo` varchar(255) DEFAULT NULL,
  `premiosTorneo` varchar(255) DEFAULT NULL,
  `empresaPatrocinadora` varchar(255) DEFAULT NULL,
  `prerequisitos` text DEFAULT NULL,
  `materialEquipamineto` text DEFAULT NULL,
  `nivelExperiencia` varchar(100) DEFAULT NULL,
  `idDeportivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellidos` text NOT NULL,
  `correo` text NOT NULL,
  `pass` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `nombreUsuario` varchar(255) DEFAULT NULL,
  `alcaldia` text NOT NULL,
  `clubOrganizacion` varchar(255) DEFAULT NULL,
  `reputacion` decimal(3,1) NOT NULL,
  `tipoUsuario` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidos`, `correo`, `pass`, `imagen`, `nombreUsuario`, `alcaldia`, `clubOrganizacion`, `reputacion`, `tipoUsuario`) VALUES
(1, 'root', '', 'root@root', 'root', 'img/metallica.jpeg', NULL, '', NULL, 5.0, 1),
(2, 'Paki', '', 'christopherpaki.nunezr@hotmail.com', '123', 'img/2.jpeg', NULL, '', NULL, 0.0, 3),
(3, 'Paki', 'Nuñez', '1@1', '123', 'img/default.jpg', 'Peik', 'Gustavo A. Madero', 'America', 0.0, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`idAmigo`),
  ADD KEY `idAmigo1` (`idAmigo1`),
  ADD KEY `idAmigo2` (`idAmigo2`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`idCalificacion`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`idCancha`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `comentcurso`
--
ALTER TABLE `comentcurso`
  ADD PRIMARY KEY (`idComentCurso`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idCurso` (`idCurso`);

--
-- Indices de la tabla `comentdeportivo`
--
ALTER TABLE `comentdeportivo`
  ADD PRIMARY KEY (`idComentDeportivo`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `comenttorneo`
--
ALTER TABLE `comenttorneo`
  ADD PRIMARY KEY (`idComentTorneo`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idTorneo` (`idTorneo`);

--
-- Indices de la tabla `comentusuario`
--
ALTER TABLE `comentusuario`
  ADD PRIMARY KEY (`idComentUsuario`),
  ADD KEY `autor` (`autor`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`idCurso`),
  ADD KEY `idDeportivo` (`idDeportivo`),
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
-- Indices de la tabla `imgsecundarias`
--
ALTER TABLE `imgsecundarias`
  ADD PRIMARY KEY (`idImgSec`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD PRIMARY KEY (`idNegocio`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `participante`
--
ALTER TABLE `participante`
  ADD PRIMARY KEY (`idParti`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`idPartida`),
  ADD KEY `idDeportivo` (`idDeportivo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `reputacion`
--
ALTER TABLE `reputacion`
  ADD PRIMARY KEY (`idReputacion`),
  ADD KEY `autor` (`autor`),
  ADD KEY `calificado` (`calificado`);

--
-- Indices de la tabla `soliamigo`
--
ALTER TABLE `soliamigo`
  ADD PRIMARY KEY (`idSoli`),
  ADD KEY `idAmigo1` (`idAmigo1`),
  ADD KEY `idAmigo2` (`idAmigo2`);

--
-- Indices de la tabla `solipartida`
--
ALTER TABLE `solipartida`
  ADD PRIMARY KEY (`idSoliPartida`),
  ADD KEY `idPartida` (`idPartida`),
  ADD KEY `idSolicitante` (`idSolicitante`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`idTorneo`),
  ADD KEY `idDeportivo` (`idDeportivo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigo`
--
ALTER TABLE `amigo`
  MODIFY `idAmigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `idCalificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `idCancha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `comentcurso`
--
ALTER TABLE `comentcurso`
  MODIFY `idComentCurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentdeportivo`
--
ALTER TABLE `comentdeportivo`
  MODIFY `idComentDeportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `comenttorneo`
--
ALTER TABLE `comenttorneo`
  MODIFY `idComentTorneo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentusuario`
--
ALTER TABLE `comentusuario`
  MODIFY `idComentUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `idCurso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deporte`
--
ALTER TABLE `deporte`
  MODIFY `idDeporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deportivo`
--
ALTER TABLE `deportivo`
  MODIFY `idDeportivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imgsecundarias`
--
ALTER TABLE `imgsecundarias`
  MODIFY `idImgSec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `negocio`
--
ALTER TABLE `negocio`
  MODIFY `idNegocio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `participante`
--
ALTER TABLE `participante`
  MODIFY `idParti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
  MODIFY `idPartida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `soliamigo`
--
ALTER TABLE `soliamigo`
  MODIFY `idSoli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `solipartida`
--
ALTER TABLE `solipartida`
  MODIFY `idSoliPartida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `idTorneo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `amigo_ibfk_1` FOREIGN KEY (`idAmigo1`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `amigo_ibfk_2` FOREIGN KEY (`idAmigo2`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD CONSTRAINT `cancha_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `comentcurso`
--
ALTER TABLE `comentcurso`
  ADD CONSTRAINT `comentcurso_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentcurso_ibfk_2` FOREIGN KEY (`idCurso`) REFERENCES `curso` (`idCurso`);

--
-- Filtros para la tabla `comentdeportivo`
--
ALTER TABLE `comentdeportivo`
  ADD CONSTRAINT `comentdeportivo_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentdeportivo_ibfk_2` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `comenttorneo`
--
ALTER TABLE `comenttorneo`
  ADD CONSTRAINT `comenttorneo_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comenttorneo_ibfk_2` FOREIGN KEY (`idTorneo`) REFERENCES `torneo` (`idTorneo`);

--
-- Filtros para la tabla `comentusuario`
--
ALTER TABLE `comentusuario`
  ADD CONSTRAINT `comentusuario_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `comentusuario_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`),
  ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `deporte`
--
ALTER TABLE `deporte`
  ADD CONSTRAINT `deporte_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `imgsecundarias`
--
ALTER TABLE `imgsecundarias`
  ADD CONSTRAINT `imgsecundarias_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `negocio`
--
ALTER TABLE `negocio`
  ADD CONSTRAINT `negocio_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`),
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `reputacion`
--
ALTER TABLE `reputacion`
  ADD CONSTRAINT `reputacion_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `reputacion_ibfk_2` FOREIGN KEY (`calificado`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `soliamigo`
--
ALTER TABLE `soliamigo`
  ADD CONSTRAINT `soliamigo_ibfk_1` FOREIGN KEY (`idAmigo1`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `soliamigo_ibfk_2` FOREIGN KEY (`idAmigo2`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `solipartida`
--
ALTER TABLE `solipartida`
  ADD CONSTRAINT `solipartida_ibfk_1` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`idPartida`),
  ADD CONSTRAINT `solipartida_ibfk_2` FOREIGN KEY (`idSolicitante`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD CONSTRAINT `torneo_ibfk_1` FOREIGN KEY (`idDeportivo`) REFERENCES `deportivo` (`idDeportivo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
