-- Create Database
CREATE DATABASE travelbooking;
USE travelbooking;

-- Flights Table (ONLY REQUIRED TABLE)
CREATE TABLE flights (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `from` VARCHAR(100) NOT NULL,
    `to` VARCHAR(100) NOT NULL,
    departure_date DATE NOT NULL,
    departure_time TIME NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    available_seats INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Sample Data (for testing search)
INSERT INTO flights (`from`, `to`, departure_date, departure_time, price, available_seats) VALUES
('Kuala Lumpur', 'Penang', '2026-05-01', '08:00:00', 120.00, 50),
('Kuala Lumpur', 'Penang', '2026-05-01', '15:00:00', 130.00, 60),
('Kuala Lumpur', 'Johor Bahru', '2026-05-01', '09:30:00', 150.00, 30),
('Penang', 'Kuala Lumpur', '2026-05-02', '14:00:00', 110.00, 40),
('Kuala Lumpur', 'Langkawi', '2026-05-03', '07:45:00', 200.00, 20);