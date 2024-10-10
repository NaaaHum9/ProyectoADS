
CREATE TABLE usuario (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL,
    pass VARCHAR(255) NOT NULL,
    imagen VARCHAR(255),
    reputacion DECIMAL(3, 1) NOT NULL
);

CREATE TABLE comentUsuario ( idComentUsuario INT auto_increment PRIMARY KEY,
    autor int not null,
    contenido text not null,
    fecha date not null,
    idUsuario int not null,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
    );
CREATE TABLE reputacion ( idReputacion INT PRIMARY KEY,
    autor int not null,
    calificado int not null,
    reputacion int,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (calificado) REFERENCES usuario(idUsuario)
    );
CREATE TABLE deporte ( idDeporte INT auto_increment PRIMARY KEY,
    idUsuario int not null,
    deporte varchar(50) not null,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario)
     );

CREATE TABLE deportivo ( idDeportivo INT PRIMARY KEY auto_increment,
    nombre text not null,
    direccion text not null,
    horario text  not null,
    oferta text not null,
    mapa text not null,
    calificacion DECIMAL(1, 1) not null);

CREATE TABLE calificacion ( idCalificacion INT PRIMARY KEY,
    idUsuario int not null,
    idDeportivo int not null,
    calificacion int not null,
    FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    );

CREATE TABLE comentDeportivo ( idComentDeportivo INT auto_increment PRIMARY KEY,
    autor int not null,
    contenido text not null,
    fecha date not null,
    idDeportivo int not null,
    FOREIGN KEY (autor) REFERENCES usuario(idUsuario),
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    );
CREATE TABLE imgDepor (idImgDepor INT auto_increment PRIMARY KEY,
    ruta VARCHAR(255),
    idDeportivo int not null,
    FOREIGN KEY (idDeportivo) REFERENCES deportivo(idDeportivo)
    );
DELIMITER $$
CREATE TRIGGER updateAvgDepor
AFTER INSERT ON calificacion
FOR EACH ROW
BEGIN
    DECLARE nuevo_promedio DECIMAL(10, 2);

    -- Calcular el promedio de todos los valores en la tabla 'valores'
    SELECT AVG(calificacion) INTO nuevo_promedio FROM calificacion where idDeportivo=NEW.idDeportivo;

    -- Actualizar el promedio en la tabla 'promedios'
    UPDATE deportivo SET calificacion = nuevo_promedio WHERE id = NEW.idDeportivo;
END;

    CREATE TRIGGER updateAvgUser
AFTER INSERT ON reputacion
FOR EACH ROW
BEGIN
    DECLARE nuevopromedio DECIMAL(10, 2);

    -- Calcular el promedio de todos los valores en la tabla 'valores'
    SELECT AVG(reputacion) INTO nuevopromedio FROM reputacion where calificado= NEW.calificado;

    -- Actualizar el promedio en la tabla 'promedios'
    UPDATE deportivo SET reputacion = nuevopromedio WHERE calificado= NEW.calificado;
END;$$