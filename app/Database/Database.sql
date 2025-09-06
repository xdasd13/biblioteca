CREATE DATABASE biblioteca;
USE biblioteca;

CREATE TABLE categorias(
	idcategoria 	INT AUTO_INCREMENT PRIMARY KEY,
	categoria 		VARCHAR(200) NOT NULL
)ENGINE = INNODB;

INSERT INTO categorias (categoria) VALUES
	('Matemáticas'),
	('Comunicación'),
	('Computación');

SELECT * FROM categorias;

CREATE TABLE editoriales(
	ideditorial 	INT AUTO_INCREMENT PRIMARY KEY,
	editorial 		VARCHAR(200) NOT NULL,
	nacionalidad 	VARCHAR(200) NOT NULL
)ENGINE = INNODB;

INSERT INTO editoriales (editorial, nacionalidad) VALUES
('San Marcos', 'Perú'),
('Zig-Zag', 'Chile'),
('Kapelusz', 'Argentina');

CREATE TABLE subcategorias(
	idsubcategoria INT AUTO_INCREMENT PRIMARY KEY,
	subcategoria VARCHAR(200) NOT NULL,
	idcategoria INT NOT NULL,
	CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
)ENGINE = INNODB;


INSERT INTO subcategorias (subcategoria, idcategoria) VALUES
('Razonamiento Lógico Matemático', 1), -- Matemáticas
('Álgebra', 1),
('Trigonometría', 1),
('Razonamiento verbal', 2), -- Comunicación
('Composición', 2),
('Redacción', 2),
('Base de datos', 3), -- Computación
('Sistemas operativos', 3),
('Lenguajes de programación', 3);

SELECT * FROM subcategorias;

CREATE TABLE recursos (
  idrecurso INT AUTO_INCREMENT PRIMARY KEY,
  idsubcategoria INT NOT NULL,
  ideditorial INT NOT NULL,
  tipo ENUM('Físico','Digital') DEFAULT 'Digital',
  titulo VARCHAR(200) NOT NULL,
  apublicacion YEAR NOT NULL,
  isbn VARCHAR(20) NOT NULL UNIQUE,
  numpaginas INT NOT NULL,
  rutaportada VARCHAR(200) DEFAULT NULL,
  rutarecurso VARCHAR(200) DEFAULT NULL,
  estado ENUM('Bueno','Regular','Malo') NOT NULL,
  creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modificado TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_subcategoria FOREIGN KEY (idsubcategoria) REFERENCES subcategorias(idsubcategoria),
  CONSTRAINT fk_editorial FOREIGN KEY (ideditorial) REFERENCES editoriales(ideditorial)
) ENGINE=INNODB;

INSERT INTO recursos (idsubcategoria, ideditorial, tipo, titulo, apublicacion, isbn, numpaginas, rutaportada, rutarecurso, estado) VALUES
(1, 1, 'Digital', 'Razonamiento Lógico para Universitarios', 2018, '978-612-00-1234-5', 280, 'portadas/logica_peru.jpg', 'recursos/logica_peru.pdf', 'Bueno'),
(5, 2, 'Físico', 'Manual de Redacción Académica', 2015, '978-956-12-5678-9', 310, 'portadas/redaccion_chile.jpg', NULL, 'Regular'),
(7, 3, 'Digital', 'Introducción a Bases de Datos Relacionales', 2020, '978-987-65-4321-0', 420, 'portadas/bd_arg.jpg', 'recursos/bd_arg.pdf', 'Bueno');

CREATE TABLE libros(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
	nombre 		VARCHAR(200) 	NOT NULL,
	imagen		VARCHAR(200)	NOT NULL
)ENGINE = INNODB;

INSERT INTO libros (nombre, imagen) VALUES
	('Conociendo el Perú', 'libro1.jpg'),
	('Matemáticas avanzadas', 'libro2.jpg');

SELECT * FROM libros; -- Ctrl + F9

CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	dni 				CHAR (8) NOT NULL,
	apellidos		VARCHAR (40) NOT NULL,
	nombres			VARCHAR (40) NOT NULL,
	telefono			CHAR (9) NULL,
	iddistrito		INT NOT NULL,
	direccion 		VARCHAR (100) NULL,
	CONSTRAINT uk_dni UNIQUE (DNI),
	CONSTRAINT fk_iddistrito FOREIGN KEY (iddistrito) REFERENCES distritos(iddistrito)
)ENGINE = INNODB; 

INSERT INTO personas (dni,apellidos,nombres, telefono,iddistrito) VALUES 
	('60752963', 'Yataco Tasayco', 'Fabian','939863658','1026'),
	('41414141', 'Tasayco Gonzales', 'Rojas Julio','123456789','1006');
	
SELECT * FROM personas;