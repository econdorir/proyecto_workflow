CREATE TABLE flujo_proceso (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    proceso_siguiente VARCHAR(10),
    tipo CHAR(1) NOT NULL, -- I = Inicio, P = Proceso, C = Cierre, S = Salida
    pantalla VARCHAR(50) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    PRIMARY KEY (flujo, proceso)
);

CREATE TABLE flujo_proceso_condicionante (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    proceso_si VARCHAR(10) NOT NULL,
    proceso_no VARCHAR(10) NOT NULL,
    PRIMARY KEY (flujo, proceso),
    FOREIGN KEY (flujo, proceso) REFERENCES flujo_proceso(flujo, proceso)
);

CREATE TABLE flujo_proceso_seguimiento (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    numero_tramite INT NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    fecha_inicio DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    fecha_fin DATE DEFAULT NULL,
    hora_fin TIME DEFAULT NULL,
    PRIMARY KEY (flujo, proceso, numero_tramite)
);



INSERT INTO flujo_proceso (flujo, proceso, proceso_siguiente, tipo, pantalla, rol) VALUES
('F1', 'P1',  'P2',  'I', 'inicio',                'estudiante'),
('F1', 'P2',  'P3',  'P', 'nueva_entrega',         'estudiante'),
('F1', 'P3',  'P4',  'P', 'form_beca',             'estudiante'),
('F1', 'P4',  'P5',  'P', 'enviar_beca',           'estudiante'),
('F1', 'P5',  'P6',  'P', 'verificar_documentos',  'administrador'),
('F1', 'P6',  NULL,  'C', 'aprobar_beca',          'administrador'),
('F1', 'P7',  'P8',  'P', 'seleccionar',           'administrador'),
('F1', 'P8',  'P9',  'P', 'enviar_seleccion',      'administrador'),
('F1', 'P9',  'P10', 'P', 'crear_item',            'evaluador'),
('F1', 'P10', 'P11', 'P', 'form_item',             'evaluador'),
('F1', 'P11', 'P12', 'P', 'guardar_item',          'evaluador'),
('F1', 'P12', NULL,  'C', 'cambiar_item',          'evaluador'),
('F1', 'P13', 'P15', 'P', 'estado_aprobado',       'evaluador'),
('F1', 'P14', 'P15', 'P', 'estado_desaprobado',    'administrador'),
('F1', 'P15', 'P16', 'P', 'guardar_fecha',         'evaluador'),
('F1', 'P16', NULL,  'S', 'anuncio',               'estudiante');

INSERT INTO flujo_proceso_condicionante (flujo, proceso, proceso_si, proceso_no) VALUES
('F1', 'P6',  'P7',  'P14'),
('F1', 'P12', 'P13', 'P10');

INSERT INTO flujo_proceso_seguimiento (flujo, proceso, numero_tramite, usuario, fecha_inicio, hora_inicio, fecha_fin, hora_fin) VALUES
('F1', 'P1', 2001, 'juanperez',    '2025-06-01', '09:00:00', '2025-06-01', '10:30:00'),
('F1', 'P2', 2001, 'juanperez',    '2025-06-01', '10:31:00', NULL,        NULL),      
('F1', 'P1', 2002, 'mariasoto',    '2025-06-05', '14:00:00', '2025-06-05', '14:45:00'),
('F1', 'P2', 2002, 'mariasoto',    '2025-06-05', '14:46:00', '2025-06-06', '09:15:00'),
('F1', 'P3', 2002, 'mariasoto',    '2025-06-06', '09:16:00', NULL,        NULL),      
('F1', 'P1', 2003, 'jorgelopez',   '2025-06-10', '08:00:00', NULL,        NULL),      
('F1', 'P2', 2003, 'jorgelopez',   '2025-06-10', '09:00:00', NULL,        NULL);
