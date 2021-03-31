DROP DATABASE IF EXISTS GIGIS_DB;
CREATE DATABASE GIGIS_DB;
USE GIGIS_DB;

CREATE TABLE PERSONAL
(
	IdPersonal int NOT NULL UNIQUE AUTO_INCREMENT,
	NombrePersonal varchar(40) NOT NULL,
	TelefonoPersonal varchar(11) NOT NULL,
	CorreoPersonal varchar(100) NOT NULL,
	PuestoPersonal varchar(40),
	FechaInicioLaboral date NOT NULL,
	FechaFinLaboral date,
	RolPersonal varchar(20),
	ContrasenaPersonal varchar(20),
	PRIMARY KEY (IdPersonal)
);

INSERT INTO PERSONAL (NombrePersonal, TelefonoPersonal, CorreoPersonal, PuestoPersonal, FechaInicioLaboral, RolPersonal, ContrasenaPersonal) VALUES 
('ADMIN', 0000, 'Admin@hotmail.com', 'Administrador', '2020-12-03', 'Administrador', '12345'),
('PERSONAL', 0000, 'Persona@hotmail.com', 'Personal', '2020-12-03', 'Personal', '54321');

CREATE TABLE ARCHIVO
(
	IdPersonal int NOT NULL,
	IdArchivo int NOT NULL UNIQUE AUTO_INCREMENT,
	NombreArchivo varchar(255),
	LinkArchivo varchar(255),
	CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (IdPersonal, IdArchivo),
	FOREIGN KEY (IdPersonal) REFERENCES PERSONAL (IdPersonal) ON DELETE CASCADE
);

CREATE TABLE PRODUCTO
(
	IdProducto int NOT NULL UNIQUE AUTO_INCREMENT,
	NombreProducto varchar(50) NOT NULL,
	Descripcion varchar(150),
	PrecioEstimado decimal(6,2),
	PRIMARY KEY (IdProducto)
);

CREATE TABLE ALMACEN
(
	IdAlmacen int NOT NULL UNIQUE AUTO_INCREMENT,
	NombreAlmacen varchar(45) NOT NULL,
	PRIMARY KEY (IdAlmacen)
);

INSERT INTO ALMACEN (NombreAlmacen) VALUES
('Limpieza'),
('Cocina'),
('Escolares');

CREATE TABLE MOVIMIENTO
(
	IdPersonal int NOT NULL,
	IdProducto int NOT NULL,
	IdAlmacen int NOT NULL,
	Fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	Tipo varchar(7) NOT NULL,	/*Entrada / Salida*/
	Cantidad int NOT NULL,
	Destinatario varchar(40),
	PRIMARY KEY (IdPersonal, IdProducto, IdAlmacen, Fecha),
	FOREIGN KEY (IdPersonal) REFERENCES PERSONAL (IdPersonal) ON DELETE RESTRICT,
	FOREIGN KEY (IdProducto) REFERENCES PRODUCTO (IdProducto) ON DELETE CASCADE,
	FOREIGN KEY (IdAlmacen) REFERENCES ALMACEN (IdAlmacen) ON DELETE RESTRICT
);

CREATE TABLE CANTIDAD
(
	IdProducto int NOT NULL,
	IdAlmacen int NOT NULL,
	CantidadRegistrada int NOT NULL,
	PRIMARY KEY (IdProducto,IdAlmacen),
	FOREIGN KEY (IdProducto) REFERENCES PRODUCTO (IdProducto) ON DELETE CASCADE,
	FOREIGN KEY (IdAlmacen) REFERENCES ALMACEN (IdAlmacen) ON DELETE CASCADE
);

CREATE TABLE DONADOR
(
	IdDonador int NOT NULL UNIQUE AUTO_INCREMENT,
	NombreDonador varchar(40) NOT NULL,
	TelefonoDonador varchar(11) NOT NULL,
	CorreoDonador varchar(100) NOT NULL,
	Recurrente varchar(8),	/*ACTIVO / INACTIVO*/
	NumDonaciones int DEFAULT 1,
	PRIMARY KEY (IdDonador)
);


CREATE TABLE DMONETARIA
(
	IdDonador int NOT NULL,
	Clave int NOT NULL UNIQUE AUTO_INCREMENT,
	Monto decimal(9,2) NOT NULL,
	PRIMARY KEY (IdDonador, Clave),
	FOREIGN KEY (IdDonador) REFERENCES DONADOR (IdDonador) ON DELETE RESTRICT
);

CREATE TABLE PROPORCIONA
(
	IdDonador int NOT NULL,
	IdProducto int NOT NULL,
	FechaProporcionado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CantidadProporcionada int NOT NULL,
	PRIMARY KEY (IdDonador, IdProducto),
	FOREIGN KEY (IdDonador) REFERENCES DONADOR (IdDonador) ON DELETE RESTRICT,
	FOREIGN KEY (IdProducto) REFERENCES PRODUCTO (IdProducto) ON DELETE RESTRICT
);

DELIMITER $$

CREATE TRIGGER Sumar BEFORE INSERT
ON PROPORCIONA FOR EACH ROW
BEGIN
    UPDATE DONADOR SET NumDonaciones = NumDonaciones + 1 WHERE IdDonador = NEW.IdDonador;
END$$