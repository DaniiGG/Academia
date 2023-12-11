-- MI BASE DE DATOS
-- USUARIO admin123 CONTRASEÑA contraseña123

drop database if exists academia;
Create database academia;
use academia;

drop table if exists alumnos;
CREATE TABLE `alumnos` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre` varchar(50) NOT NULL,
 `apellidos` varchar(50) NOT NULL,
 `id_padre` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_padre` (`id_padre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
drop table if exists materias;
CREATE TABLE `materias` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre_materia` varchar(100) NOT NULL,
 `id_profesor` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_profesor` (`id_profesor`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
drop table if exists pruebas;
CREATE TABLE `pruebas` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `id_materia` int(11) NOT NULL,
 `trimestre` enum('primero','segundo','tercero') NOT NULL,
 `id_alumno` int(11) NOT NULL,
 `nota` decimal(4,2) NOT NULL,
 `horario` varchar(30) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `id_materia` (`id_materia`),
 KEY `FK_pruebas_alumnos` (`id_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
drop table if exists usuarios;
CREATE TABLE `usuarios` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nombre` varchar(50) NOT NULL,
 `apellidos` varchar(50) NOT NULL,
 `nombre_usuario` varchar(30) NOT NULL,
 `rol` varchar(20) NOT NULL,
 `pass` varchar(255) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `nombre_usuario` (`nombre_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE alumnos
ADD CONSTRAINT FK_alumnos_usuarios FOREIGN KEY (id_padre) REFERENCES usuarios (id);

ALTER TABLE materias
ADD CONSTRAINT FK_materias_usuarios FOREIGN KEY (id_profesor) REFERENCES usuarios (id);

ALTER TABLE pruebas
ADD CONSTRAINT FK_pruebas_alumnos FOREIGN KEY (id_alumno) REFERENCES alumnos (id),
ADD CONSTRAINT FK_pruebas_materias FOREIGN KEY (id_materia) REFERENCES materias (id);




INSERT INTO usuarios (nombre, apellidos, nombre_usuario, rol, pass)
VALUES ('NombreAdmin', 'ApellidosAdmin', 'admin123', 'admin', 'contraseña123');
