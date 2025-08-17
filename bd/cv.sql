-- Crear base de datos
CREATE DATABASE IF NOT EXISTS refarcv;
USE refarcv;

-- Tabla de roles
CREATE TABLE `rol` (
  `id_rol` INT(11) NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de usuario
CREATE TABLE `usuario` (
  `id_usuario` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(255) DEFAULT NULL,
  `correo` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla intermedia usuario_rol
CREATE TABLE `usuario_rol` (
  `id_usuario` INT(11) NOT NULL,
  `id_rol` INT(11) NOT NULL,
  PRIMARY KEY (`id_usuario`, `id_rol`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de envíos
CREATE TABLE `envio` (
  `id_envio` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_envio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de empresas
CREATE TABLE `empresa` (
  `id_empresa` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` VARCHAR(255) DEFAULT NULL,
  `web` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla tipo de contacto (interno o headhunter)
CREATE TABLE `tipo_contacto` (
  `id_tipo` INT(11) NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de contactos
CREATE TABLE `contacto` (
  `id_contacto` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_contacto` VARCHAR(255) DEFAULT NULL,
  `cargo` VARCHAR(255) DEFAULT NULL,
  `correo` VARCHAR(100) DEFAULT NULL,
  `telefono` VARCHAR(15) DEFAULT NULL,
  `id_usuario` INT(11) DEFAULT NULL,
  `id_empresa` INT(11) DEFAULT NULL,
  `id_tipo_contacto` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id_contacto`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`),
  FOREIGN KEY (`id_tipo_contacto`) REFERENCES `tipo_contacto` (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tablas de referencia para reemplazar ENUMs
CREATE TABLE `nivel_ingles` (
  `id_nivel` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_nivel`)
);

CREATE TABLE `estado_oferta` (
  `id_estado` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_estado`)
);

CREATE TABLE `tipo_trabajo` (
  `id_tipo` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_tipo`)
);

-- Tabla de ofertas
CREATE TABLE `oferta` (
  `id_oferta` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE DEFAULT NULL,
  `nombre_puesto` VARCHAR(255) NOT NULL,
  `experiencia_anios` INT(11) DEFAULT NULL,
  `id_nivel_ingles` INT(11) DEFAULT NULL,
  `tecnologia` VARCHAR(255) DEFAULT NULL,
  `id_envio` INT(11) DEFAULT NULL,
  `id_empresa` INT(11) DEFAULT NULL,
  `id_estado` INT(11) DEFAULT NULL,
  `id_tipo_trabajo` INT(11) DEFAULT NULL,
  `id_usuario` INT(11) DEFAULT NULL,
  `id_contacto` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id_oferta`),
  FOREIGN KEY (`id_envio`) REFERENCES `envio` (`id_envio`),
  FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`),
  FOREIGN KEY (`id_contacto`) REFERENCES `contacto` (`id_contacto`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_nivel_ingles`) REFERENCES `nivel_ingles` (`id_nivel`),
  FOREIGN KEY (`id_estado`) REFERENCES `estado_oferta` (`id_estado`),
  FOREIGN KEY (`id_tipo_trabajo`) REFERENCES `tipo_trabajo` (`id_tipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Crear usuario para la aplicación
CREATE USER 'usuario_app'@'localhost' IDENTIFIED BY '1234';
GRANT ALL PRIVILEGES ON refarcv.* TO 'usuario_app'@'localhost';
COMMIT;
