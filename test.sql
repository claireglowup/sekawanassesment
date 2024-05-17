CREATE DATABASE IF NOT EXISTS ptnikel;

USE ptnikel;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'approver') NOT NULL
);

INSERT INTO users (id, username, password, role) 
VALUES 
(UUID(), 'admin1', '$2y$10$ugv6zxyMrl1DCiQsylcgEO41IKUhgB.RMUNaqzbqYim5ftg7j5k7i', 'admin'),
(UUID(), 'approver1', '$2y$10$IVbTrBwGMjK8EpsS2OfpsumX3wqiLFEfg.R4y/D3g/5IOVhUd.tWC', 'approver'),
(UUID(), 'approver2', '$2y$10$UAgrRsOYmqJ8DOjTPZBIT.oeO5K6ETyBjbIwF3wSqRk0VoRcb8SzOi', 'approver');



DROP TABLE IF EXISTS car;
CREATE TABLE car (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(10) NOT NULL,
    img VARCHAR(255) NOT NULL,
    oil INT NOT NULL,
    kilometer INT NOT NULL,
    available INT NOT NULL DEFAULT 1,
    service_km INT NOT NULL
);



INSERT INTO car (id, name, type, img, oil, kilometer, available, service_km) 
VALUES 
(UUID(), 'truck1', 'truck', 'https://www.hino.co.id/assets/uploads/products/ZS4141_FINAL-min.png', 30, 0, 1, 2000),
(UUID(), 'truck2', 'truck', 'https://www.hino.co.id/assets/uploads/products/ZS4141_FINAL-min.png', 30, 0, 1, 2000),
(UUID(), 'truck3', 'truck', 'https://www.hino.co.id/assets/uploads/products/ZS4141_FINAL-min.png', 30, 0, 1, 2000),
(UUID(), 'truck4', 'truck', 'https://www.hino.co.id/assets/uploads/products/ZS4141_FINAL-min.png', 30, 0, 1, 2000),
(UUID(), 'truck5', 'truck', 'https://www.hino.co.id/assets/uploads/products/ZS4141_FINAL-min.png', 30, 0, 1, 2000),
(UUID(), 'truck6', 'truck', 'https://www.hino.co.id/assets/uploads/products/ZS4141_FINAL-min.png', 30, 0, 1, 2000),
(UUID(), 'dinas1', 'general', 'https://www.mercedes-benz.co.id/media/ubdaqd4f/eqe_available-models_554-x-369.png', 30, 0, 1, 3000),
(UUID(), 'dinas2', 'general', 'https://www.mercedes-benz.co.id/media/ubdaqd4f/eqe_available-models_554-x-369.png', 30, 0, 1, 3000),
(UUID(), 'dinas3', 'general', 'https://www.mercedes-benz.co.id/media/ubdaqd4f/eqe_available-models_554-x-369.png', 30, 0, 1, 3000),
(UUID(), 'dinas4', 'general', 'https://www.mercedes-benz.co.id/media/ubdaqd4f/eqe_available-models_554-x-369.png', 30, 0, 1, 3000),
(UUID(), 'dinas5', 'general', 'https://www.mercedes-benz.co.id/media/ubdaqd4f/eqe_available-models_554-x-369.png', 30, 0, 1, 3000),
(UUID(), 'dinas6', 'general', 'https://www.mercedes-benz.co.id/media/ubdaqd4f/eqe_available-models_554-x-369.png', 30, 0, 1, 3000);



DROP TABLE IF EXISTS `order`;  
CREATE TABLE `order` (
    id VARCHAR(255) NOT NULL PRIMARY KEY,
    nama_pegawai VARCHAR(255) NOT NULL,
    jabatan_pegawai VARCHAR(255) NOT NULL,
    estimasi_jarak INT NOT NULL,
    approved ENUM('Rejected', 'Approved', 'On Process') NOT NULL,
    approver_id VARCHAR(255) NOT NULL,
    car_id VARCHAR(255) NOT NULL,
    admin_id VARCHAR(255) NOT NULL,
    time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    action INT NOT NULL DEFAULT 0,
    car_status INT NOT NULL DEFAULT 0,
    CONSTRAINT fk_approver_id FOREIGN KEY (approver_id) REFERENCES users(id),
    CONSTRAINT fk_car_id FOREIGN KEY (car_id) REFERENCES car(id),
    CONSTRAINT fk_admin_id FOREIGN KEY (admin_id) REFERENCES users(id)
);