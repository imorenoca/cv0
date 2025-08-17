USE refarcv;

-- Insertar roles
INSERT INTO rol (rol) VALUES ('administrador'), ('usuario');

-- Insertar usuarios
INSERT INTO usuario (usuario, correo, password) VALUES
('usuario1', 'usuario1@example.com', '1234'),
('usuario2', 'usuario2@example.com', '1234');

-- Asignar roles a los usuarios
INSERT INTO usuario_rol (id_usuario, id_rol) VALUES
(1,2),
(2,1);

-- Insertar envíos
INSERT INTO envio (tipo) VALUES
('Infojobs.net'),
('Autocandidatura'),
('Correo Ordinario');

-- Insertar empresas
INSERT INTO empresa (nombre_empresa, web) VALUES
('Consultora X', 'http://www.consultorax.com'),
('Agencia Y', 'http://www.agenciay.es');

-- Insertar tipo de contacto
INSERT INTO tipo_contacto (tipo) VALUES ('interno'), ('headhunter');

-- Insertar contactos
INSERT INTO contacto (nombre_contacto, cargo, correo, telefono, id_usuario, id_empresa, id_tipo_contacto) VALUES
('Ana López', 'Recruiter', 'ana.lopez@example.com', '600111222', 1, 2, 2), -- Headhunter agencia
('Carlos Gómez', 'CTO', 'carlos.gomez@example.com', '600333444', 2, 1, 1),  -- Interno empresa
('Lucía Fernández', 'HR Manager', 'lucia.fernandez@example.com', '600555666', 1, 1, 1), -- Interno empresa
('Jorge Martínez', 'Developer', 'jorge.martinez@example.com', '600777888', 2, NULL, 2); -- Headhunter libre

-- Insertar datos de referencia
INSERT INTO nivel_ingles (nombre) VALUES ('no'), ('si');
INSERT INTO estado_oferta (nombre) VALUES ('abierto'), ('cerrado'), ('guardado');
INSERT INTO tipo_trabajo (nombre) VALUES ('presencial'), ('híbrido'), ('remoto');

-- Insertar ofertas de prueba
INSERT INTO oferta (
    fecha_inicio, fecha_fin, nombre_puesto, experiencia_anios,
    id_nivel_ingles, tecnologia, id_envio, id_empresa,
    id_estado, id_tipo_trabajo, id_usuario, id_contacto
) VALUES
('2025-08-17', NULL, 'Desarrollador Web', 3, 2, 'PHP, JavaScript', 1, 1, 1, 3, 1, 1),
('2025-08-18', NULL, 'Programador Java', 5, 1, 'Java, Spring Boot', 2, 2, 1, 2, 2, 2),
('2025-08-19', NULL, 'Frontend Developer', 2, 2, 'React, HTML, CSS', 1, 1, 1, 3, 1, 1),
('2025-08-20', NULL, 'Backend Developer', 4, 1, 'Node.js, Express', 2, 2, 1, 2, 2, 2),
('2025-08-21', NULL, 'Fullstack Developer', 6, 2, 'PHP, Angular', 1, 1, 1, 3, 1, 1),
('2025-08-22', NULL, 'Data Scientist', 3, 2, 'Python, R', 2, 2, 1, 2, 2, 2),
('2025-08-23', NULL, 'QA Engineer', 1, 1, 'Selenium, Java', 1, 1, 1, 3, 1, 1),
('2025-08-24', NULL, 'DevOps Engineer', 4, 2, 'Docker, Jenkins', 2, 2, 1, 2, 2, 2),
('2025-08-25', NULL, 'UI/UX Designer', 2, 1, 'Figma, Adobe XD', 1, 1, 1, 3, 1, 1),
('2025-08-26', NULL, 'Cloud Engineer', 5, 2, 'AWS, Azure', 2, 2, 1, 2, 2, 2);
