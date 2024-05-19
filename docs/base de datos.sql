-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS sayafitfinal;

-- Selección de la base de datos
USE sayafitfinal;

-- Creación de la tabla Usuario
CREATE TABLE Usuario (
    ID_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255),
    passwd VARCHAR(50)
);

-- Creación de la tabla Admin
CREATE TABLE Admin (
    ID_usuario INT PRIMARY KEY,
    email VARCHAR(255),
    passwd VARCHAR(50),
    FOREIGN KEY (ID_usuario) REFERENCES Usuario(ID_usuario)
);

-- Añadir Admins

-- Insertar Admin 1
INSERT INTO Usuario (nombre, email , passwd) VALUES ('Admin 1', 'ithaisa@sayafit.com', '1234');
SET @id_admin1 = LAST_INSERT_ID();
INSERT INTO Admin (ID_usuario, email, passwd) VALUES (@id_admin1, 'ithaisa@sayafit.com', '1234');

-- Insertar Admin 2
INSERT INTO Usuario (nombre, email , passwd) VALUES ('Admin 2', 'ivan@sayafit.com', '1234');
SET @id_admin2 = LAST_INSERT_ID();
INSERT INTO Admin (ID_usuario, email, passwd) VALUES (@id_admin2, 'ivan@sayafit.com', '1234');

-- Insertar Admin 3
INSERT INTO Usuario (nombre, email , passwd) VALUES ('Admin 3', 'ismael@sayafit.com', '1234');
SET @id_admin3 = LAST_INSERT_ID();
INSERT INTO Admin (ID_usuario, email, passwd) VALUES (@id_admin3, 'ismael@sayafit.com',  '1234');


-- Creación de la tabla Categorias
CREATE TABLE Categorias (
    ID_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(255),
    descripcion VARCHAR(255)
);

-- Insertar categorias

-- Insertar categorías adicionales
INSERT INTO Categorias (nombre_categoria, descripcion) VALUES 
('Ropa deportiva hombre', 'Colección de ropa deportiva para hombres'),
('Ropa deportiva mujer', 'Colección de ropa deportiva para mujeres'),
('Calzado deportivo hombre', 'Calzado deportivo para hombres'),
('Calzado deportivo mujer', 'Calzado deportivo para mujeres'),
('Material fitness', 'Equipos y accesorios para fitness'),
('Alimentación' , 'Alimentos para gente fitness'),
('Barritas' , 'Barritas para gente fitness'),
('Bebidas y suplementos' , 'Bebidas y suplementos para fitness'),
('Geles energéticas' , ' Geles energéticas para gente fitness'),
('Mezcladores' , 'Mezcladores para gente fitness'),
('Té e infusiones' , 'Té e infusiones para gente fitness');


-- Creación de la tabla Producto
CREATE TABLE Producto (
    ID_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255),
    descripcion VARCHAR(255),
    precio DECIMAL(10,2),
    ID_categorias INT,  -- Nombre de la columna en Producto
    imagen VARCHAR(255),
    stock INT,
    FOREIGN KEY (ID_categorias) REFERENCES Categorias(ID_categoria)  -- Nombre de la columna en Categorias
);

-- Creación de la tabla Compra
CREATE TABLE Compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

