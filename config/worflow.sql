CREATE TABLE flujo_proceso (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    proceso_siguiente VARCHAR(10),
    tipo CHAR(1) NOT NULL,
    pantalla VARCHAR(50) NOT NULL,
    rol VARCHAR(50) NOT NULL
);

CREATE TABLE flujo_proceso_condicionante (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    proceso_si VARCHAR(10) NOT NULL,
    proceso_no VARCHAR(10) NOT NULL
);

CREATE TABLE flujo_proceso_seguimiento (
    flujo VARCHAR(10) NOT NULL,
    proceso VARCHAR(10) NOT NULL,
    numero_tramite INT NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    fecha_inicio DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    fecha_fin DATE DEFAULT NULL,
    hora_fin TIME DEFAULT NULL
);


INSERT INTO flujo_proceso (flujo, proceso, proceso_siguiente, tipo, pantalla, rol) VALUES
('F1', 'P1',  'P2',  'I', 'inicio',              'estudiante'),
('F1', 'P2',  'P3',  'P', 'nueva_entrega',       'estudiante'),
('F1', 'P3',  'P4',  'P', 'form_beca',           'estudiante'),
('F1', 'P4',  'P5',  'P', 'enviar_beca',         'estudiante'),
('F1', 'P5',  'P6',  'P', 'verificar_documentos','administrador'),
('F1', 'P6',  NULL,  'C', 'aprobar_beca',        'administrador'),
('F1', 'P7',  'P8',  'P', 'seleccionar',         'administrador'),
('F1', 'P8',  'P9',  'P', 'enviar_seleccion',    'administrador'),
('F1', 'P9',  'P10', 'P', 'evaluacion',          'administrador'),
('F1', 'P10', 'P12', 'P', 'estado_aprobado',     'administrador'),
('F1', 'P11', 'P12', 'P', 'estado_reprobado',    'administrador'),
('F1', 'P12', 'P13', 'P', 'guardar_fecha',       'administrador'),
('F1', 'P13', NULL,  'S', 'anuncio',             'estudiante');

INSERT INTO flujo_proceso (flujo, proceso, proceso_siguiente, tipo, pantalla, rol) VALUES
('F2', 'P1', 'P2', 'I', 'inicio', 'administrador'),
('F2', 'P2', 'P3', 'P', 'nombre_convocatoria', 'administrador'),
('F2', 'P3', 'P4', 'P', 'form_convocatoria', 'administrador'),
('F2', 'P4', 'P5', 'P', 'confirmar_convocatoria', 'administrador'),
('F2', 'P5', 'P6',  'p', 'aprobar_convocatoria', 'administrador'),
('F2', 'P6', 'P7',  'P', 'anunciar', 'administrador'),
('F2', 'P7', NULL,  'S', 'anuncio_convocatoria', 'estudiante');




INSERT INTO flujo_proceso_condicionante (flujo, proceso, proceso_si, proceso_no) VALUES
('F1', 'P6',  'P7',  'P11');

-- INSERT INTO flujo_proceso_condicionante (flujo, proceso, proceso_si, proceso_no) VALUES
-- ('F2', 'P5',  'P6',  'P3');


INSERT INTO flujo_proceso_seguimiento (flujo, proceso, numero_tramite, usuario, fecha_inicio, hora_inicio, fecha_fin, hora_fin) VALUES
('F1', 'P1', 3001, 'juanperez',    '2025-06-01', '09:00:00', '2025-06-01', '10:30:00'),
('F1', 'P2', 3001, 'juanperez',    '2025-06-01', '10:31:00', NULL,        NULL),      
('F1', 'P1', 3002, 'mariasoto',    '2025-06-05', '14:00:00', '2025-06-05', '14:45:00'),
('F1', 'P2', 3002, 'mariasoto',    '2025-06-05', '14:46:00', '2025-06-06', '09:15:00'),
('F1', 'P3', 3002, 'mariasoto',    '2025-06-06', '09:16:00', NULL,        NULL),      
('F1', 'P1', 3003, 'jorgelopez',   '2025-06-10', '08:00:00', NULL,        NULL),      
('F1', 'P2', 3003, 'jorgelopez',   '2025-06-10', '09:00:00', NULL,        NULL);


INSERT INTO flujo_proceso_seguimiento (flujo, proceso, numero_tramite, usuario, fecha_inicio, hora_inicio, fecha_fin, hora_fin) VALUES
('F2', 'P1', 5001, 'admin1',       '2025-06-01', '08:00:00', '2025-06-01', '08:20:00'),
('F2', 'P2', 5001, 'admin1',       '2025-06-01', '08:21:00', '2025-06-01', '08:40:00'),
('F2', 'P3', 5001, 'admin1',       '2025-06-01', '08:41:00', '2025-06-01', '09:00:00'),
('F2', 'P4', 5001, 'admin1',       '2025-06-01', '09:01:00', NULL,        NULL),

('F2', 'P1', 5002, 'admin2',       '2025-06-05', '10:00:00', '2025-06-05', '10:15:00'),
('F2', 'P2', 5002, 'admin2',       '2025-06-05', '10:16:00', '2025-06-05', '10:40:00'),
('F2', 'P3', 5002, 'admin2',       '2025-06-05', '10:41:00', '2025-06-05', '11:00:00'),
('F2', 'P4', 5002, 'admin2',       '2025-06-05', '11:01:00', '2025-06-05', '11:30:00'),
('F2', 'P5', 5002, 'admin2',       '2025-06-05', '11:31:00', NULL,        NULL),

('F2', 'P6', 5003, 'lauragomez',   '2025-06-06', '15:00:00', NULL,        NULL);  -- estudiante viendo el anuncio
