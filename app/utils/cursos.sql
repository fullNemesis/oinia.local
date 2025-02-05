-- Tabla de idiomas
CREATE TABLE IF NOT EXISTS idiomas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    codigo VARCHAR(5) NOT NULL,
    activo BOOLEAN DEFAULT true
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla de cursos
CREATE TABLE IF NOT EXISTS cursos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    idioma_id INT NOT NULL,
    descripcion TEXT,
    nivel VARCHAR(20) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    plazas INT NOT NULL DEFAULT 20,
    precio DECIMAL(10,2) NOT NULL,
    activo BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idioma_id) REFERENCES idiomas(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla de inscripciones (relación usuario-curso)
CREATE TABLE IF NOT EXISTS inscripciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    curso_id INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'confirmado', 'cancelado') DEFAULT 'pendiente',
    FOREIGN KEY (curso_id) REFERENCES cursos(id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    UNIQUE KEY unique_usuario (usuario_id) -- Asegura que un usuario solo pueda inscribirse en un curso
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Insertamos algunos idiomas de ejemplo
INSERT INTO idiomas (nombre, codigo) VALUES 
('Inglés', 'EN'),
('Francés', 'FR'),
('Alemán', 'DE'),
('Italiano', 'IT'),
('Chino', 'ZH'),
('Español', 'ES'),
('Japonés', 'JA'); 