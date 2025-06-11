CREATE TABLE
    estudiante (
        id INT AUTO_INCREMENT PRIMARY KEY,
        codigo_estudiante VARCHAR(20) UNIQUE NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        apellido VARCHAR(100) NOT NULL,
        dni VARCHAR(15),
        correo VARCHAR(100) UNIQUE,
        telefono VARCHAR(20),
        direccion TEXT,
        carrera VARCHAR(100),
        ciclo_academico INT,
        usuario VARCHAR(50) UNIQUE NOT NULL,
        contrasena VARCHAR(255) NOT NULL,
        fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE
    administrador (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        apellido VARCHAR(100) NOT NULL,
        correo VARCHAR(100) UNIQUE NOT NULL,
        usuario VARCHAR(50) UNIQUE NOT NULL,
        contrasena VARCHAR(255) NOT NULL,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
    );

CREATE TABLE
    evaluador (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        apellido VARCHAR(100) NOT NULL,
        area_academica VARCHAR(100),
        correo VARCHAR(100) UNIQUE NOT NULL,
        usuario VARCHAR(50) UNIQUE NOT NULL,
        contrasena VARCHAR(255) NOT NULL,
        fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
    );

INSERT INTO
    estudiante (
        codigo_estudiante,
        nombre,
        apellido,
        dni,
        correo,
        telefono,
        direccion,
        carrera,
        ciclo_academico,
        usuario,
        contrasena
    )
VALUES
    (
        '20231001',
        'María',
        'Silva',
        '12345678',
        'maria.silva@universidad.edu',
        '987654321',
        'Av. Los Álamos 123',
        'Ingeniería de Sistemas',
        5,
        'msilva',
        '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'
    ),
    (
        '20231002',
        'José',
        'Ramírez',
        '87654321',
        'jose.ramirez@universidad.edu',
        '987123456',
        'Calle Lima 456',
        'Administración',
        4,
        'jramirez',
        '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'
    );

INSERT INTO
    administrador (nombre, apellido, correo, usuario, contrasena)
VALUES
    (
        'Lucía',
        'Fernández',
        'lucia.admin@becas.edu',
        'lfernandez',
        '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'
    ),
    (
        'Carlos',
        'Torres',
        'carlos.admin@becas.edu',
        'ctorres',
        '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'
    );

INSERT INTO
    evaluador (
        nombre,
        apellido,
        area_academica,
        correo,
        usuario,
        contrasena
    )
VALUES
    (
        'Ana',
        'Reyes',
        'Ciencias Sociales',
        'ana.reyes@becas.edu',
        'areyes',
        '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'
    ),
    (
        'Miguel',
        'Lopez',
        'Ingeniería',
        'miguel.lopez@becas.edu',
        'mlopez',
        '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'
    );


CREATE TABLE aplicacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_tramite INT NOT NULL UNIQUE,             -- identificador del trámite
    estudiante_id INT NOT NULL,                     -- referencia al estudiante
    beca_id INT,                                     -- opcional: si hay múltiples becas
    fecha_postulacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(20) DEFAULT 'en_proceso',         -- en_proceso, enviado, evaluado, aprobado, rechazado
    observaciones TEXT,

    FOREIGN KEY (estudiante_id) REFERENCES estudiante(id)
    -- Puedes agregar FOREIGN KEY (beca_id) si creas una tabla beca
);


CREATE TABLE item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    aplicacion_id INT NOT NULL,                      -- relación directa con aplicación
    nombre VARCHAR(100) NOT NULL,                    -- ejemplo: "DNI escaneado", "Formulario socioeconómico"
    descripcion TEXT,
    archivo_nombre VARCHAR(255),
    archivo_ruta VARCHAR(255),
    estado VARCHAR(20) DEFAULT 'pendiente',          -- pendiente, aprobado, observado, rechazado
    observaciones TEXT,
    fecha_subida DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (aplicacion_id) REFERENCES aplicacion(id)
);


INSERT INTO aplicacion (numero_tramite, estudiante_id, beca_id, estado, observaciones)
VALUES
(3001, 1, NULL, 'en_proceso', 'Aplicación iniciada por María Silva'),
(3002, 2, NULL, 'evaluada', 'Documentos revisados por comité evaluador');


