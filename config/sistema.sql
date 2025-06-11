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


CREATE TABLE flujo_proceso (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    proceso_siguiente VARCHAR(10),
    tipo CHAR(1) NOT NULL, -- I = Inicio, P = Proceso, C = Cierre, S = Salida
    pantalla VARCHAR(50) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    PRIMARY KEY (flujo, proceso)
);

