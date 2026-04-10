-- Use your database
USE travelbooking;

-- Drop table if exists (to start fresh)
DROP TABLE IF EXISTS flights;

-- Create flights table with all columns needed by the app
CREATE TABLE flights (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    departure_date DATE NOT NULL,
    departure_time TIME NOT NULL,
    arrival_time TIME NOT NULL,
    airline VARCHAR(100) NOT NULL,
    cabin_class ENUM('economy', 'premium', 'business', 'first') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    available_seats INT NOT NULL DEFAULT 50,
    duration VARCHAR(20) DEFAULT '2h 30m',
    origin_terminal VARCHAR(10) DEFAULT 'T1',
    destination_terminal VARCHAR(10) DEFAULT 'T2',
    baggage VARCHAR(100) DEFAULT 'Checked baggage 20 kg',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Insert sample flights with MULTIPLE TIMES for same route (KUL → CAN, etc.)
INSERT INTO flights 
(origin, destination, departure_date, departure_time, arrival_time, airline, cabin_class, price, available_seats, duration, origin_terminal, destination_terminal, baggage) 
VALUES

-- ===== KUALA LUMPUR (KUL) → GUANGZHOU (CAN) – multiple departure times =====
('KUL', 'CAN', '2026-05-15', '18:00:00', '22:25:00', 'China Southern Airlines', 'economy', 1291.00, 9, '4h 25m', 'T1', 'T2', 'Checked baggage 23 kg'),
('KUL', 'CAN', '2026-05-15', '21:55:00', '02:10:00', 'Batik Air Malaysia', 'economy', 1398.00, 15, '4h 15m', 'T1', 'T3', 'Checked baggage 23 kg'),
('KUL', 'CAN', '2026-05-15', '09:30:00', '13:40:00', 'Malaysia Airlines', 'economy', 1550.00, 3, '4h 10m', 'T1', 'T1', 'Checked baggage 30 kg'),
('KUL', 'CAN', '2026-05-15', '14:15:00', '18:30:00', 'AirAsia X', 'economy', 990.00, 20, '4h 15m', 'T2', 'T1', 'Cabin baggage only'),

-- ===== KUALA LUMPUR → PENANG (multiple times) =====
('KUL', 'PEN', '2026-05-01', '08:00:00', '08:55:00', 'Malaysia Airlines', 'economy', 120.00, 50, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'PEN', '2026-05-01', '08:00:00', '09:00:00', 'Malaysia Airlines', 'business', 250.00, 20, '1h 00m', 'T1', 'T1', 'Checked baggage 35 kg'),
('KUL', 'PEN', '2026-05-01', '15:00:00', '15:55:00', 'Firefly', 'economy', 130.00, 60, '55m', 'T1', 'T2', 'Checked baggage 15 kg'),
('KUL', 'PEN', '2026-05-01', '18:30:00', '19:25:00', 'AirAsia', 'economy', 99.00, 45, '55m', 'T2', 'T1', 'No checked baggage'),

-- ===== KUALA LUMPUR → JOHOR BAHRU =====
('KUL', 'JHB', '2026-05-01', '09:30:00', '10:30:00', 'Malaysia Airlines', 'economy', 150.00, 30, '1h 00m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'JHB', '2026-05-01', '09:30:00', '10:30:00', 'Malaysia Airlines', 'business', 300.00, 15, '1h 00m', 'T1', 'T1', 'Checked baggage 35 kg'),
('KUL', 'JHB', '2026-05-01', '14:20:00', '15:20:00', 'AirAsia', 'economy', 110.00, 40, '1h 00m', 'T2', 'T1', 'Cabin baggage only'),

-- ===== PENANG → KUALA LUMPUR (return flight example) =====
('PEN', 'KUL', '2026-05-02', '14:00:00', '14:55:00', 'Malaysia Airlines', 'economy', 110.00, 40, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('PEN', 'KUL', '2026-05-02', '16:30:00', '17:25:00', 'AirAsia', 'economy', 95.00, 50, '55m', 'T1', 'T2', 'No checked baggage'),
('PEN', 'KUL', '2026-05-02', '19:00:00', '19:55:00', 'Firefly', 'economy', 125.00, 25, '55m', 'T2', 'T1', 'Checked baggage 15 kg'),

-- ===== KUALA LUMPUR → LANGKAWI =====
('KUL', 'LGK', '2026-05-03', '07:45:00', '08:45:00', 'Malaysia Airlines', 'economy', 200.00, 20, '1h 00m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'LGK', '2026-05-03', '07:45:00', '08:45:00', 'Malaysia Airlines', 'first', 500.00, 10, '1h 00m', 'T1', 'T1', 'Checked baggage 40 kg'),
('KUL', 'LGK', '2026-05-03', '12:10:00', '13:10:00', 'AirAsia', 'economy', 180.00, 35, '1h 00m', 'T2', 'T1', 'Cabin baggage only');

