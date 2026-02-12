-- =====================================
-- CREACIÓN BASE DE DATOS
-- =====================================

CREATE DATABASE IF NOT EXISTS soto_ayape_asier_DWES04;
USE soto_ayape_asier_DWES04;

-- =====================================
-- ELIMINAR TABLAS SI EXISTEN
-- =====================================

DROP TABLE IF EXISTS camisetas;
DROP TABLE IF EXISTS pedidos;

-- =====================================
-- TABLA PEDIDOS
-- =====================================

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente VARCHAR(100) NOT NULL,
    fecha_pedido DATE NOT NULL,
    estado VARCHAR(30) DEFAULT 'pendiente'
) ENGINE=InnoDB;

-- =====================================
-- TABLA CAMISETAS
-- =====================================

CREATE TABLE camisetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo VARCHAR(100) NOT NULL,
    temporada VARCHAR(20) NOT NULL,
    talla VARCHAR(5) NOT NULL,
    precio_compra DECIMAL(8,2) NOT NULL,
    precio_venta DECIMAL(8,2) NOT NULL,
    estado VARCHAR(30) DEFAULT 'en_stock',
    fecha_alta DATE NOT NULL,
    pedido_id INT,
    CONSTRAINT fk_pedido
        FOREIGN KEY (pedido_id)
        REFERENCES pedidos(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;
