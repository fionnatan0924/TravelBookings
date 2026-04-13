-- Use your database
USE travelbooking;

-- Drop table if exists (to start fresh)
DROP TABLE IF EXISTS flights;

-- Check if table exists and has rows
SELECT COUNT(*) FROM flights;

-- Show first 5 rows
SELECT * FROM flights LIMIT 5;

-- Show distinct origins and destinations
SELECT DISTINCT origin, destination FROM flights;

-- Show dates available
SELECT DISTINCT departure_date FROM flights ORDER BY departure_date;

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

-- 1. KUALA LUMPUR (KUL) → GUANGZHOU (CAN) – add 7 more economy flights (total 11)
INSERT INTO flights 
(origin, destination, departure_date, departure_time, arrival_time, airline, cabin_class, price, available_seats, duration, origin_terminal, destination_terminal, baggage) 
VALUES
('KUL', 'CAN', '2026-05-15', '01:00:00', '05:15:00', 'Malaysia Airlines', 'economy', 1350.00, 25, '4h 15m', 'T1', 'T1', 'Checked baggage 30 kg'),
('KUL', 'CAN', '2026-05-15', '03:30:00', '07:45:00', 'China Southern', 'economy', 1250.00, 30, '4h 15m', 'T1', 'T2', 'Checked baggage 23 kg'),
('KUL', 'CAN', '2026-05-15', '06:00:00', '10:15:00', 'AirAsia X', 'economy', 890.00, 40, '4h 15m', 'T2', 'T1', 'Cabin baggage only'),
('KUL', 'CAN', '2026-05-15', '11:00:00', '15:15:00', 'Batik Air', 'economy', 1180.00, 35, '4h 15m', 'T1', 'T3', 'Checked baggage 20 kg'),
('KUL', 'CAN', '2026-05-15', '13:30:00', '17:45:00', 'Malaysia Airlines', 'economy', 1420.00, 20, '4h 15m', 'T1', 'T1', 'Checked baggage 30 kg'),
('KUL', 'CAN', '2026-05-15', '16:00:00', '20:15:00', 'China Southern', 'economy', 1320.00, 28, '4h 15m', 'T1', 'T2', 'Checked baggage 23 kg'),
('KUL', 'CAN', '2026-05-15', '19:30:00', '23:45:00', 'AirAsia X', 'economy', 920.00, 50, '4h 15m', 'T2', 'T1', 'Cabin baggage only');

-- 2. KUALA LUMPUR (KUL) → PENANG (PEN) – add 8 more economy flights (total 11)
INSERT INTO flights 
(origin, destination, departure_date, departure_time, arrival_time, airline, cabin_class, price, available_seats, duration, origin_terminal, destination_terminal, baggage) 
VALUES
('KUL', 'PEN', '2026-05-01', '06:30:00', '07:25:00', 'Batik Air', 'economy', 115.00, 55, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'PEN', '2026-05-01', '09:00:00', '09:55:00', 'Malaysia Airlines', 'economy', 125.00, 48, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'PEN', '2026-05-01', '10:30:00', '11:25:00', 'Firefly', 'economy', 108.00, 52, '55m', 'T1', 'T2', 'Checked baggage 15 kg'),
('KUL', 'PEN', '2026-05-01', '12:00:00', '12:55:00', 'AirAsia', 'economy', 89.00, 65, '55m', 'T2', 'T1', 'Cabin baggage only'),
('KUL', 'PEN', '2026-05-01', '14:00:00', '14:55:00', 'Scoot', 'economy', 105.00, 38, '55m', 'T2', 'T1', 'Checked baggage 20 kg'),
('KUL', 'PEN', '2026-05-01', '16:30:00', '17:25:00', 'Malaysia Airlines', 'economy', 128.00, 44, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'PEN', '2026-05-01', '19:00:00', '19:55:00', 'Batik Air', 'economy', 118.00, 50, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'PEN', '2026-05-01', '21:30:00', '22:25:00', 'Firefly', 'economy', 98.00, 42, '55m', 'T1', 'T2', 'Checked baggage 15 kg');

-- 3. KUALA LUMPUR (KUL) → JOHOR BAHRU (JHB) – add 8 more economy flights (total 10)
INSERT INTO flights 
(origin, destination, departure_date, departure_time, arrival_time, airline, cabin_class, price, available_seats, duration, origin_terminal, destination_terminal, baggage) 
VALUES
('KUL', 'JHB', '2026-05-01', '06:00:00', '07:00:00', 'Malaysia Airlines', 'economy', 145.00, 35, '1h', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'JHB', '2026-05-01', '08:00:00', '09:00:00', 'AirAsia', 'economy', 105.00, 45, '1h', 'T2', 'T1', 'Cabin baggage only'),
('KUL', 'JHB', '2026-05-01', '11:00:00', '12:00:00', 'Firefly', 'economy', 135.00, 28, '1h', 'T1', 'T2', 'Checked baggage 15 kg'),
('KUL', 'JHB', '2026-05-01', '13:00:00', '14:00:00', 'Batik Air', 'economy', 125.00, 32, '1h', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'JHB', '2026-05-01', '16:00:00', '17:00:00', 'Malaysia Airlines', 'economy', 155.00, 30, '1h', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'JHB', '2026-05-01', '18:00:00', '19:00:00', 'AirAsia', 'economy', 108.00, 50, '1h', 'T2', 'T1', 'Cabin baggage only'),
('KUL', 'JHB', '2026-05-01', '20:00:00', '21:00:00', 'Firefly', 'economy', 128.00, 25, '1h', 'T1', 'T2', 'Checked baggage 15 kg'),
('KUL', 'JHB', '2026-05-01', '22:00:00', '23:00:00', 'Scoot', 'economy', 118.00, 20, '1h', 'T2', 'T1', 'Checked baggage 20 kg');

