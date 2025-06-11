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