-- Ítems para aplicación de María Silva (3001)
INSERT INTO item (aplicacion_id, nombre, descripcion, archivo_nombre, archivo_ruta, estado, observaciones)
VALUES
(1, 'DNI Escaneado', 'Documento de identidad válido', 'dni_maria.pdf', '/uploads/3001/dni_maria.pdf', 'aprobado', NULL),
(1, 'Constancia de estudios', 'Constancia actualizada del semestre', 'constancia_maria.pdf', '/uploads/3001/constancia_maria.pdf', 'pendiente', 'Falta sello institucional');

-- Ítems para aplicación de José Ramírez (3002)
INSERT INTO item (aplicacion_id, nombre, descripcion, archivo_nombre, archivo_ruta, estado, observaciones)
VALUES
(2, 'DNI Escaneado', 'Documento de identidad válido', 'dni_jose.pdf', '/uploads/3002/dni_jose.pdf', 'aprobado', NULL),
(2, 'Recibo de agua', 'Comprobante de servicios para evaluación socioeconómica', 'agua_jose.pdf', '/uploads/3002/agua_jose.pdf', 'aprobado', NULL),
(2, 'Declaración jurada', 'Declaración jurada de ingresos', 'declaracion_jose.pdf', '/uploads/3002/declaracion_jose.pdf', 'rechazado', 'Documento ilegible');


ALTER TABLE aplicacion
ADD COLUMN tipo_beca VARCHAR(100) DEFAULT NULL,
ADD COLUMN motivo TEXT DEFAULT NULL,
ADD COLUMN monto_solicitado DECIMAL(10,2) DEFAULT NULL;





INSERT INTO estudiante (
    codigo_estudiante,
    nombre,
    apellido,
    dni,
    correo,
    telefono,
    direccion,
    carrera,
    ciclo_academico,
    usuario,
    contrasena
)
VALUES
('20231003', 'Lucía', 'Mendoza', '11223344', 'lucia.mendoza@universidad.edu', '911223344', 'Av. América 789', 'Contabilidad', 6, 'lmendoza', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231004', 'Marco', 'Vargas', '22334455', 'marco.vargas@universidad.edu', '922334455', 'Jr. Arequipa 321', 'Derecho', 7, 'mvargas', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231005', 'Elena', 'Quispe', '33445566', 'elena.quispe@universidad.edu', '933445566', 'Av. Brasil 654', 'Psicología', 3, 'equispe', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231006', 'Luis', 'Cruz', '44556677', 'luis.cruz@universidad.edu', '944556677', 'Calle Puno 777', 'Economía', 2, 'lcruz', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231007', 'Valeria', 'Ríos', '55667788', 'valeria.rios@universidad.edu', '955667788', 'Av. Perú 111', 'Ingeniería Civil', 8, 'vrios', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231008', 'Diego', 'Salazar', '66778899', 'diego.salazar@universidad.edu', '966778899', 'Pasaje Libertad 22', 'Arquitectura', 5, 'dsalazar', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231009', 'Andrea', 'Lopez', '77889900', 'andrea.lopez@universidad.edu', '977889900', 'Av. Santa Cruz 88', 'Comunicación', 6, 'alopez', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231010', 'Fernando', 'Gómez', '88990011', 'fernando.gomez@universidad.edu', '988990011', 'Jr. Tarapacá 999', 'Medicina', 4, 'fgomez', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231011', 'Paula', 'Huanca', '99001122', 'paula.huanca@universidad.edu', '999001122', 'Calle Los Pinos 18', 'Educación Inicial', 3, 'phuanca', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO'),
('20231012', 'Renzo', 'Ticona', '10111213', 'renzo.ticona@universidad.edu', '910111213', 'Av. La Cultura 456', 'Ingeniería Ambiental', 7, 'rticona', '$2y$10$LBYeTJEJMxCAGmf5psr2SOIqf8uHU0JrB4pqs4QLWMtZHzHxw0iKO');