-- 4. PENANG (PEN) → KUALA LUMPUR (KUL) – add 8 more economy flights (total 11)
INSERT INTO flights 
(origin, destination, departure_date, departure_time, arrival_time, airline, cabin_class, price, available_seats, duration, origin_terminal, destination_terminal, baggage) 
VALUES
('PEN', 'KUL', '2026-05-02', '06:00:00', '06:55:00', 'Malaysia Airlines', 'economy', 115.00, 45, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('PEN', 'KUL', '2026-05-02', '08:30:00', '09:25:00', 'AirAsia', 'economy', 88.00, 55, '55m', 'T1', 'T2', 'Cabin baggage only'),
('PEN', 'KUL', '2026-05-02', '10:00:00', '10:55:00', 'Firefly', 'economy', 108.00, 40, '55m', 'T2', 'T1', 'Checked baggage 15 kg'),
('PEN', 'KUL', '2026-05-02', '12:30:00', '13:25:00', 'Batik Air', 'economy', 120.00, 48, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('PEN', 'KUL', '2026-05-02', '15:00:00', '15:55:00', 'Malaysia Airlines', 'economy', 118.00, 42, '55m', 'T1', 'T1', 'Checked baggage 20 kg'),
('PEN', 'KUL', '2026-05-02', '17:30:00', '18:25:00', 'Scoot', 'economy', 99.00, 38, '55m', 'T1', 'T2', 'Checked baggage 20 kg'),
('PEN', 'KUL', '2026-05-02', '20:00:00', '20:55:00', 'AirAsia', 'economy', 92.00, 60, '55m', 'T1', 'T2', 'Cabin baggage only'),
('PEN', 'KUL', '2026-05-02', '22:30:00', '23:25:00', 'Firefly', 'economy', 112.00, 30, '55m', 'T2', 'T1', 'Checked baggage 15 kg');

-- 5. KUALA LUMPUR (KUL) → LANGKAWI (LGK) – add 9 more economy flights (total 11)
INSERT INTO flights 
(origin, destination, departure_date, departure_time, arrival_time, airline, cabin_class, price, available_seats, duration, origin_terminal, destination_terminal, baggage) 
VALUES
('KUL', 'LGK', '2026-05-03', '06:00:00', '07:00:00', 'Malaysia Airlines', 'economy', 190.00, 25, '1h', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'LGK', '2026-05-03', '08:30:00', '09:30:00', 'AirAsia', 'economy', 165.00, 40, '1h', 'T2', 'T1', 'Cabin baggage only'),
('KUL', 'LGK', '2026-05-03', '10:00:00', '11:00:00', 'Firefly', 'economy', 195.00, 28, '1h', 'T1', 'T2', 'Checked baggage 15 kg'),
('KUL', 'LGK', '2026-05-03', '13:00:00', '14:00:00', 'Batik Air', 'economy', 210.00, 22, '1h', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'LGK', '2026-05-03', '15:00:00', '16:00:00', 'Malaysia Airlines', 'economy', 205.00, 30, '1h', 'T1', 'T1', 'Checked baggage 20 kg'),
('KUL', 'LGK', '2026-05-03', '17:00:00', '18:00:00', 'Scoot', 'economy', 175.00, 35, '1h', 'T2', 'T1', 'Checked baggage 20 kg'),
('KUL', 'LGK', '2026-05-03', '19:00:00', '20:00:00', 'AirAsia', 'economy', 160.00, 45, '1h', 'T2', 'T1', 'Cabin baggage only'),
('KUL', 'LGK', '2026-05-03', '21:00:00', '22:00:00', 'Firefly', 'economy', 188.00, 20, '1h', 'T1', 'T2', 'Checked baggage 15 kg'),
('KUL', 'LGK', '2026-05-03', '23:00:00', '00:00:00', 'Malaysia Airlines', 'economy', 220.00, 15, '1h', 'T1', 'T1', 'Checked baggage 20 kg');

-- =====================================================
-- VERIFICATION QUERIES (run to check counts)
-- =====================================================
SELECT 'KUL->CAN economy count' AS route, COUNT(*) AS total FROM flights WHERE origin='KUL' AND destination='CAN' AND cabin_class='economy';
SELECT 'KUL->PEN economy count' AS route, COUNT(*) AS total FROM flights WHERE origin='KUL' AND destination='PEN' AND cabin_class='economy';
SELECT 'KUL->JHB economy count' AS route, COUNT(*) AS total FROM flights WHERE origin='KUL' AND destination='JHB' AND cabin_class='economy';
SELECT 'PEN->KUL economy count' AS route, COUNT(*) AS total FROM flights WHERE origin='PEN' AND destination='KUL' AND cabin_class='economy';
SELECT 'KUL->LGK economy count' AS route, COUNT(*) AS total FROM flights WHERE origin='KUL' AND destination='LGK' AND cabin_class='economy';