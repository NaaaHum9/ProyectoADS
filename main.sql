CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT NOT NULL,
    apellidos TEXT NOT NULL,
    correo TEXT NOT NULL,
    pass VARCHAR(255) NOT NULL,
    imagen VARCHAR(255),
    nombreUsuario VARCHAR(255),
    alcaldia TEXT NOT NULL,
    -- partidas VARCHAR(255),-- Otra tabla
   --  deporte VARCHAR(255),-- -- Otra tabla
    -- cursos VARCHAR(255),-- Otra tabla
    clubOrganizacion VARCHAR(255),-- Otra tabla
    -- amigos VARCHAR(255),-- Otra tabla
    reputacion DECIMAL(3, 1) NOT NULL
);



CREATE TABLE amigo(
    idAmigo INT AUTO_INCREMENT PRIMARY KEY,
    idAmigo1 INT NOT NULL,
    idAmigo2 INT NOT NULL,
    FOREIGN KEY (idAmigo1) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idAmigo2) REFERENCES usuario(idUsuario)
);

CREATE TABLE comentUsuario ( 
    idComentUsuario INT auto_increment PRIMARY KEY,
    autor int not null,
    contenido text not null,
    fecha date not null,
    idUsuario int not null,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

CREATE TABLE reputacion ( 
    idReputacion INT PRIMARY KEY,
    autor int not null,
    calificado int not null,
    reputacion int,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (calificado) REFERENCES usuario(idUsuario)
);

CREATE TABLE deporte ( 
    idDeporte INT auto_increment PRIMARY KEY,
    idUsuario int not null,
    deporte varchar(50) not null,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

CREATE TABLE deportivo ( 
    idDeportivo INT PRIMARY KEY auto_increment,
    nombre text not null,
    direccion text not null,
    horario text  not null,
    oferta text not null,
    mapa text not null,
    imagen TEXT,
    -- imagenSecundarias TEXT,-- Otra tabla
    fechaRegistro DATETIME,
    tipoEspacio VARCHAR(100) NOT NULL,
    banosCantidad INT,-- Otra tabla
    banosStatus VARCHAR(100),-- Otra tabla -- Las 3 juntas
    banosTipo VARCHAR(100),-- Otra tabla
    -- comercios TEXT,-- Otra tabla
    vigilaciaCantidad INT,
    vigilanciaStatus VARCHAR(100),
    vigilanciaTipo VARCHAR(100),
    puertasEntradas INT,-- Otra tabla
    aceptaMascotas BOOLEAN,
    costo DECIMAL(10, 2),
    calificacion DECIMAL(1, 1) not null
);

CREATE TABLE imgSecundarias(
    idImgSec INT PRIMARY KEY AUTO_INCREMENT,
    ruta VARCHAR(255),
    idDeportivo INT NOT NULL,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
);

CREATE TABLE calificacion ( 
    idCalificacion INT PRIMARY KEY,
    idUsuario int not null,
    idDeportivo int not null,
    calificacion int not null,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    );

CREATE TABLE comentDeportivo ( 
    idComentDeportivo INT auto_increment PRIMARY KEY,
    autor int not null,
    contenido text not null,
    fecha date not null,
    idDeportivo int not null,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    );

CREATE TABLE cancha(
    idCancha INT auto_increment PRIMARY KEY,
    etiqueta varchar(100), /*puede ser una letra con un numero CF1*/
    deporteCancha VARCHAR(100),
    medidasCancha VARCHAR(255),
    tipoSueloCancha VARCHAR(100),
    senalamientosCancha TEXT,
    equipamientoCanchaTipo VARCHAR(100),
    equipamientoCanchaStatus VARCHAR(100),
    equipamientoCanchaCantidad INT,
    iluminacionCanchaCantidad INT,
    iluminacionCanchaStatus VARCHAR(100),
    iluminacionCanchaTipo varchar(100),
    techadoCancha BOOLEAN,
    techadoCanchaTipo VARCHAR(100),
    gradasCanchaTipo VARCHAR(100),
    gradasCanchaStatus VARCHAR(100),
    gradasCanchaCantidad INT,
    banosCanchaCantidad INT,
    banosCanchasStatus VARCHAR(100),
    banosCanchasTipo VARCHAR(100),
    vestidoresCanchaTipo INT,
    vestidoresCanchaStatus VARCHAR(100),
    vestidoresCanchaCantidad INT,
    ubicacionPoligono VARCHAR(255),
    direccionEnDeportivo VARCHAR(255),
    horarioCancha VARCHAR(100),
    idDeportivo int not null,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
);

CREATE TABLE negocio(
    idNegocio INT auto_increment PRIMARY KEY, 
    nombreNegocio VARCHAR(100),
    duenoNegocio VARCHAR(100),
    serviciosNegocio VARCHAR(100),
    productosNegocio VARCHAR(100),-- Otra tabla
    horarioNegocio VARCHAR(100)
    tipoNegocio VARCHAR(255),
    ubicacionNegocio VARCHAR(100),
    descripcionNegocio VARCHAR(255),
    imagenesNegocio VARCHAR(255),-- Otra tabla
    idDeportivo int not null,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    
);

CREATE TABLE partida(
    idPartida INT auto_increment PRIMARY KEY,
    nombrePartida VARCHAR(255), 
    lugarPartida VARCHAR(255),
    fechaPartida DATE,
    duracionPartida TIME,
    descripcionPartida TEXT,
    deportePartida VARCHAR(100),
    empresaPatrocinioPartida VARCHAR(255),
    publicoDirigido VARCHAR(255),
    nivelExperiencia VARCHAR(100),
    horaReunion TIME,
    transporte VARCHAR(255),
    indicacionesExtra TEXT,
    uniformes VARCHAR(255),
    idDeportivo int not null,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    idUsuario int not null,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

CREATE TABLE participante(
    idParti int auto_increment PRIMARY KEY,
    idPartida INT NOT NULL,
    idUsuario INT NOT NULL,
)

CREATE TABLE torneo(
    idTorneo INT auto_increment PRIMARY KEY,
    nombreTorneo VARCHAR(255) NOT NULL,
    objetivoTorneo TEXT,
    descripcionTorneo TEXT,
    modalidadTorneo VARCHAR(100),
    fechasProgramadas DATE,-- Otra tabla
    numeroHoras INT,
    precio DECIMAL(10, 2),
    ligaInscripciones VARCHAR(255),
    calificacionesTorneo DECIMAL(3,2),
    -- comentariosTorneo TEXT,-- Otra tabla
    ubicacionTorneo VARCHAR(255),
    premiosTorneo VARCHAR(255),
    empresaPatrocinadora VARCHAR(255),
    prerequisitos TEXT,
    materialEquipamineto TEXT,
    nivelExperiencia VARCHAR(100),
    idDeportivo int not null,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
);

CREATE TABLE comentTorneo ( 
    idComentTorneo INT auto_increment PRIMARY KEY,
    autor int not null,
    contenido text not null,
    fecha date not null,
    idTorneo int not null,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idTorneo) REFERENCES torneo(idTorneo)
);


CREATE TABLE cursos(
    idCurso int auto_increment PRIMARY KEY,
    nombreCurso VARCHAR(255) NOT NULL,
    objetivoCurso TEXT,
    descripcionCurso TEXT,
    modalidadCurso VARCHAR(100),
    fechasProgramadas DATE,
    numeroHoras INT,
    precio DECIMAL(10, 2),
    ligaInscripciones VARCHAR(255),
    calificaciones DECIMAL(3,2),
    -- comentariosCursos TEXT,
    ubicacionCurso VARCHAR(255),
    tipoReconocimiento VARCHAR(255),
    empresaPatrocinadora VARCHAR(255),
    prerequisitos TEXT,
    materialEquipamineto TEXT,
    nivelExperiencia VARCHAR(100),
    idDeportivo int not null,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    idUsuario int not null,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
);

CREATE TABLE comentCurso ( 
    idComentCurso INT auto_increment PRIMARY KEY,
    autor int not null,
    contenido text not null,
    fecha date not null,
    idCurso int not null,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idCurso) REFERENCES curso(idCurso)
);

DELIMITER $$
CREATE TRIGGER updateAvgDepor
AFTER INSERT ON calificacion
FOR EACH ROW
BEGIN
    DECLARE nuevo_promedio DECIMAL(10, 2);

    
    SELECT AVG(calificacion) INTO nuevo_promedio FROM calificacion where idDeportivo=NEW.idDeportivo;

    
    UPDATE deportivo SET calificacion = nuevo_promedio WHERE id = NEW.idDeportivo;
END;

    CREATE TRIGGER updateAvgUser
AFTER INSERT ON reputacion
FOR EACH ROW
BEGIN
    DECLARE nuevopromedio DECIMAL(10, 2);

    
    SELECT AVG(reputacion) INTO nuevopromedio FROM reputacion where calificado= NEW.calificado;

    
    UPDATE deportivo SET reputacion = nuevopromedio WHERE calificado= NEW.calificado;
END;$$